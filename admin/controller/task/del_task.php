<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Task.php');
$pro= new Task();
?>
 <?php  
 if(!empty($_POST['del_task_id']))
 {  
    $del_task_id = $_POST["del_task_id"];   
    $result=$pro->delete_task($del_task_id);
     if($result){ 
      echo'success';
    }
    else{
        echo'error';
    }
    }
  ?>
