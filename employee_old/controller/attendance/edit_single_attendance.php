 
<?php

 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Attendance.php'); 
  $usr= new User();
  $atn= new Attendance();
  ?>

 <?php  

 if (!empty($_POST) ){
  $atDate=$_POST['datepicker'];
  $post = $_POST;
  $checkArray =$_POST;
    $update_single_attendance=$atn->update_single_attendance($post);
    if ($update_single_attendance) {
     echo "$update_single_attendance";
    }
    else{
      echo "$update_single_attendance";
    }

  } 



 ?>
 