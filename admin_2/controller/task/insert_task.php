<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Task.php');
$tsk= new Task();
?>
 <?php  
 if(!empty($_POST))
 {  
    $task_title = $_POST["task_title"];  
    $task_description = $_POST["task_description"];  
    $result=$tsk-> add_task($task_title,$task_description);
     if($result){ 
      echo "Inserted SuccessFully";
    }
    else{
        echo 'Failed to Insert';
    }
    }
  ?>

  