<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Task.php');
$tsk= new Task();
?>
 <?php  
 if(!empty($_POST['del_task_cat_id']))
 {  
    $del_task_cat_id = $_POST["del_task_cat_id"];   
    $result=$tsk->delete_task_category($del_task_cat_id);
     if($result){ 
      echo "success";
    }
    else{
        echo 'error';
    }
    }
  ?>
