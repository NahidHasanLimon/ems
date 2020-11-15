 
<?php
error_reporting(0);
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Attendance.php'); 
  $usr= new User();
  $atn= new Attendance();
  ?>

 <?php  

if (!empty($_POST)) {
   $post = $_POST;
 $approvedAttendanceBy_3=$atn->approvedAttendanceBy_3($post);
  $approveMeetingAttendanceBy_3=$atn->approveMeetingAttendanceBy_3($post);
    if ($approvedAttendanceBy_3 &&   $approveMeetingAttendanceBy_3) {
      echo $approvedAttendanceBy_3;
      echo   $approveMeetingAttendanceBy_3;
    }
    else{
      echo $approvedAttendanceBy_3;
    }
} else {
   echo "empty";
}




 ?>
 