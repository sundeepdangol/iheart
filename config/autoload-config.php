<?php
//define include path
$config['class_path'] = array(
                                APP_BASE_PATH . 'app'. DIRECTORY_SEPARATOR ,
                                APP_LIB_PATH ,
                                APP_LIB_PATH .'controller' . DIRECTORY_SEPARATOR,
                                APP_LIB_PATH .'model' . DIRECTORY_SEPARATOR,
                                APP_LIB_PATH .'view' . DIRECTORY_SEPARATOR,
                                APP_BASE_PATH . 'vendor'. DIRECTORY_SEPARATOR .'phpexcel' . DIRECTORY_SEPARATOR,
                                APP_BASE_PATH . 'vendor'. DIRECTORY_SEPARATOR .'gump' . DIRECTORY_SEPARATOR,
                              );

//define the directory path where the class files are located.
return $config;

 ?>
