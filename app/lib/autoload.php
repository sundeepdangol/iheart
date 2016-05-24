<?php
/**
*Autoloader for autoloading all class files.
*
*@author Sundeep Dangol
*
*/


spl_autoload_register(function($className){
  //load the config file which has the directory settings
$configArray = require APP_CONFIG_PATH .'autoload-config.php';

//loop through the directories to see if there is a class file defined. And include it if found.
foreach($configArray['class_path'] as $path){
  if(file_exists($path . $className . '.php')) {
    //class found. include it and return.
    require_once ($path . $className . '.php');
    return true;
  }
}
  return false;
},
false,
false);
