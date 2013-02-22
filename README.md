EduPotpie
=========

EduPotpie SDK for PHP 

EduPotpie's SDK is much powerful that it can standalone to manage it's own UI and serve the Users.
Some examples are given below

How to Install EduPotpie SDK
-> Download the EduPotpie SDK from GitHub
-> Once you have downloaded , then you are read to code
-> Copy the EduPotpie.php file in to your current working dir.
-> Then include it in your script.

How to Init the EduPotpie Object 
->This init is only for notes , where as you can do init with other objects too 
->Just keep in mind that once you have invoke a object with a specify Edu Object name , then you can 
  only use the actions related to that object only. 

$Notes = new EduPotpie(array(
  "token" => "<Enter your Token here>" , 
  "object" => "notes" 
));
