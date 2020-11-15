<?php
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Department.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Designation.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/JobRole.php'); 
  $usr= new User();
  $dep= new Department();
  $des= new Designation();
  $jobRole= new JobRole();
   // <!-- This page request comes from find employee page vi ajax Request -->
  ?>

 <?php  

 if(isset($_POST["employee_id"]) && !empty($_POST["employee_id"]))  
{


  $employee_id=$_POST["employee_id"];

  if ( $employee_id!="" ) {

    // ..onlyCurrent Jobs
    $currentJobDetails=$usr->empoyees_all_info_with_current_jobrole_details($employee_id);
   
    if ($currentJobDetails) {
       $eData=array();

    while($row =$currentJobDetails->fetch_assoc()){ 
      
        $eData[] = $row;
     

    }

      echo json_encode($eData);
      exit();
      // echo json_encode($row);

    }
    else{
      echo "No Current Job Available";
      exit();
    }

  }

  
}
  if(!empty($_POST['allJobsEmployee_id'])) {
  
    $employee_id=$_POST["allJobsEmployee_id"];
   
    if ( $employee_id!="" ) {

    // ..only End Date Jobs
    $endJobDetails=$usr->an_employees_assigned_jobs_details_based_on_designation_endDate_is_not_Null($employee_id);
   
    if ($endJobDetails) {
       $eData=array();

    while($row =$endJobDetails->fetch_assoc()){ 
      
        $eData[] = $row;
     

    }

      echo json_encode($eData);
      exit();
      // echo json_encode($row);

    }
    else{
      $msg= "No Others Job Available";
      echo json_encode($msg);
      exit();
    }

  }
 }
 ?>
