<?php include_once 'inc/header.php';  ?>
      <!-- End of Header -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
       if (empty($_POST['date_picker']) ) {

  $now = new DateTime();
  $startDate= $now->format('Y-m').'-01';
$monthWise_attendance_Report=$atn->employe_monthWise_attendance_Report($startDate);
   }
        else
        {
  $startDate=$_POST['date_picker'].'-01';
$monthWise_attendance_Report=$atn->employe_monthWise_attendance_Report($startDate);
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
       <p> <h6 class="text-center"> <b>Monthly Attendance Report </b></h6>
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
                <table class="table table-sm table table-bordered table-hover display"  id="dataTable" width="100%" height="60%"cellspacing="0" >
                  <!-- style="background:#1b705b;" -->
                  <thead >
                    <tr>
                <th class="text-center">SL.</th>
                <th class="text-center">photo</th>
              <th class="text-center text-info" colspan="1" >name</th>
             <th class="text-center table-success">Presents</th>
              <th class="text-center table-danger">Absents</th>
              <th class="text-center table-secondary">Half Day</th>
              <th class="text-center table-warning">Late</th>
              <th class="text-center table-info">MeetingLate</th>
              <th class="text-center table-active">CasualLeave</th>
              <th class="text-center table-info">SickLeave</th>
              <th class="text-center text-success">At_Count</th>
              <th class="text-center table-success">working_Days</th>
               <th class="text-center">Actions</th>

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
              <th class="text-center">SL.</th>
              <th class="text-center">photo</th>
              <th class="text-center">name</th>
              <th class="text-center table-success">Presents</th>
              <th class="text-center table-danger">Absents</th>
              <th class="text-center table-secondary">Half Day</th>
              <th class="text-center table-warning">Late</th>
              <th class="text-center table-info">MeetingLate</th>
              <th class="text-center table-active">CasualLeave</th>
              <th class="text-center table-info">SickLeave</th>
              <th class="text-center">At_Count</th>
              <th class="text-center table-success">working_Days</th>
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
        <td class="text-center table-secondary" style="font-weight:900"><?php echo  $row['HalfDay']; ?></td>
          <td class="text-center table-warning" style="font-weight:900"><?php echo  $row['Late']; ?></td>
       <td class="text-center table-info" style="font-weight:900"><?php echo  $row['MeetingLate']; ?></td>
        <td class="text-center table-active" style="font-weight:900"><?php echo  $row['CasualLeave']; ?></td>
         <td class="text-center  table-info" style="font-weight:900"><?php echo  $row['SickLeave']; ?></td>
        <td class="text-center" style="font-weight:900"><?php echo  $row['Total_Attendance_Days']; ?></td>
        <td class="text-center table-success" style="font-weight:900"><?php echo  $row['Total_working_Days']; ?></td>
        
       
       
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
include_once ($filepath.'/inc/modal/modal_an_employee_monthly_attendance.php'); 
include_once ($filepath.'/inc/modal/modal_view_employee.php'); 
 ?> 
<!-- Scripts -->
<?php 
include_once ($filepath.'/inc/partials/scripts.php'); 
 ?> 
<!-- Scripts -->
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
   // $('#dataTable').DataTable( {
   //      dom: 'Bfrtip',
   //      buttons: [
   //          'print'
   //      ]
   //  } );

 $(document).on('click', '.view_attendance', function(){  
           var employee_id = $(this).attr("id"); 
           var start_date = $('#start_date').val();
           // var name = $('#name').val();
           // var name=$(this).closest('tr').find('#name').val();
           var name=$(this).closest('tr').find('#name').val();
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"controller/attendance/an_employees_monthAllAttendance.php",  
                     method:"POST",  
                     data:{employee_id:employee_id,start_date:start_date},  
                     success:function(data){  

                          $('#modal-body').html(data);   
                          $('#modal-title').html(name);  
                          $('#allAttendanceModal').modal('show'); 
  //                          $(document).on("hidden.bs.modal", "#allAttendanceModal", function () {
  //  $('##modal-title').html('');
  // }); 
                     }  
                });  
           }            
      });

   
});
 

</script>
  <script src="inc/js/employee_details_in_modal.js"></script>

</body>

</html>
