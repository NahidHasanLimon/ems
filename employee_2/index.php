<?php include_once ('inc/header.php'); ?>
 <?php 
  $employee_id=$_SESSION['emp_id'];
  $at_date=date("Y-m-d");
  // print_r($at_date);
  $jobDetails= $usr->empoyees_all_info_with_current_jobrole_details($employee_id);
  $atDetails=$usr->employees_attendance_for_particular_date_and_employee($employee_id,$at_date);


  ?>
  <!-- Navigation -->
 
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-3">Welcome</h1>
        <img class="card-img-top" src="/ems/photo/<?php echo $_SESSION['photo'] ?>" alt="Card image"  style=" height:15rem; width: 15rem;">
       
        <p class="lead"><strong><?php echo $_SESSION['first_name'].' '. $_SESSION['last_name'] ?></strong></p>
        <!-- start of job Details -->
         <div class="card justify-content-center">
          <h6>
            <strong>Current Job Details  </strong>
          </h6>

          <?php if ($jobDetails) { ?>
         <table class="table-bordered table-responsive"> 
           <thead>
          <td>Sl#</td>
          <td>Designation</td>
          <td>Department</td>
          <td>Company</td>
          <td>Salary</td>
          <td>Start Date</td>
          <td>End Date</td>
        </thead>
         <tbody>
        <?php
        $i=1;
      while($row=$jobDetails->fetch_assoc()){
      ?>
     
       
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['des_name']; ?></td>
            <td><?php echo $row['dep_name']; ?></td>
            <td><?php echo $row['comp_name']; ?></td>
            <td><?php echo $row['salary']; ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
          </tr>
      
   <?php  $i++;  } ?>
          </tbody>
            </table>
     <?php  }
  else{
    echo "No Job Yet";
  } ?>
        </div>
         <!-- end of job Details -->
         <!-- start of attendance -->
         <div class="card justify-content-center mt-5">
           <h6>
            <strong> Todays Attendace ( <?php echo date("Y-m-d") ?> )</strong>
          </h6>
            <div class="card-body">
            <?php if ($atDetails) {
           ?>
              <table class="table-bordered">
                <thead>
                  <td>Date</td>
                  <td>Day</td>
                  <td>Check_in</td>
                  <td>Check_out</td>
                  <td>Status</td>
                  <td>Notes</td>
                </thead>
                <tbody>
                  <?php while ($rowAtn=$atDetails->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo $rowAtn['at_date']; ?></td>
                      <td><?php echo  date("l",strtotime($rowAtn['at_date'])); ?></td>
                      <td><?php echo ($rowAtn['c_in']=='') ? strtoupper($rowAtn['status']): date('h:i A', strtotime($rowAtn['c_in']));?></td>
                      <td><?php echo ($rowAtn['c_out']=='') ? strtoupper($rowAtn['status']) : date('h:i A', strtotime($rowAtn['c_out']));?></td>
                      <td><?php
                     if ($rowAtn['status']=='p') {
                       echo "Present";
                    }else if ($rowAtn['status']=='a') {
                    echo "Absent";
                    } else if ($rowAtn['status']=='sl') {
                     echo "Sick Leave";
                    }else if ($rowAtn['status']=='cl') {
                      echo "Casual Leave";
                    }  else if ($rowAtn['status']=='ml') {
                      echo "Meeting Late";
                    }  else if ($rowAtn['status']=='ol') {
                      echo "Others Late";
                    }  else {
                      echo strtoupper($rowAtn['status']);
                    }
                    ?>
                      <td><?php echo $rowAtn['notes']; ?></td>
                    </tr>

                  <?php   } ?>
                </tbody>
              </table>
            <?php } else 
            { echo '<h6> <strong>No Attendance available!</strong> </h6>';}?>
              
            </div>
         </div>
         <!-- end of attendance -->

        <ul class="list-unstyled">
         <!--  <li>Bootstrap 4.3.1</li>
          <li>jQuery 3.4.1</li> -->
        </ul>
      </div>
    </div>
  </div>
<?php 
 ?>
 

</body>

</html>
