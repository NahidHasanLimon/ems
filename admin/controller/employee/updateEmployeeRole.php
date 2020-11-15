 
<?php

   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Department.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Designation.php'); 
  $usr= new User();
  $dep= new Department();
  $des= new Designation();
  ?>

 <?php  

  if (isset($_POST['selectEmployee']) && isset($_POST["selectEmployeeRole"])) {
      $selectedEmployeeID = $_POST["selectEmployee"];  
      $selectedEmployeeRole = $_POST["selectEmployeeRole"];  
     $result=$usr-> update_employee_role($selectedEmployeeID,$selectedEmployeeRole);
   
     if ($result) {
      echo 'success';

     }
     else{
     echo $result;
     }
    
  } 
  

 ?>
