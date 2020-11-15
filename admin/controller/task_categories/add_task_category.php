<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Task.php');
$tsk= new Task();
?>
 <?php  
 if(!empty($_POST))
 {  
    $task_cat_name = $_POST["task_cat_name"];  
    $task_cat_description = $_POST["task_cat_description"];  
    $result=$tsk-> add_task_category($task_cat_name,$task_cat_description);
     if($result){ 
      echo "Inserted SuccessFully";
    }
    else{
        echo 'Failed to Insert';
    }
    
    }
  ?>

  