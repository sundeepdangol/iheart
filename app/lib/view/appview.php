<?php
/**
* This is the main view generator for the app.
* This class has methods needed to generate different views needed for the app.
* @author Sundeep Dangol
*/

class appview {

public function showHeader() {
//include header
include APP_BASE_PATH . 'static' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'header.html';
}

public function showFooter() {
  //include header
  include APP_BASE_PATH . 'static' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'header.html';
}

public function displayError ($error) {

  $this->showHeader();
  $errorBody = <<<ERROR
  <div class="rows">
  <div class="col-sm-12 alert alert-danger">Error: $error</div>
  </div>
ERROR;

//display error body
echo $errorBody;

$this->showFooter();

}


public function displayInitialView($list = array(), $message = '') {

  $this->showHeader();
  $body = <<<BODY
  <div class="form-group container">
     <form action="index.php?action=add" method="post" enctype="multipart/form-data">
        <div class="row">
         <input type="text" class="form-control col-sm-6" placeholder="Enter your task here" name="task">
         <input type="file"  class="col-sm-6"  class="file" id="file" name="upload-filename">

       </div>
       <div class="row">

         <input type="submit" class="btn btn btn-primary span4 offset4" name="addtask" value="Add Task">
     </div>

     </form>

         </div>
BODY;

//display body
echo $body;
$this->displayAlert($message , 'alert alert-success');
$this->displayMyList($list);
$this->showFooter();

}

public function displayMyList($list = array(), $type=0) {

  $html = <<<ITEMS
  <div class="container">
  <div class="row">
  <div class="col-xs-12">
   <ol class="list-group">
ITEMS;
if(!empty($list) && $list !== false){
//now display the todo list data here.


foreach($list as $row){
  $title = $row['title'];
  $id = $row['item_id'];
  $image = $row['image'];
  $html .= '<li class="list-group-item">
        <p>' . $title . '&nbsp;&nbsp;<a href = "index.php?action=' . ($type == 0 ? 'completed':'notcompleted') . '&id=' . $id .'" class="btn btn-default"> mark as ' .($type == 0 ? 'completed':'not completed') .'</a> </p>';
if(!empty($image)){
  $html .= <<<YYY
  <a href = "#" class = "thumbnail">
            <img src = "$image" >
        </a>
YYY;


}

$html .= " </li>";
}

}
else {
  //display no items in list.
  $html .= <<<ROW
     <li class="list-group-item">
        <p>No items in list.</p>
     </li>
ROW;
}
$html .= <<<HTML
</ol>
</div>
</div>
</div>
HTML;

echo $html;
}

public function displayCompletedView ($list = array(), $message = '') {
$this->showHeader();
$this->displayAlert($message , 'alert alert-success');
$this->displayMyList($list,1);
$this->showFooter();
}

private function displayAlert($message = '', $cssClass=''){
  if(!empty($message)){
    echo '<div class="'. $cssClass.'">' . $message . '</div>';
  }
}
}
 ?>
