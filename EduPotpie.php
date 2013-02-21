<?php

/*
  EduPotpie SDK 
  ver. 1.1
  Under GPL
*/

/*
    Data Params for the $EduPotpie->api("/create" , $data);
    $data array should contain the following elements 
   +------------------------------------------+----------------+
   |Parameter                                 |  Data Type     |
   +------------------------------------------+----------------+
   |*course_select                            |  (int)         |
   |*semi_loader                              |  (int)         |
   |*form_ass_subject                         |  (String)      |
   |*form_ass_subject_code                    |  (string)      | 
   |*User_id                                  |  (string)      |
   |*form_ass_title                           |  (string)      |
   |meta_keyword_field                        |  (string)      |
   |meta_desc_field                           |  (string)      |
   |meta_author_field                         |  (string)      |
   |meta_lang_field                           |  (string)      |
   |*content_assignments                      |  (BIG TEXT)    | 
   |*scheme_select                            |  (char)        |
   |SCH_REPEAT_Field                          |  (string)      |
   |SCH_FROM_Field                            |  (string)      |
   |SCH_TO_Field                              |  (int)         |
   +------------------------------------------+----------------+
    Note : (*) Are Important Parameters

*/
class EduPotpie{

  /*
    Constructor for EduPoptie
    Constructor Params : array(
      "token" => <user_token>,
      "object" => <object_name>
    )
  */

  /*
    The Object_name is the holder for the object which is init for this object of EduPotpie
  */
  private $Object_name = "";
  
  /*
    List of all possible objects which can be init by this class 
  */
  public $Object_list = array(
    "assignment" , 
    "notes",
    "question_paper" , 
    "videos" , 
    "photos" , 
    "sample_question_paper" , 
    "class" , 
    "college" 
  );
  
  public function EduPotpie($access){
    if (is_array($access) == true){
      //valid the token 
      $link = "http://www.potpie.in/api/validateToken.php?token=".$access['token']."&object=".$access['object'];
      $file = file($link);
      //print_r($file);
      if ($file[0] == "true"){
      
        //validate the Object 
        
        if (in_array($access['object'] , $this->Object_list)){
            
            //here object name is true and ready to init in the object_name 
            $this->Object_name = $access['object'];
            
        }else{
        
          //not object found in the set
          die("Object Name is Not valid , please check and try again!");
        
        }
      
      }else{
      
        //given token is not valid and not signup for any developer account 
        die("Token is Not Valid..");
      
      }
    }else{
      die("Please Supply the Valid Params.. in Constructor");
    }
  }
  
  //set the API method 
  public function api(/*User define params*/){
    $args = func_get_args();
    if (isset($args[0]) ){
      $action = str_replace("/" , "" , $args[0]);
      
      switch($this->Object_name){
        case "assignment" :
          //switch for the action 
          switch($action){
            case "getList" : // getList action begins
            
              //this should return list of data 
              $f = file_get_contents("http://www.edu.potpie.in/api/assignment.php?token=sdsddkjjkjjks&key=getAll");
              
              //output
              return json_decode($f,true);
              
            break; // getList action done
            case "create" : // create action begins
            
              //here we have to create new assignment 
              if (is_array($args[1])){
                //set the URL
                $url = "http://www.edu.potpie.in/api/assignment.php?token=sndfkksjdkf&key=create";
                
                //output
                return $this->Post($url , $args[1]);
                
              }else{
              
                //no Post Data found !
                return false;
              
              }
              
            break; // create action done
            case  "trash" : //trash action begins
                
                //set the url
                $url = "http://www.edu.potpie.in/api/assignment.php?token=sndfkksjdkf&key=removeAssignment&ass_id=".$args[1]['ass_id']."&uid=".$args[1]['uid'];
                
                //send the link
                $result = file_get_contents($url);
                
                return $result;
                
            break;  //trash action done
            case "remove" : // remove action begins
            
                //set the url
                $url = "http://www.edu.potpie.in/api/assignment.php?token=sndfkksjdkf&key=ETMS&ass_id=".$args[1]['ass_id']."&uid=".$args[1]['uid'];
                
                //send the link
                $result = file_get_contents($url);
                
                return $result;
                
            
            break;  //remove action done
            case "restore" : // restore action begins
            
                //set the url
                $url = "http://www.edu.potpie.in/api/assignment.php?token=sndfkksjdkf&key=restore&ass_id=".$args[1]['ass_id']."&uid=".$args[1]['uid'];
                
                //send the link
                $result = file_get_contents($url);
                
                return $result;
                
            
            break;  //restore action done
            case "update" : // update action begins
            
                
            
            break; // update action done
          }
        break;
      }
      
    }
  }
  
  
  /*
  cUrl Methods 
  */
  public function Post($url,$data){
    $fields_string = "";                              // convert the complete data in to string
    
    //url-ify the data for the POST
    foreach($data as $key => $value) { 
      $fields_string .= $key.'='.urlencode($value).'&'; 
    }
    
    //removes the extract & 
    rtrim($fields_string, '&');
  
    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, count($data));
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

    //execute post
    $result = curl_exec($ch);
    
    //return the result 
    return $result;
      
    //close connection
    curl_close($ch);

  }
  
}

?> 

   
     
