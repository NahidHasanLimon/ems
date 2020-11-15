<?php include_once ('inc/header.php'); ?>
<?php 
$pageSlug="employees";
 ?>
 <?php 
  $employee_id=$_SESSION['emp_id'];
  $at_date=date("Y-m-d");
  $allCurrentEmployee=$usr->current_jobs_endDateisNull_all_employee_details();


  ?>
  <!-- Navigation -->
 
  <!-- Page Content -->
  <div class="container">
    <div class="col-lg-12 text-center">

   <h1 class="mt-2">Meet Our Team</h1>
   <hr style="border-top: 3px double #8c8b8b;">
</div>
    <div class="row">
      <?php if ($allCurrentEmployee) {
        while ($row=$allCurrentEmployee->fetch_assoc()) { ?>
       <div class="card m-2" style="width:250px">
  <img class="card-img-top" src="/ems/photo/<?php echo $row['photo'] ?>" alt="<?php echo $row['last_name'] ?>"  style=" height: 10rem;">
  <div class="card-body">
    <h4 class="card-title"><?php echo $row['first_name'].' '.$row['last_name']; ?></h4>
    <p class="card-text"><?php echo $row['all_des']; ?></p>
    <p class="card-text"><?php echo $row['email']; ?></p>
  </div>
</div> 

    <?php  }  }?>


  </div>
</div>
 

</body>

</html>
