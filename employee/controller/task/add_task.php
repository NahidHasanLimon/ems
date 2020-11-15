<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Task.php');
$tsk= new Task();
?>
 <?php  
 if(!empty($_POST))
 {
  if (empty($_POST['t_name']) || empty($_POST['t_start_date']) || empty($_POST['t_end_date']) ) {
    echo "field can not be empty";
  }else{
     $result=$tsk->add_task();
     if($result){ 
      echo 'success';
    }
    else{
        echo 'error';
    }
  
  }
}
  ?>

  