 
<?php

   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Department.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Designation.php'); 
  $usr= new User();
  $dep= new Department();
  $des= new Designation();
  ?>

 <?php  

  if (!empty($_POST['selectedEmployeeID']) && !isset($_POST["actionValue"])) {
      $selectedEmployeeID = $_POST["selectedEmployeeID"];  
     $result=$usr-> find_employee_info($selectedEmployeeID);
   
     if ($result) {
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);
      // echo $row;

     }
     else{
     
     }
    
  } 
  if (isset($_POST["actionValue"])) {
      $selectedEmployeeID = $_POST["selectEmployee"];  
     $result=$usr->terminate_employee($selectedEmployeeID);
   
     if ($result) {
      // $row = mysqli_fetch_array($result);  
      // echo json_encode($row);
      // // echo $row;
      echo $result;

     }
     else{
     
     }
    
  }

 ?>
