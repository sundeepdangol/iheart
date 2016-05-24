<?php
/**
* Demo app to demonstrate todo list for iheart requirement
* This is a front controller design with MVC.
* @author Sundeep Dangol
*
*/

//Require main-config file.
require __DIR__ . DIRECTORY_SEPARATOR .  'config' . DIRECTORY_SEPARATOR . 'app-config.php';

//Bootstrap the application
require APP_LIB_PATH . 'bootstrap.php';

//Create a router that routes requests depending on the action parameter.
try{

if(isset($_GET['action'])){
 $_GET = $gump->sanitize($_GET);
  $action =$_GET['action'];

  switch(strtolower($action)){
    case 'add':
      $_POST = $gump->sanitize($_POST);

      $app->addToDo($_POST);
      break;

    case 'completed':
      $app->markCompleted( $_GET['id']);
      break;
      case 'notcompleted':

        $app->markNotCompleted( $_GET['id']);
        break;
    case 'viewcompleted':
      $app->displayCompleted();

      break;

    default:
      //No matching input was defined so default to the initial view screen
      $app->displayInitialView();
      break;

  }
}
else{
  $app->displayInitialView();
}

}
catch (Exception $e){
  //central location to catch and display exceptions/errors.
  $app->appView->displayError($e->getMessage());

}
?>
