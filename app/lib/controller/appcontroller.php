<?php
class appcontroller {

private $config;
private $appModel;

public $db, $appView;

public function __construct ($config){
  try{
  //set the passed config array to class variable
  $this->config = $config;
  //initialize database connection
  $this->db = new databaseconnection($this->config['dbconfig']);
  //initialize the appmodel object.
  $this->appModel = new appmodel($this->db->link);
  //initialize the appView object
  $this->appView = new appview();

  }
catch(Exception $e){
  //Rethrow the exception.
  Throw new Exception($e->getMessage());
}
}

/**
* method to display the initial view of the interface.
*/

public function displayInitialView($message = ''){
  //Retrieve saved items for the user.
  $items = $this->appModel->getMyItems($_SESSION['user'],0);
  $this->appView->displayInitialView($items, $message);
}

/**
*This method lets you add new todo item.
*/
public function addToDo($value) {

  $this->appModel->saveToDo($value);
  $this->displayInitialView('New todo successfully added.');
}

/**
*This method lets you display completed todo item.
*/
public function displayCompleted($message = '') {
  $items = $this->appModel->getMyItems($_SESSION['user'],1);
  $this->appView->displayCompletedView($items, $message);
}

/**
*This method lets you mark item as completed item.
*/
public function markCompleted($id) {

  $this->appModel->markCompleted($id);
 $this->displayInitialView('Item successfully marked as completed');

}
/**
*This method lets you update completed item to not completed.
*/

public function markNotCompleted($id) {
 $this->appModel->markNotCompleted($id);
 $this->displayCompleted('Item successfully marked as not completed');
}

}

 ?>
