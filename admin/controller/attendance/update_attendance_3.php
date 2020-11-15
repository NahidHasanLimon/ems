
<?php
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Attendance.php'); 
  $usr= new User();
  $atn= new Attendance();
  ?>

 <?php  
if (!empty($_POST)) {
    $post = $_POST;
    $updateAttendanceBy_3=$atn->updateAttendanceBy_3($post);
    $updateMeetingAttendanceBy_3=$atn->updateMeetingAttendanceBy_3($post);
    if ($updateAttendanceBy_3){
      echo $updateAttendanceBy_3;
      echo $updateMeetingAttendanceBy_3;
    }
    else{
      echo $updateAttendanceBy_3;
    }
} 
 else {
   echo "empty";
}

 ?>
 