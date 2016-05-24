<?php
class databaseconnection {

public $link;

public function __construct ($dbconfig){

try {
//check if the db connection parameters are properly passed from config. if not throw exception
if(!isset($dbconfig['host']) || !isset($dbconfig['user']) || !isset($dbconfig['password']) || !isset($dbconfig['dbname']) || !isset($dbconfig['driver']) || !isset($dbconfig['port'])){
  Throw new Exception ('db config parameters not properly set.');
}

  //Try to connect to the db
  $this->link = new PDO($dbconfig['driver'] . ':host='. $dbconfig['host'] . ';port='. $dbconfig['port'] .';dbname=' . $dbconfig['dbname'],$dbconfig['user'],$dbconfig['password']);

//set  connection attributes.
 $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (Exception $e){
  //Rethrow exception for the front controller to handle.
  Throw new Exception($e->getMessage());
}

}

}

 ?>
