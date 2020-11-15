<?php include_once 'inc/header.php';  ?>
      <?php 
       $filepath = realpath(dirname(__FILE__));
       if (empty($_POST['date_picker_startDate']) && empty($_POST['date_picker_endDate'])) {

  $now = new DateTime();
  $startDate= $now->format('Y/m/d');
   $dateRange_attendance_Report=$atn->employee_lastThirtyDays_attendance_Report($startDate);


   }
        else
        {
  $startDate=$_POST['date_picker_startDate'];
  $endDate=$_POST['date_picker_endDate'];
$dateRange_attendance_Report=$atn->employee_dateRange_attendance_Report($startDate,$endDate);
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
      <div class="col-24 mb-2">

       <p> <h6 class="text-center"><b>Date Range Attendance Report</b></h6>
              <form class="form-inline" action="" method="post" autocomplete="off">

                    <input type="text" class="form-control" name="date_picker_startDate"id="date_picker_startDate" placeholder="Select Start Date..." style="width:70%;">

                     <input type="text" class="form-control ,l-2" name="date_picker_endDate"id="date_picker_endDate" placeholder="Select End Date..." style="width:70%;">
<!-- onClick="return document.getElementById('date_picker').value !='' " -->
          <button value="Search" name="search" id="search" class="form-control btn btn-info  btn-xs ml-2" type="submit"  style="width: 20%;"><i class="fas fa-search"></i></button>
                    </span>

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
                  if (!empty($_POST['date_picker_startDate']) && !empty($_POST['date_picker_endDate'])) {
                     echo date('d F , Y', strtotime($startDate));
                   echo '<span> -- </span>';
                   echo date('d F , Y', strtotime($endDate));
                  }
                  else{
                     echo date('d F , Y', strtotime($startDate));
                     echo '<span> Current month Data till Date</span>';

                  }
                  // echo date('d F, Y');
                  ?> </h6>
  <!-- Display Choosen Month  -->
  <div class="card-body">
              <div class="table-responsive" id="monthAttendanceDiv">

                <table class="table table-sm table table-bordered " id="dataTable" width="100%" height="60%"cellspacing="0" >
                  <!-- style="background:#1b705b;" -->
                  <thead>
                    <tr>
                <th class="text-center">SL.</th>
                <th class="text-center">photo</th>
              <th class="text-center">name</th>
              <th class="text-center text-info">Presents</th>
              <th class="text-center text-danger">Absents</th>
              <th class="text-center ">Half Day</th>
              <th class="text-center text-warning">Late</th>
              <th class="text-center">MeetingLate</th>
              <th class="text-center text-primary">CasualLeave</th>
              <th class="text-center">SickLeave</th>
              <th class="text-center text-success">Total_Attendance_Days</th>

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
              <th class="text-center">SL.</th>
              <th class="text-center">photo</th>
              <th class="text-center">name</th>
              <th class="text-center">Presents</th>
              <th class="text-center">Absents</th>
              <th class="text-center">HalfDay</th>
              <th class="text-center">Late</th>
              <th class="text-center">MeetingLate</th>
              <th class="text-center">CasualLeave</th>
              <th class="text-center">SickLeave</th>
              <th class="text-center">Total_Attendance_Days</th>
                    </tr>
                  </tfoot>
                  <tbody>

 
        <?php

if($dateRange_attendance_Report)
{
  $i=0;
  // employee_dateRange_attendance_Report
  while ($row=$dateRange_attendance_Report->fetch_assoc()) {
     $i++;
  ?>

      <tr>

        <td><?php echo  $i; ?></td>
         <td>
          <a href="#" class="view_emp_modal" id="<?php echo $row['emp_id'] ?>"><img src="../photo/<?php echo $row['photo'] ?>" width="65" height="60" /></a>
        </td>
        <td class="text-info name_modal" style="min-width: 150px;">
          <a href="#" class="view_emp_modal"id="<?php echo $row['emp_id'] ?>"><?php echo  $row['first_name']." ".$row['last_name'] ?><a href="#">
          </td>
       <input type="hidden" id="name" name="name" value="<?php echo  $row['emp_id']  ?>">
        <td class="text-center" style="font-weight:900"><?php echo  $row['Presents']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['Absents']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['HalfDay']; ?></td>
          <td class="text-center" style="font-weight:900"><?php echo  $row['Late']; ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  $row['MeetingLate']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['CasualLeave']; ?></td>
         <td class="text-center" style="font-weight:900"><?php echo  $row['SickLeave']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['Total_Attendance_Days']; ?></td>
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
    //for gijo picker $('#datepicker').datepicker({ format: 'yyyy-mm-dd' });
  $('#date_picker_startDate').datepicker({ format: 'yyyy-mm-dd' });
  $('#date_picker_endDate').datepicker({ format: 'yyyy-mm-dd' });
$(document).ready(function(){
//  
 

 

   // Form Subitting Event

   
});
 

</script>
 <script src="inc/js/employee_details_in_modal.js"></script>
  

</body>

</html>
