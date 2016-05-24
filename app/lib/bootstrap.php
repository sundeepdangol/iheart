<?php
/**
* bootstrap the application.
* @author Sundeep Dangol
*
*/
session_start();

//Include the autoloader
require  'autoload.php';

//Simulating a logged in user. since user creation and login is out of scope for this demo we are simulating a logged in user.
$_SESSION['user'] = 1;

//Require db-config file.
$config['dbconfig'] = require APP_CONFIG_PATH . 'db-config.php';

//initialize GUMP Validator
$gump = new GUMP();

//initialize app object
$app = new appcontroller($config);
?>
