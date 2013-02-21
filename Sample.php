<?php
include 'EduPotpie.php';

$Edu = new EduPotpie (array(
  "token"  => "7499bd7e4c7b67a62b240eeab579ef4eab6b93d8" ,
  "object" => "assignment" 
));

/*
* Example 1
*/

//first example is getList 
$list = $Edu->api("/getList");

//output
echo "<pre>";
print_r($list);
echo "</pre>";
/*
* Example 2
*/

//example is create 
$create = $Edu->api("/create" , array(
  "course_select"               =>  1  , 
  "semi_loader"                 =>  1  , 
  "form_ass_subject"            => "Subject From API" , 
  "form_ass_subject_code"       => 12010 , 
  "form_ass_title"              => "Title From API" , 
  "content_assignments"         => "Content From API" ,  
  "User_id"                     => "100000894004523" ,
  "scheme_select"               => "e", 
  "publish_btn"                 => 1
 ));

//output
print_r($create);

/*
* Example 3
*/

$remove = $Edu->api("/trash" , array(
    "ass_id" => 65 , 
    "uid" => "100000894004523"
));

print_r($remove);


?>
