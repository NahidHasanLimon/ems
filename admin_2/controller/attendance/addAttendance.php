 <?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Attendance.php'); 

  $usr= new User();
  $atn= new Attendance();
  ?>

 <?php  

 if (!empty($_POST) ){
  // print_r($_POST);
  // $checkArray= array();

  $atDate=$_POST['datepickerAttendance'];
  $post = $_POST;
  $checkArray = $_POST;
  //   $insertAttendance=$atn->add_attendance($post,$atDate);
  //   if ($insertAttendance){
  //    echo "$insertAttendance";
  //   }
  //   else{
  //     echo "$insertAttendance";
  //   }

  // } 
  // $add_daily_attendance= $atn->add_daily_attendance($post,$atDate);
  // $add_daily_meeting_attendance= $atn->add_daily_meeting_attendance($post,$atDate);
  // if ($add_daily_attendance && $add_daily_meeting_attendance) {
  //   echo $add_daily_both_attendance . " " . $add_daily_meeting_attendance;
  // }
  $add_daily_both_attendance= $atn->add_daily_both_attendance($post,$atDate);
  if ($add_daily_both_attendance) {
    echo $add_daily_both_attendance;
  }

}

 ?>
 