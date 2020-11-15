<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Task.php');
$tsk= new Task();
?>
 <?php  
 if( isset($_POST['approve_task_id']) && !empty($_POST['approve_task_id']))
 {  
    $approve_task_id = $_POST["approve_task_id"];   
    $result=$tsk->approve_task($approve_task_id);
     if($result){ 
      echo "success";
    }
    else{
        echo 'error';
    }
    } 
    if( isset($_POST['approve_all_task_ids']) && !empty($_POST['approve_all_task_ids']) )
 {  
    $approve_all_task_ids = $_POST["approve_all_task_ids"];   
    // var_dump($approve_all_task_ids);
    $result=$tsk->approve_all_task($approve_all_task_ids);
     if($result){ 
      echo "success";
    }
    else{
        echo 'error';
    }
    }
  ?>
