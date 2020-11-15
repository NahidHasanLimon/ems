<?php include_once ('inc/header.php'); ?>
 <?php 
  $employee_id=$_SESSION['emp_id'];
  ?>
    <?php 
       $filepath = realpath(dirname(__FILE__));
       if (empty($_POST['date_picker']) ) {
  $now = new DateTime();
  $startDate= $now->format('Y-m').'-01';
  
   } else{
  $startDate=$_POST['date_picker'].'-01';
  $now = new DateTime($startDate);
  $startDate= $now->format('Y-m').'-01';
  // $monthWise_summaryReport=$usr->an_employes_monthWise_summary_attendance_Report($employee_id,$startDate);
  // $monthWise_detailsReport=$usr->an_employes_monthWise_attendance_details($employee_id,$startDate);

      }
      $monthWise_summaryReport=$usr->an_employes_monthWise_summary_attendance_Report($employee_id,$startDate);
  $monthWise_detailsReport=$usr->an_employes_monthWise_attendance_details($employee_id,$startDate);
      ?>
  <!-- Navigation -->
 
  <!-- Page Content -->
  <div class="container">

       <!-- Choosing Month -->
    <div class="row align-items-center justify-content-center">
      <div class="col-14 mb-2">

       <p> <h6 class="text-center"><b>Monthly Attendance Report</b> </h6>
              <form class="form-inline" action="" method="post" autocomplete="off">

                  <input type="text" class="form-control" name="date_picker"id="date_picker" placeholder="Select your month..." style="width:75%;">
                        <button value="Search" name="search" id="search" class="form-control btn btn-info btn-sm ml-2" type="submit" onClick="return document.getElementById('date_picker').value !='' " style="width: 20%;"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
              </p>
      </div>
    </div>

 <!-- Choosing Month -->
   <!-- Display Choosen Month -->
  <div class="row justify-content-center mb-2" id="displayMonth">
 <h3 class="text-center" id="month" value="<?php
                  echo date('F , Y', strtotime($startDate));
                  ?>">  <b><?php
                  echo date('F , Y', strtotime($startDate));
                  ?></b> Details </h3>
 <!-- Display Choosen Month -->
  </div>
  

   <div class="col-sm-12 justify-content-center mb-3" id="monthSummary"> 
    <div class="card">
      <div class="card-header">Month Summary </div>
          <?php if ($monthWise_summaryReport){ 
          $rowSummary=$monthWise_summaryReport->fetch_assoc();
            ?>
            <div class="card-body">
              <table class="table table-bordered table-responsive">
                <thead>
                  <td class="col-xs-1">Presents</td>
                  <td>Absents</td>
                  <td>Casual Leave</td>
                  <td>Meeting Late</td>
                  <td>Others Late</td>
                  <td>Sick Leave</td>
                  <td>Total Att. Count</td>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center"><?php echo $rowSummary['Presents']; ?></td>
                    <td class="text-center"><?php echo $rowSummary['Absents']; ?></td>
                    <td class="text-center"><?php echo $rowSummary['CasualLeave']; ?></td>
                    <td class="text-center"><?php echo $rowSummary['MeetingLate']; ?></td>
                    <td class="text-center"><?php echo $rowSummary['OthersLate']; ?></td>
                    <td class="text-center"><?php echo $rowSummary['SickLeave']; ?></td>
                    <td class="text-center"><?php echo $rowSummary['Total_Attendance_Days']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>

          <?php } else {echo "No Data Available";} ?>
  </div>
  </div>
  <div class="col-sm-12 justify-content-center mb-3" id="monthSummary"> 
    <div class="card">
      <div class="card-header">Month Details </div>
          <?php if ($monthWise_detailsReport){  ?>
            <div class="card-body">
              <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" id="dataTable">
                <thead>
                  <tr>
                  <th>Date</th>
                  <th>Day</th>
                  <th>c_in</th>
                  <th>c_out</th>
                  <th>Status</th>
                  <th>Notes</th>
                </tr>
                </thead>
                <tbody>
          <?php while($rowDetails=$monthWise_detailsReport->fetch_assoc()){ ?>
                  <tr>
                    <td class="text-center"><?php echo $rowDetails['at_date']; ?></td>
                    <td class="text-center"><?php echo  date("l",strtotime($rowDetails['at_date'])); ?></td>
                    <td class="text-center"><?php echo ($rowDetails['c_in']=="")? strtoupper($rowDetails['status']) : date('h:i A', strtotime($rowDetails['c_in'])); ?></td>
                    <td class="text-center"><?php echo ($rowDetails['c_out']=="")? strtoupper($rowDetails['status']) : date('h:i A', strtotime($rowDetails['c_out'])); ?></td>
                    <td class="text-center">
                      <?php 
                     
                    if ($rowDetails['status']=='ol') {
                      echo "Late";
                    }elseif ($rowDetails['status']=='ml') {
                     echo "Meeting Late";
                    }elseif ($rowDetails['status']=='sl') {
                      echo "Sick Leave";
                    }elseif ($rowDetails['status']=='cl') {
                      echo "Casual Leave";
                    } else{
                       echo strtoupper($rowDetails['status']);
                    }
                       ?>                      
                      </td>
                    <td class="text-center"><?php echo $rowDetails['notes']; ?></td>
                  </tr>
            <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                  <th>Date</th>
                  <th>Day</th>
                  <th>c_in</th>
                  <th>c_out</th>
                  <th>Status</th>
                  <th>Notes</th>
                </tr>
                </tfoot>
              </table>
            </div>

          <?php } else {echo "No Data Available";} ?>
  </div>
  </div>
       
</div>
 
 <script type="text/javascript">
$(document).ready(function () {
  $('#dataTable').DataTable({
    "paging": false // false to disable pagination (or any other option)
  });
  $('.dataTables_length').addClass('bs-select');
});
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

</body>

</html>
