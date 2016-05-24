<?php
class appmodel {
public $db;

public function __construct($db){
//Set the db parameter.
  $this->db = $db;
}

public function getMyItems($userId, $type) {
$return = array();
try{
//query to select matched results from table.
$qry = 'SELECT item_id, title, image FROM todo_items WHERE user_id = :user and completed = :type ORDER BY item_id';

$stmt  = $this->db->prepare($qry);

$stmt->execute(array(':user'=>$userId, ':type' => $type));

if($stmt->rowCount() > 0) {

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $return[] = $row;
  }
}

}
catch(Exception $e){
// if exception then rethrow exception
Throw new Exception($e->getMessage());
}
//return found results
return $return;
}

public function saveToDo($value) {

try{

  if(isset($value['task']) && !empty($value['task'])){
    $imageurl = '';
    // check if a file was selected to be uploaded.
    if(isset($_FILES['upload-filename']['name']) && !empty($_FILES['upload-filename']['name'])){
      //APP_IMAGE_PATH
    $imageurl =   $this->processFileUpload();
    $imageurl = 'static/image/' . $imageurl;
    }

  //query to update item as not completed.
  $qry = 'INSERT INTO  todo_items (user_id,title,completed,image, date_submitted) VALUES(:userid,:title,0,:imageurl,NOW())';

  $stmt  = $this->db->prepare($qry);

  $stmt->execute(array(':userid'=> $_SESSION['user'], ':title'=> $value['task'],':imageurl'=> $imageurl ));

  }
}
catch(Exception $e){
//rethrow the exception for front controller
Throw new Exception('problem adding todo. could not execute query.');
}

}

private function processFileUpload(){
  try {

    //check for error.
    if (
        !isset($_FILES['upload-filename']['error']) ||
        is_array($_FILES['upload-filename']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upload-filename']['error'] value.
    switch ($_FILES['upload-filename']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // check filesize here.
    if ($_FILES['upload-filename']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upload-filename']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['upload-filename']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true
    )) {
        throw new RuntimeException('Invalid file format.');
    }

    // generate unique name.
    // On this example, obtain safe unique name from its binary data.
    $fileName = sprintf('%s.%s',
        sha1_file($_FILES['upload-filename']['tmp_name']),
        $ext
    );
    $fileUrl = APP_IMAGE_PATH . $fileName;
    if (!move_uploaded_file(
        $_FILES['upload-filename']['tmp_name'], $fileUrl

    )) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

    return $fileName;

} catch (RuntimeException $e) {

    Throw new Exception( $e->getMessage());

}
}


public function markCompleted($id) {

  try{
    //query to update item as not completed.
    $qry = 'UPDATE  todo_items SET completed = 1 WHERE item_id = :value ';

    $stmt  = $this->db->prepare($qry);

    $stmt->execute(array(':value'=> $id ));

  }
  catch(Exception $e){
  //rethrow the exception for front controller
  Throw new Exception(' could not execute query.');
  }

}


public function markNotCompleted ($id) {

  try{
  //query to update item as not completed.
  $qry = 'UPDATE  todo_items SET completed = 0 WHERE item_id = :value ';

  $stmt  = $this->db->prepare($qry);

  $stmt->execute(array(':value'=> $id ));

  }
  catch(Exception $e){
  //rethrow the exception for front controller
  Throw new Exception('could not execute query.');
  }
}

}

 ?>
