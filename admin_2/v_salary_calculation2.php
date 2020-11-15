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
      <!-- <th class="text-xs-center">Emp ID</th> -->
      <th class="text-xs-center">Sl#</th>
      <th class="text-xs-center">Name</th>
      <th class="text-xs-center">Salary</th>
      <th class="text-xs-center">P</th>
       <th class="text-xs-center table-danger">A</th>
      <th class="text-xs-center">L</th>
      <th class="text-xs-center">Leave</th>

      <!-- <th class="text-xs-center">M.Late</th> -->
    <!--   <th class="text-xs-center">H.Day</th>
      <th class="text-xs-center">S.Leave</th>
      <th class="text-xs-center">C.Leave</th>
      <th class="text-xs-center">Working Days</th> -->

      <th class="text-xs-center">P/D Salary</th>
      <th class="text-xs-center">Absent Ded.</th>
      <th class="text-xs-center">Late Ded.</th>
      <th class="text-xs-center">Total Ded.</th>
      <th class="text-xs-center text-info table-primary" >Added. Sal</th>
      <th class="text-xs-center text-info table-primary" >Sub. Sal</th>
      
      <th class="text-xs-center text-info table-warning" >CEO</th>
      <th class="text-xs-center text-info table-info" >Final</th>
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
  $i=0;
   foreach ($empDetails as $empDetail) {
$i++;
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

    $totalLeave=$totalCasualLeave+$totalSickLeave;

    $finalSalary=0;
    
    $totalSalary=$empDetail['totalSalary'];
    $perDaySalary=($totalSalary/$expectedWorkingDays);
    $halfDaySalary=$perDaySalary/2;
    
    
  
    //preLateDeductSalary will deduct a half day salary only for first three days
    $preLateDeductSalary=$halfDaySalary;
    $postLateDeductSalary=0;
    $absentDeductSalary=$perDaySalary*$totalAbsent;
    $totalDeductSalary=0;
    $totalAddedSalary=$totalHalfDay*halfDaySalary;
    $numberOfLateForDeduct=floor($totalLate/3);
    // var_dump($numberOfLateForDeduct);

     if ($totalLate>=3) {
      $totalLateDeductSalary=$halfDaySalary*$numberOfLateForDeduct;
      $totalDeductSalary=$absentDeductSalary+$totalLateDeductSalary;
      

      $finalSalary=($totalSalary-$totalDeductSalary)+$totalAddedSalary;
      if ($finalSalary>$totalSalary) {
        $finalSalary=$totalSalary;
      }
    }

    else if($totalLate<3){
      $totalLateDeductSalary=0;
      $totalDeductSalary=$absentDeductSalary;
      $finalSalary=$totalSalary-$totalDeductSalary;
      $finalSalary=($totalSalary-$totalDeductSalary)+$totalAddedSalary;

      if ($finalSalary>$totalSalary) {
        $finalSalary=$totalSalary;
      }

    }
   ?>
  
    <tbody>
      <tr>
        <!-- <td><?php echo $emp_id; ?></td> -->
        <td><?php echo $i; ?></td>
        <td> <a class="view_emp_modal" href="" id="<?php echo $emp_id; ?>"><?php echo $name; ?></a></td>
        <td class="jobRole_salary"><?php echo $totalSalary; ?></td>
        <td><?php echo $totalPresent; ?></td>
        <td class="table-danger"><?php echo $totalAbsent; ?></td>
        <td><?php echo $totalLate; ?></td>
        <td><?php echo $totalLeave; ?></td>

        <!-- <td><?php echo $totalMeetingLate; ?></td> -->
       <!--  <td><?php echo $totalHalfDay; ?></td>
        <td><?php echo $totalSickLeave; ?></td>
        <td><?php echo $totalCasualLeave; ?></td>
         <td><?php echo $totalWorkingDays; ?></td> -->

        <td><?php echo round($perDaySalary,2); ?></td>
        <td><?php echo round($absentDeductSalary,2); ?></td>
        <!-- <td><?php echo round($preLateDeductSalary,2); ?></td> -->
        <td><?php echo round($totalLateDeductSalary,2); ?></td>
        <td><?php echo round($totalDeductSalary,2); ?></td>
        <td class="table-info sub_final_salary"><?php echo round($totalAddedSalary,2); ?></td>
        <td class="table-primary sub_final_salary"><?php echo round($finalSalary,2); ?></td>
        
        <td class="table-primary">
          <input type="number" class="ceo_update" id="ceo_update" name="ceo_update" value="0.0">
        </td>
        <td class="table-primary">
          <input type="text" class="final_salary" id="final_salary" name="final_salary" readonly="true" value="<?php echo round($finalSalary,2); ?>" >
        </td>

      </tr>
    </tbody>
     
   
    
  <?php
   }}
  ?> 
  </table>
  


 </div>
   <button id="printButton" class="btn btn-danger float-right mr-5 mb-3"><i class="fas fa-print"></i>Print</button>
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
    
    printWindow.document.write('</head><body><center><h6>7TEEN Digital- Salary Sheet</h6></center><center><?php  echo date('F , Y', strtotime($startDate));;?></center>');
    printWindow.document.write(panel.innerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    setTimeout(function () {
        printWindow.print();
    }, 500);
    return false;
}
</script>
<script>
  $(document).ready(function(){
  $('.ceo_update').keyup(function() {
    var ceo_updateSalary = parseFloat($(this).val());
    var jobRole_salary=parseFloat($(this).closest('td').prev('.jobRole_salary').text());
    var sub_final_salary=parseFloat($(this).closest('td').prev('.sub_final_salary').text());
    var final_salary= parseFloat((sub_final_salary + ceo_updateSalary));
    if (final_salary>jobRole_salary) {
      alert("Exceed");
       $(this).val('');
      final_salary=jobRole_salary;
    }

    if (ceo_updateSalary!='') {
    $(this).closest('tr').find('.final_salary').val(final_salary);
    }else if(ceo_updateSalary==''){
      $(this).closest('tr').find('.final_salary').val(sub_final_salary);
    }
    if(isNaN(ceo_updateSalary)) {
    $(this).closest('tr').find('.final_salary').val(sub_final_salary);
      }
   


    // alert(sub_salary);

    $(this).closest('tr').find('.sub_salary').val('');
    // $(this).closest('tr').find('.meetingStatusTypeSelect').val('cl');  
});
  });
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
