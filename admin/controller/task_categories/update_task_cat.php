<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Task.php');
$tsk= new Task();
?>
 <?php  
 if(!empty($_POST['hidden_update_task_cat_id']))
 {  
    $update_task_cat_id = $_POST["hidden_update_task_cat_id"];    
    $task_cat_name = $_POST["task_cat_name"];    
    $task_cat_description = $_POST["task_cat_description"];    
    $result=$tsk->update_task_category($update_task_cat_id,$task_cat_name,$task_cat_description);
     if($result){ 
      echo "success";
    }
    else{
        echo 'error';
    }
    }
  ?>
