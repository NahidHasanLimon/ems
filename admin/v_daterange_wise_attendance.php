<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="date-range-wise-report"; ?>
<?php include_once('inc/header.php'); ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
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
 <!DOCTYPE html>
    <html dir="ltr" lang="en" class="no-outlines">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- ==== Document Title ==== -->
    <title><?php echo $pageSlug;?></title>
    
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- ==== Favicon ==== -->
    <link rel="icon" href="favicon.png" type="image/png">
    <?php include_once('inc/stylesheets.php'); ?>
</head>
<body>
     <div class="loader" ></div>
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Navbar Start -->
<?php include_once('inc/nav.php') ?>
        <!-- Navbar End -->

        <!-- Sidebar Start -->
<?php include_once('inc/sidebar.php') ?>
        <!-- Sidebar End -->

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Page Header Start -->
            <section class="page--header">
                 <h2 class="page--title h5"><?php echo $pageSlug;  ?></h2>
            </section>
            <!-- Page Header End -->


            <!-- Main Content Start -->
            <section class="main--content">
                <div class="container">
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

                <table class="table responsive table-striped table-dark table table-bordered text-center " id="dataTable" width="100%" height="60%"cellspacing="0" >
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
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->
 <?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/modal/modal_view_employee.php'); ?>
    <!-- Scripts -->
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/scripts.php') ?>
    <!-- Page Level Scripts -->
<script type="text/javascript">
    //for gijo picker $('#datepicker').datepicker({ format: 'yyyy-mm-dd' });
  $('#date_picker_startDate').datepicker({ format: 'yyyy-mm-dd' });
  $('#date_picker_endDate').datepicker({ format: 'yyyy-mm-dd' });
$(document).ready(function(){
$(".loader").fadeOut("slow");
});
 

</script>
 <script src="inc/js/employee_details_in_modal.js"></script>
</body>
</html>
