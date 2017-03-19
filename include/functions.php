
<?php
function __autoload($class_name){
    $class_name=  strtolower($class_name);
    $path="../include/{$class_name}.php";
    if(file_exists($path)){
        require_once ("$path");
    }  else {
        die("Could not find {$class_name}.php Not Found");    
    }
}

function give_title(){
$title=  basename($_SERVER['SCRIPT_FILENAME'], '.php');
$title=  str_replace("_", " ", $title);
if($title==("index")){
    $title="Welcome";
}
$title=  ucfirst($title.".");
return  $title;
}

