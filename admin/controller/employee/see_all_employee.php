
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




    // ..unEmployed Jobs
    $all_unEmployed_employee_details=$usr->all_unEmployed_employee_details();
   
    if ($all_unEmployed_employee_details) {
       $eData=array();

    while($row =$all_unEmployed_employee_details->fetch_assoc()){ 
      
        $eData[] = $row;
     

    }

      echo json_encode($eData);
      exit();
      // echo json_encode($row);

    }
    else{
      echo "no others employee Available";
      exit();
    }


  

  
 ?>
