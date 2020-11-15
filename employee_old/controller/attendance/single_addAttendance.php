 
<?php

 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Attendance.php'); 
  $usr= new User();
  $atn= new Attendance();
  ?>

 <?php  

 if (!empty($_POST) ){
  // print_r($_POST);
  // $checkArray= array();

  $atDate=$_POST['datepicker'];
  $post = $_POST;
  $checkArray = $_POST;
    $insertAttendance=$atn->add_single_attendance($post,$atDate);
    if ($insertAttendance) {
     echo "$insertAttendance";
    }
    else{
      echo "$insertAttendance";
    }

  } 



 ?>
 