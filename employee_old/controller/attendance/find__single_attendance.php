 
<?php
 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Attendance.php'); 
  $atn= new Attendance();
  ?>
 <?php  
 

 if( !empty($_POST["at_date"]) && !empty($_POST["selectedEmployeeID"]) ) 
{
  // print_r($_POST);
  $at_date=$_POST['at_date'];
  $employee_id=$_POST['selectedEmployeeID'];
  $find_single_attendance=$atn-> find_single_attendance($employee_id,$at_date);
  if ($find_single_attendance) {
    // $row = mysqli_fetch_assoc($find_single_attendance);  
    $row = mysqli_fetch_array($find_single_attendance);  
    echo json_encode($row);
  }
  else{
    echo "nothing";
  }
  
}




 ?>
