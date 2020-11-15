<?php include_once ('inc/header.php'); ?>
 <?php 
  $employee_id=$_SESSION['emp_id'];
  $at_date=date("Y-m-d");
  // print_r($at_date);
  $jobDetails= $usr->an_employees_assigned_jobs_details_based_on_designation($employee_id);
  $atDetails=$usr->employees_attendance_for_particular_date_and_employee($employee_id,$at_date);


  ?>
  <!-- Navigation -->
 
  <!-- Page Content -->
  <div class="container">
    <div class="row">
     
       
  </div>
</div>
 

</body>

</html>
