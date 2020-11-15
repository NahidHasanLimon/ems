 
<?php

   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Department.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Designation.php');
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/JobRole.php');  
  $usr= new User();
  $dep= new Department();
  $des= new Designation();
  $jobRole= new JobRole();
  ?>

 <?php  
 // print_r($_POST);

  if (isset($_POST) && !empty($_POST['hidden_jobRoleID']) ) {
  
      $designation_id = $_POST["selectDesignation"];  
      $job_nature = $_POST["job_nature"];  
      $salary = $_POST["salary"];  
      $notes = $_POST["notes"];  
      $employee_id = $_POST["hidden_employee_id"];  
      $jobRoleID = $_POST["hidden_jobRoleID"];  
      $start_date = $_POST["start_date"];  
      $end_date = $_POST["end_date"];  
     $result=$jobRole->edit_employee_job_role($employee_id,$designation_id,$job_nature,$salary,$notes,$jobRoleID,$start_date,$end_date);
     if ($result) {
       echo $result;
     }
     else{
      echo "error";
     }
   
  }

 ?>
