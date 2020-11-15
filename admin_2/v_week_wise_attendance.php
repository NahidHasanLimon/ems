<?php include_once 'inc/header.php';?>
<?php 
$filepath = realpath(dirname(__FILE__));
if (empty($_POST['date_picker']) ) {
$now = new DateTime();
// $startDate= $now->format('Y-m').'-01';
$CurrentDate= $now->format('Y/m/d');
$startDate= date('Y-m-d', strtotime('-6 day', strtotime($CurrentDate)));
 // print_r($startDate);
$monthWise_attendance_Report=$atn->employe_weekly_attendance_sheet($startDate);


   }
        else
        {
  // $startDate=$_POST['date_picker'].'-01';
          // $startDate=$_POST['date_picker'];
          $CurrentDate=$_POST['date_picker'];
          $startDate= date('Y-m-d', strtotime('-6 day', strtotime($CurrentDate)));
          // print_r($startDate);

$monthWise_attendance_Report=$atn->employe_weekly_attendance_sheet($startDate);




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
        <p> <h6 class="text-center"><b>Weekly Attendance Report</b></h6>
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
 <!-- Display Choosen Month -->
 <h6 class="text-center" id="month" value="<?php
                  echo date('F , Y,D', strtotime($startDate));
                  ?>">  <b>
                    <?php
                  echo date('d F , Y,D', strtotime($CurrentDate));
                  // echo date('d F, Y');
                  ?> </h6>
                  <!-- new -->
                  <h6 class="text-center" id="month" value="<?php
                  echo date('F , Y,D', strtotime($startDate));
                  ?>">  <b>
                    <?php
                  if (!empty($_POST['date_picker']) ) {

                     echo date('d F , Y', strtotime($startDate));
                      echo' <span> - </span> ';
                  
                   echo date('d F , Y', strtotime($CurrentDate));
                  }
                  else{
                     echo '<span>Last 7 Days From  </span>';
                     echo date('d F , Y', strtotime($CurrentDate));
                    

                  }
                  // echo date('d F, Y');
                  ?> </h6>
                  <!-- new -->
  <!-- Display Choosen Month  -->
 <!-- Display Choosen Month -->
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
              <th class="text-center">Half Day</th>
              <th class="text-center">MeetingLate</th>
              <th class="text-center">Late</th>
              <th class="text-center text-primary">CasualLeave</th>
              <th class="text-center">SickLeave</th>
             
              <th class="text-center text-success">Total_Attendance_Days</th>
               <!-- <th class="text-center">Actions</th> -->

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
              <th class="text-center">SL.</th>
              <th class="text-center">photo</th>
              <th class="text-center">name</th>
              <th class="text-center">Presents</th>
              <th class="text-center">Absents</th>
              <th class="text-center">Half Day</th>
              <th class="text-center">MeetingLate</th>
              <th class="text-center">Late</th>
              <th class="text-center">CasualLeave</th>
              <th class="text-center">SickLeave</th>
              
              <th class="text-center">Total_Attendance_Days</th>
               <!-- <th class="text-center">Actions</th> -->
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
        
       
       
       <!--  <td>
          <button type="button" name="view-attendance" value="View attendance" id="<?php echo $row['id']; ?>" class="btn btn-info btn-xs view_attendance" /> <i class="fa fa-eye-slash" aria-hidden="true"></i> </button>
          </td> -->
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


 <script type="text/javascript">
    //for gijo picker $('#datepicker').datepicker({ format: 'yyyy-mm-dd' });
   

 $('#date_picker').datepicker({ format: 'yyyy-mm-dd' });
$(document).ready(function(){
//  
 

 

   // Form Subitting Event

   
});
 

</script>
   <script src="inc/js/employee_details_in_modal.js"></script>

</body>

</html>
