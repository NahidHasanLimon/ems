<?php include_once'inc/header.php';  ?>
<?php 
$filepath = realpath(dirname(__FILE__));
if (empty($_POST['date_picker']) ){
$now = new DateTime();
$startDate= $now->format('Y-m').'-01';
$monthWise_attendance_Report_total_salary=$atn->monthly_emp_details_with_total_Salary($startDate);
   }
        else
        {
  $startDate=$_POST['date_picker'].'-01';
$monthWise_attendance_Report_total_salary=$atn->monthly_emp_details_with_total_Salary($startDate);
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


          <!-- Page Heading -->
          <h6 class="h4 mb-4 text-gray-800">Salary</h6>

     
          <!-- My Code -->
          <!-- Choosing Month -->
    <div class="row align-items-center justify-content-center">
      <div class="col-14 mb-2">
       <p> <h6 class="text-center"> <b>Monthly Salary Sheet </b></h6>
              <form class="form-inline" action="" method="post" autocomplete="off">
                    <input type="text" class="form-control" name="date_picker"id="date_picker" placeholder="Select your month..." style="width:75%;"/>
                        <button value="Search" name="search" id="search" class="form-control btn btn-info btn-sm ml-2" type="submit" onClick="return document.getElementById('date_picker').value !='' " style="width: 20%;"><i class="fas fa-search"></i></button>
                </form>
              </p>
      </div>
    </div>

 <!-- Choosing Month -->
 <h6 class="text-center" id="month" value="<?php
                  echo date('F , Y', strtotime($startDate));
                  ?>">  <b><?php
                  echo date('F , Y', strtotime($startDate));
                  ?></b> Details </h6>
 <!-- Display Choosen Month -->

           <div id="printDiv">
            <div class="" style="visibility: hidden">
            <h6>Salary Sheet Div</h6> 
          </div>
           <table class="table-responsive table-bordered" id="">
    <thead>
      <th class="text-xs-center">Emp ID</th>
      <th class="text-xs-center">Name</th>
      <th class="text-xs-center">Salary</th>
      <th class="text-xs-center">P</th>
       <th class="text-xs-center table-danger">A</th>
      <th class="text-xs-center">L</th>
      <th class="text-xs-center">M.Late</th>
     
      <th class="text-xs-center">H.Day</th>
      <th class="text-xs-center">S.Leave</th>
      <th class="text-xs-center">C.Leave</th>
      <th class="text-xs-center">Working Days</th>

      <th class="text-xs-center">P/D Salary</th>
      <th class="text-xs-center">Absent Ded.</th>
      <th class="text-xs-center">Pre.Late Ded.</th>
      <th class="text-xs-center">Post.Late Ded.</th>
      <th class="text-xs-center">Total Ded.</th>
      <th class="text-xs-center text-info table-primary" >Final Salary</th>
    </thead>
<?php 


// $attendanceSummary = array();
  if($monthWise_attendance_Report_total_salary)
{
  $empDetails = array();
  $expectedWorkingDays=23;
  while ($row=$monthWise_attendance_Report_total_salary->fetch_assoc()) {
    $empDetails[]=$row;

   }

   // if ($) {
   //   # code...
   // }
   foreach ($empDetails as $empDetail) {
    // print_r($empDetail);
    $emp_id=$empDetail['emp_id'];
    $name=$empDetail['first_name'].' '.$empDetail['last_name'];
    $totalWorkingDays=$empDetail['Total_working_Days'];
    $totalPresent=$empDetail['Presents'];
    $totalLate=$empDetail['Late'];
    $totalAbsent=$empDetail['Absents'];
    $totalHalfDay=$empDetail['HalfDay'];
    $totalMeetingLate=$empDetail['MeetingLate'];
    $totalSickLeave=$empDetail['SickLeave'];
    $totalCasualLeave=$empDetail['CasualLeave'];

    $finalSalary=0;
    
    $totalSalary=$empDetail['totalSalary'];
    $perDaySalary=($totalSalary/$expectedWorkingDays);
    $halfDaySalary=$perDaySalary/2;
    
    
  
    //preLateDeductSalary will deduct a half day salary only for first three days
    $preLateDeductSalary=$halfDaySalary;
    $postLateDeductSalary=0;
    $absentDeductSalary=$perDaySalary*$totalAbsent;
    $totalDeductSalary=0;

    if ($totalLate==3) {
      $totalDeductSalary=$preLateDeductSalary+$absentDeductSalary;
     
      $finalSalary=round($totalSalary-$totalDeductSalary);
    }
    elseif ($totalLate>3) {
       //postLateDeductSalary salary deduct for post late(totalLate-3)
      $postLate = $totalLate-3;
      $postLateDeductSalary=$postLate*$halfDaySalary; 

      $totalDeductSalary=$preLateDeductSalary+$postLateDeductSalary+$absentDeductSalary;
      $finalSalary=$totalSalary-$totalDeductSalary;

    }else if($totalLate<3){
      $preLateDeductSalary=0;
      $totalDeductSalary=$absentDeductSalary;
      $finalSalary=$totalSalary-$totalDeductSalary;

    }
    // echo $empDetail['emp_id'].' : '.$totalSalary.': '.$perDaySalary.' : '.$absentDeductSalary.' : '.$preLateDeductSalary.' : '.$postLateDeductSalary.' : '.$totalDeductSalary.' : '.$finalSalary.'</br>';
   ?>
  
    <tbody>
      <tr>
        <td><?php echo $emp_id; ?></td>
        <td> <a class="view_emp_modal" href="" id="<?php echo $emp_id; ?>"><?php echo $name; ?></a></td>
        <td><?php echo $totalSalary; ?></td>
        <td><?php echo $totalPresent; ?></td>
        <td class="table-danger"><?php echo $totalAbsent; ?></td>
        <td><?php echo $totalLate; ?></td>
        <td><?php echo $totalMeetingLate; ?></td>
        
        <td><?php echo $totalHalfDay; ?></td>
        <td><?php echo $totalSickLeave; ?></td>
        <td><?php echo $totalCasualLeave; ?></td>

         <td><?php echo $totalWorkingDays; ?></td>

        <td><?php echo round($perDaySalary,2); ?></td>
        <td><?php echo round($absentDeductSalary,2); ?></td>
        <td><?php echo round($preLateDeductSalary,2); ?></td>
        <td><?php echo round($postLateDeductSalary,2); ?></td>
        <td><?php echo round($totalDeductSalary,2); ?></td>
        <td class="table-primary"><?php echo round($finalSalary,2); ?></td>

      </tr>
    </tbody>
     
   
    
  <?php
   } }
  ?> 
  </table>
  


 </div>
 <button id="printButton">Print me</button>
                 <!-- My Code -->
        

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

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
include_once ($filepath.'/inc/partials/logoutModal.php'); 
include_once ($filepath.'/inc/modal/modal_view_employee.php'); 
 ?> 
<!-- Scripts -->
<?php 
include_once ($filepath.'/inc/partials/scripts.php'); 
 ?> 
<!-- Scripts -->
 <script type="text/javascript">
 
function printData()
{
   var divToPrint=document.getElementById("printDiv");
   newWin= window.open("");
   newWin.document.write('<html><head><title>Print Invoice</title>');
   newWin.document.write(divToPrint.innerHTML);
   newWin.print();
   newWin.close();
}

$('#printButton').on('click',function(){
// printData();
 OnClientClick=PrintPanel();
})

function PrintPanel() {
    var panel = document.getElementById("printDiv");
    var printWindow = window.open('', '', '');
    printWindow.document.write('<html><head><title>7TEEN-Salary Sheet</title>');
    
    // Make sure the relative URL to the stylesheet works:
    printWindow.document.write('<base href="' + location.origin + location.pathname + '">');
    
    // Add the stylesheet link and inline styles to the new document:
    printWindow.document.write('<link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.min.css">');
    printWindow.document.write('<link rel="stylesheet" href="css/sb-admin-2.min.css">');
    printWindow.document.write('<link rel="stylesheet" href="css/sb-admin-2.css">');
    printWindow.document.write('<style type="text/css">.style1{width: 100%;}</style>');
    
    printWindow.document.write('</head><body><h1>7TEEN Digital- Salary Sheet <?php echo $startDate; ?></h1>');
    printWindow.document.write(panel.innerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    setTimeout(function () {
        printWindow.print();
    }, 500);
    return false;
}
</script>
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
</script>
 <script src="inc/js/employee_details_in_modal.js"></script>
</body>

</html>
