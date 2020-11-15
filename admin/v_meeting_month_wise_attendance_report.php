<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="meeting-month-attendance"; ?>
<?php include_once('inc/header.php'); ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    if (empty($_POST['date_picker']) ) {
  $now = new DateTime();
  $startDate= $now->format('Y-m').'-01';
$monthWise_attendance_Report=$atn->meeting_monthWise_attendance_Report($startDate);
   }
    else
        {
  $startDate=$_POST['date_picker'].'-01';
$monthWise_attendance_Report=$atn->meeting_monthWise_attendance_Report($startDate);
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
                <!-- My Code -->
  <!-- Choosing Month -->
    <div class="row align-items-center justify-content-center">
      <div class="col-14 mb-2">
       <p> <h6 class="text-center"> <b>Monthly Meeting Report </b></h6>
              <form class="form-inline" action="" method="post" autocomplete="off">
                    <input type="text" class="form-control" name="date_picker"id="date_picker" placeholder="Select your month..." style="width:75%;"/>
                        <button value="Search" name="search" id="search" class="form-control btn btn-info btn-sm ml-2" type="submit" onClick="return document.getElementById('date_picker').value !='' " style="width: 20%;"><i class="fas fa-search"></i></button>
                </form>
              </p>
      </div>
    </div>

 <!-- Choosing Month -->
 <!-- Display Choosen Month -->
 <h3 class="text-center" id="month" value="<?php
                  echo date('F , Y', strtotime($startDate));
                  ?>">  <b><?php
                  echo date('F , Y', strtotime($startDate));
                  ?></b> Details </h3>
 <!-- Display Choosen Month -->
  <div class="card-body">
    <input type="hidden" id="start_date" name="start_date" value="<?php echo $startDate  ?>"> 
              <div class="table-responsive" id="monthAttendanceDiv">
                <table class="table responsive table-striped table-dark table table-borderless text-center"  id="meetingReportTable" width="100%" height="60%"cellspacing="0" >
                  <!-- style="background:#1b705b;" -->
                  <thead >
                    <tr>
                <th class="text-center">SL.</th>
                <th class="text-center">Photo</th>
              <th class="text-center " colspan="1" >Name</th>
             <th class="text-center table-active">Presents</th>
              <th class="text-center table-activer">Absents</th>
              <th class="text-center table-active">Late</th>
              <th class="text-center table-active">MeetingLate</th>
              <th class="text-center table-active">CasualLeave</th>
              <th class="text-center table-active">SickLeave</th>
              <th class="text-center table-active">At_Count</th>
              <th class="text-center table-active">Total_Meeting_Days</th>
               <th class="text-center">Actions</th>

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
              <th class="text-center">SL.</th>
              <th class="text-center">Photo</th>
              <th class="text-center">Name</th>
              <th class="text-center table-active">Presents</th>
              <th class="text-center table-active">Absents</th>

              <th class="text-center table-active">Late</th>
              <th class="text-center table-active">MeetingLate</th>
              <th class="text-center table-active">CasualLeave</th>
              <th class="text-center table-active">SickLeave</th>
              <th class="text-center">At_Count</th>
              <th class="text-center table-active">Total_Meeting_Days</th>
               <th class="text-center">Actions</th>
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
        <!-- <td><img src="controller/employee/<?php echo $row['photo'] ?>" width="65" height="60" /></td> -->
        <td>
          <a href="#" class="view_emp_modal" id="<?php echo $row['emp_id'] ?>"><img src="../photo/<?php echo $row['photo'] ?>" width="65" height="60" /></a>
        </td>
        <td class="text-info name_modal" style="min-width: 150px;">
          <a href="#" class="view_emp_modal"id="<?php echo $row['emp_id'] ?>"><?php echo  $row['first_name']." ".$row['last_name'] ?><a href="#">
          </td>
       <input type="hidden" class="name" id="name" name="name" value="<?php echo  $row['first_name'].' '.$row['last_name']  ?>"/>
        <td class="text-center table-success" style="font-weight:900"><?php echo  $row['Presents']; ?></td>
        <td class="text-center table-danger" style="font-weight:900"><?php echo  $row['Absents']; ?></td>
          <td class="text-center table-warning" style="font-weight:900"><?php echo  $row['Late']; ?></td>
       <td class="text-center table-info" style="font-weight:900"><?php echo  $row['MeetingLate']; ?></td>
        <td class="text-center table-active" style="font-weight:900"><?php echo  $row['CasualLeave']; ?></td>
         <td class="text-center  table-info" style="font-weight:900"><?php echo  $row['SickLeave']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['Total_Attendance_Days']; ?></td>
        <td class="text-center table-success" style="font-weight:900"><?php echo  $row['Total_Meeting_Days']; ?></td>
        
        <td>
          <button type="button" name="view-attendance" value="View attendance" id="<?php echo $row['emp_id']; ?>" class="btn btn-primary btn-circle text-gray-100 view_attendance" /> <i class="fa fa-eye-slash" aria-hidden="true"></i> </button>
          </td>
     </tr>

<?php } } ?>
                  </tbody>

                </table>

              </div>
              
            </div>
          <!-- Datatable Month Attendance -->
   <!-- My Code -->
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->
<?php 
include_once ($filepath.'/inc/modal/modal_an_employee_monthly_attendance.php'); 
include_once ($filepath.'/inc/modal/modal_view_employee.php'); 
 ?>
    <!-- Scripts -->
<?php include_once('inc/scripts.php') ?>

    <!-- Page Level Scripts -->
    <script src="vendor/bootstrap/js/bootstrap-datepicker.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <script type="text/javascript">
    //for gijo picker $('#datepicker').datepicker({ format: 'yyyy-mm-dd' });
   

$("#date_picker").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
        }
    });
$(document).ready(function(){
  $(".loader").fadeOut("slow");

 $(document).on('click', '.view_attendance', function(){  
           var employee_id = $(this).attr("id"); 
           var start_date = $('#start_date').val();
           // var name = $('#name').val();
           // var name=$(this).closest('tr').find('#name').val();
           var name=$(this).closest('tr').find('#name').val();
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"controller/attendance/meeting_monthlyAllAttendance.php",  
                     method:"POST",  
                     data:{employee_id:employee_id,start_date:start_date},  
                     success:function(data){  

                          $('#modal-body').html(data);   
                          $('#modal-title').html(name);  
                          $('#allAttendanceModal').modal('show');  
                     }  
                });  
           }            
      });

   
});
 

</script>
  <script src="inc/js/employee_details_in_modal.js"></script>

</body>
</html>
