<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/employee/classes/Task.php');
$tsk= new Task();
?>
 <?php  
 if( isset($_POST['start_task_id']) && !empty($_POST['start_task_id']))
 {  
    $start_task_id = $_POST["start_task_id"];   
    $result=$tsk->start_task($start_task_id);
     if($result){ 
      echo "success";
    }
        else{
            echo "error";
        }
    } 
    else if( isset($_POST['end_task_id']) && !empty($_POST['end_task_id']) )
   {  
    $end_task_id = $_POST["end_task_id"];   ;   
    $result=$tsk->end_task($end_task_id);
     if($result){ 
      echo "success";
      } 
    else{
        echo 'error';
      }
    }
    else if( isset($_POST['statusChangeTaskID']) && !empty($_POST['statusChangeTaskID']) && isset($_POST['selectedTaskStatus']) && !empty($_POST['selectedTaskStatus'])  )
   {  
    $statusChangeTaskID = $_POST["statusChangeTaskID"];   
    $selectedTaskStatus = $_POST["selectedTaskStatus"];   
    $result=$tsk->update_task_status($statusChangeTaskID,$selectedTaskStatus);
     if($result){ 
      echo "success";
      } 
    else{
        echo 'error';
      }
    }
  ?>
