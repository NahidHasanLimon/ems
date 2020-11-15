 
<?php
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Attendance.php'); 
  $usr= new User();
  $atn= new Attendance();
  ?>

 <?php  
 if (!empty($_POST)) {
   $post = $_POST;
 $app_at_by_2=$atn->approvedAttendanceBy_2($post);
    if ($app_at_by_2) {
      echo $app_at_by_2;
    }
    else{
      echo $app_at_by_2;
    }
}
 else {
   echo "empty";
}
 ?>
 