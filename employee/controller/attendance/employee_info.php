
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

 if(isset($_POST["employee_id"]) && empty($_POST["employee_id"]))  
{

  $employee_id=$_POST["employee_id"];

  if ( $employee_id!="" ) {
    $find_employee_by_id=$usr->find_employee_info($employee_id);
    if ($find_employee_by_id) {
       $eData=array();

    while($row =$find_employee_by_id->fetch_assoc()){ 
      
        $eData[] = $row;
     

    }
      echo json_encode($eData);

    }
    else{
      echo "No Employee Available";
    }

  }

  

  
}

 ?>
