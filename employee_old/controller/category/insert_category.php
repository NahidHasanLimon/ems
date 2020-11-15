<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Task.php');
$tsk= new Task();
?>
 <?php  
 if(!empty($_POST))
 {  
    $category_title = $_POST["category_title"];  
    $category_description = $_POST["category_description"];  
    $result=$tsk-> add_category($category_title,$category_description);
     if($result){ 
      echo "Inserted SuccessFully";
    }
    else{
        echo 'Failed to Insert';
    }
    }
  ?>

  