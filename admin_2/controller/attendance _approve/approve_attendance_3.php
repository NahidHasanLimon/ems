 
<?php
// move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file

// move_uploaded_file($_FILES["file-input"]["tmp_name"],"upload/".$_FILES["file-input"]["name"]); 
// $filepath = realpath(dirname(__FILE__));
  // include_once ($filepath.'/../../classes/User.php');
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Attendance.php'); 
  $usr= new User();
  $atn= new Attendance();
  ?>

 <?php  

// if( !empty($_POST) )
// {
// // $length= $_POST.length();
// print_r($_POST);
// // print_r($_POST['employeeID'][0]);
// // print_r($length);
// echo count(array_keys($_POST));
// // count($_POST['date_range'])
// echo count($_POST['employeeID']);
// }

 if (!empty($_POST) ){
  $checkArray= array();

  $atDate=$_POST['datepickerAttendance'];
  $post = $_POST;
  $checkArray = $_POST;
  // print_r($checkArray);
  // print_r(count($checkArray[employeeID]));
  // print_r($post);
    $insertAttendance=$atn->add_attendance($post,$atDate);
    if ($insertAttendance) {
     echo "Successfully";
    }
    else{
      echo "ok";
    }

  } 



 ?>
 