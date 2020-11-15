<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="employee-list"; ?>
<?php include_once('inc/header.php'); ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    if (empty($_POST['date_picker']) ) {
  $now = new DateTime();
  $startDate= $now->format('Y-m').'-01';
  // print_r($calculatetotalDaysY);
$monthly_attendance_sheet=$atn->employe_monthly_attendance_sheet($startDate);
   }
    else
        {
   $startDate=$_POST['date_picker'].'-01';
   $startDate2=$_POST['date_picker'].'-01';
$monthly_attendance_sheet=$atn->employe_monthly_attendance_sheet($startDate);
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

       <p> <h6 class="text-center"><b>Monthly Attendance Sheet</b></h6>
              <form class="form-inline" action="" method="post" autocomplete="off">

                    <input type="text" class="form-control" name="date_picker"id="date_picker" placeholder="Select your month..." style="width:75%;">

                        <button value="Search" name="search" id="search" class="form-control btn btn-info btn-sm ml-2" type="submit" onClick="return document.getElementById('date_picker').value !='' " style="width: 20%;"><i class="fas fa-search"></i></button>
                    </span>

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
 <!-- totalDays of Month -->
 <?php
 ?>

<!-- totalDays of Month --> 

  <div class="card-body">
              <div class="table-responsive" id="monthAttendanceDiv">

                <table class="table table-sm table table-bordered " id="dataTable" width="100%" height="60%"cellspacing="0" >
                  <!-- style="background:#1b705b;" -->
                  <thead>
                    
                    <tr>
              <th class="text-center">SL.</th>
              <th class="text-center">photo</th>
              <th class="text-center">name</th>

              <th class="text-center text-info">1</th>
              <th class="text-center text-info">2</th>
              <th class="text-center text-info">3</th>
              <th class="text-center text-info">4</th>
              <th class="text-center text-info">5</th>
              <th class="text-center text-info">6</th>
              <th class="text-center text-info">7</th>
              <th class="text-center text-info">8</th>
              <th class="text-center text-info">9</th>
              <th class="text-center text-info">10</th>
              <th class="text-center text-info">11</th>
              <th class="text-center text-info">12</th>
              <th class="text-center text-info">13</th>
              <th class="text-center text-info">14</th>
              <th class="text-center text-info">15</th>
              <th class="text-center text-info">16</th>
              <th class="text-center text-info">17</th>
              <th class="text-center text-info">18</th>
              <th class="text-center text-info">19</th>
              <th class="text-center text-info">20</th>
              <th class="text-center text-info">21</th>
              <th class="text-center text-info">22</th>
              <th class="text-center text-info">23</th>
              <th class="text-center text-info">24</th>
              <th class="text-center text-info">25</th>
            
              <th class="text-center text-info">26</th>
              <th class="text-center text-info">27</th>
              <th class="text-center text-info">28</th>
              <th class="text-center text-info">29</th>
              <th class="text-center text-info">30</th>
              <th class="text-center text-info">31</th>
              
              <th class="text-center text-success">Presents</th>
              <th class="text-center text-success">Absents</th>
              <th class="text-center text-success">Half Day</th>
              <th class="text-center text-success">Late</th>
              <th class="text-center text-success">Meeting Late</th>
              <th class="text-center text-success">Casual Leave</th>
              <th class="text-center text-success">Sick Leave</th>
              

                    </tr>
                  </thead>
           
                  <tbody>

 
      <?php
  
if($monthly_attendance_sheet)
{
  $i=0;
  while ($row=$monthly_attendance_sheet->fetch_assoc()) {
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

 

       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day1']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day2']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day3']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day4']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day5']); ?></td>

       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day6']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day7']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day8']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day9']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day10']); ?></td>

       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day11']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day12']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day13']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day14']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day15']); ?></td>

       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day16']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day17']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day18']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day19']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day20']);; ?></td> 


       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day21']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day22']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo strtoupper($row['day23']);; ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day24']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day25']); ?></td>

       <td class="text-center" style="font-weight:900"><?php echo strtoupper($row['day26']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo strtoupper($row['day27']); ?></td>
       <td class="text-center" style="font-weight:900"><?php echo strtoupper($row['day27']);; ?></td>
       <td class="text-center" style="font-weight:900"><?php echo strtoupper($row['day29']);; ?></td>
       <td class="text-center" style="font-weight:900"><?php echo strtoupper($row['day30']); ?></td>


       <td class="text-center" style="font-weight:900"><?php echo  strtoupper($row['day31']); ?></td>
     
    
        <td class="text-center" style="font-weight:900"><?php echo  $row['totalPresent']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['totalAbsent']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['totalHalfDay']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['totalLate']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['totalMeetingLate']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['totalCasualLeave']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['totalSickLeave']; ?></td>
        
       
       
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
<?php include_once ($filepath.'/inc/modal/modal_view_employee.php');  ?>
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
   
});
 

</script>
    <script src="inc/js/employee_details_in_modal.js"></script>

</body>
</html>
