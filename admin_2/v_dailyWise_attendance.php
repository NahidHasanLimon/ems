<?php include_once 'inc/header.php';  ?>
<!-- End of Header -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
       if (empty($_POST['date_picker']) ) {

  $now = new DateTime();

// $startDate= $now->format('Y-m').'-01';
$CurrentDate= $now->format('Y/m/d');
$startDate= date('Y-m-d', strtotime('-1 day', strtotime($CurrentDate)));
$monthWise_attendance_Report=$atn->employe_dailyWise_attendance_Report($startDate);


   }
        else
        {

  $startDate=$_POST['date_picker'];
$monthWise_attendance_Report=$atn->employe_dailyWise_attendance_Report($startDate);




      }

      ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

   <!-- Sidebar -->
    <?php include_once 'inc/partials/sidebar.php';  ?>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include_once 'inc/partials/nav-bar.php';  ?>
      <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          
           <!-- My Code -->
        
     <!-- Choosing Month -->
    <div class="row align-items-center justify-content-center">
      <div class="col-14 mb-2">
              <form class="form-inline" action="" method="post" autocomplete="off" >
<div class="form-check form-check-inline">
                    <input type="text" class="form-control" name="date_picker"id="date_picker" placeholder="Select your Date..." style="width:95%;">

                        <button value="Search" name="search" id="search" class="form-control btn btn-info btn-sm ml-2" type="submit" onClick="return document.getElementById('date_picker').value !='' " style="width: 20%;"><i class="fas fa-search"></i></button>
                    </span>
</div>
                </form>
              </p>

      </div>
    </div>

 <!-- Choosing Month -->
 <!-- Display Choosen Month -->
 <h6 class="text-center" id="month" value="<?php
                  echo date('F , Y,D', strtotime($startDate));
                  ?>">  <b>
                    <?php
                  echo date('d F , Y,D', strtotime($startDate));
                  // echo date('d F, Y');
                  ?> </h6>
  <!-- Display Choosen Month  -->
  <div class="card-body">
              <div class="table-responsive" id="monthAttendanceDiv">

                <table class="table table-sm table table-bordered " id="dataTable" width="100%" height="60%"cellspacing="0" >
                  <!-- style="background:#1b705b;" -->
                  <thead>
                    <tr>
                <th  style="width: 5px ">SL.</th>
                <th style=" max-width:65px; ">photo</th>
              <th class="text-center">name</th>
              <th class="text-center text-info">In Time</th>
              <th class="text-center text-danger">Out Time</th>
              <th class="text-center text-primary">Status</th>
              <th class="text-center text-primary">Worked Hours</th>
              <th class="text-center">Notes</th>

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
              <th   style="width: 5px ">SL.</th>
              <th style=" max-width:65px; ">photo</th>
              <th class="text-center">name</th>
              <th class="text-center text-info">In Time</th>
              <th class="text-center text-danger">Out Time</th>
              <th class="text-center text-primary">Status</th>
              <th class="text-center text-primary">Worked Hours</th>
              <th class="text-center">Notes</th>

                    </tr>
                  </tfoot>
                  <tbody>

 
        <?php

if($monthWise_attendance_Report)
{
  $i=0;
  while ($row=$monthWise_attendance_Report->fetch_assoc()) {
     $i++;
  ?>

      <tr>

        <td style="width: 5px "><?php echo  $i; ?></td>
        <td>
          <a href="#" class="view_emp_modal" id="<?php echo $row['emp_id'] ?>"><img src="../photo/<?php echo $row['photo'] ?>" width="65" height="60" /></a>
        </td>
        <td class="text-info name_modal" style="min-width: 150px;">
          <a href="#" class="view_emp_modal"id="<?php echo $row['emp_id'] ?>"><?php echo  $row['first_name']." ".$row['last_name'] ?><a href="#">
          </td>
        <td>
           <?php
            if ($row['c_in']==null) {
            echo $row['status'];
          }
          else {
              echo date('h:i a', strtotime($row['c_in']));
          }
          
             ?>

      </td>
        <td>
          <!-- <?php echo  $row['c_out']; ?> -->
          <?php 
          if ($row['c_out']==null) {
            echo $row['status'];
          }
          else {
            echo date('h:i a', strtotime($row['c_out'])); 
          }
         
          ?>

      </td>
        <td>
          <?php 
          if ($row['status']=='a') {
            echo " Absent";
          }
          elseif ($row['status']=='p') {
            echo " Present";
          }
          elseif ($row['status']=='ml') {
            echo " Meeting Late";
          }
          elseif ($row['status']=='l') {
            echo " Late";
          }
           elseif ($row['status']=='hd') {
            echo "Half Day";
          }
          elseif ($row['status']=='sl') {
            echo " Sick Leave";
          }
          elseif ($row['status']=='cl') {
            echo "Casual Leave";
          }
?>
      </td>
        <td>
          <?php 
          // echo 
          $time=$row['workedHours'];
          if ($time==0) {
            echo  $row['status'];
          }
          else{
            echo $time;
          }
          
          // echo strftime('%H:%M:%S',strtotime($time)); ;
           
          // echo round(abs($row['workedHours'] )) / 60,2). " minute";
      
           ?>
      </td>
        <td><?php echo  $row['notes']; ?></td>
     </tr>

<?php } } ?>


                  </tbody>

                </table>

              </div>
              
            </div>
          <!-- Datatable Month Attendance -->

        
        
   <!-- My Code -->
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
     
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
 <?php 
// include_once (  $baseUrl.'admin/inc/partials/logoutModal.php'); 
include_once ($filepath.'/inc/partials/logoutModal.php'); 
include_once ($filepath.'/inc/modal/modal_view_employee.php'); 
 ?> 
<!-- Scripts -->
<?php 
include_once ($filepath.'/inc/partials/scripts.php'); 
 ?> 
<!-- Scripts -->


 <script type="text/javascript">
    // for gijo picker 
      $('#date_picker').datepicker({ format: 'yyyy-mm-dd' });
   


$(document).ready(function(){
//  
 

 

   // Form Subitting Event

   
});
 

</script>
   <script src="inc/js/employee_details_in_modal.js"></script>

</body>

</html>
