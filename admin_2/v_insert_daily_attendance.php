<?php include_once'inc/header.php'; ?>
      <?php 
       $filepath = realpath(dirname(__FILE__));
       // $allActiveEmployee=$usr->all_active_employee_details();
       $allActiveEmployee=$usr->current_jobs_endDateisNull_all_employee_details_except_partTimer();
      ?>

<body id="page-top">
<div class="loader" style="display: none;"></div>
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
        <div class="container-fluid mb-5">

          <!-- Page Heading -->
          <h6 class="h4 mb-4 text-gray-800">Add Attendance</h6>
        <div class="col-xs-1 text-center messageShowingDiv">
        <span class="disable"  style="display: none">Disabled Account!! Warning!!</span>
        <span class="empty" style="display: none ">**Field Must not be Empty**</span>
        <span class="success_response" id="success_response" style="display: none">Attendance Added Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">***</span>
      </div>
     
          <!-- My Code -->
          <div class="col-sm-6"> 
          </div>
         <div id="tableDiv" >
          <form action="" method="post" id="insertAttendanceForm" autocomplete="off" class="form-inline">
          <input class="form-control ml-2 mb-3" type="text" id="datepicker" name="datepickerAttendance"  data-date-format='yyyy-mm-dd'required="" style="width: 80%" placeholder="Select a Date" >
          <table class="table-responsive table table-striped table-hover" id="employeeTable">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <!-- <th>Present</th> -->
                        <!--     <th>Leave</th>
                            <th>Late</th> -->
                            <th>Status</th>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th>Notes</th>
                            <th>Meeting.Status</th>
                            <th>Meeting Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                <?php  
                $i=1;
                if ($allActiveEmployee) {
                
                
                 while($row = mysqli_fetch_array($allActiveEmployee))
                               {

                 ?>

                        <tr>
                          <input class="employeeID" type="hidden" id="employeeID" name="employeeID[]" value="<?php echo $row['emp_id']; ?>" required >
                          <td>
                            <a href="#" class="view_emp_modal" id="<?php echo $row['emp_id'] ?>"><img src="../photo/<?php echo $row['photo'] ?>" width="65" height="60" /></a>
        </td>
        <td class="text-info name_modal" style="min-width: 150px;">
          <a href="#" class="view_emp_modal"id="<?php echo $row['emp_id'] ?>"><?php echo  $row['first_name']." ".$row['last_name'] ?><a href="#">
          </td>

                              <input type="checkbox" name="presentCB" id="presentCB" hidden=""> 
  
                      <td width="15%">
                        <select class="form-control statusTypeSelect" name="statusTypeSelect[]" id="statusTypeSelect"  required >
                          <option data-price=""value="">Select Status</option>
                          <option data-price="p" value="p">Present</option>
                          <option data-price="hd" value="hd">Half Day</option>
                          <option data-price="a"value="a">Absent</option>
                          <option  disabled>─────Select a late type─────</option>
                           <!-- <option value="">Select a late type</option> -->
                          <option data-price="l"value="l">late</option>
                          <option data-price="ml"value="ml">Meeting late</option>
                          <option disabled>──────Select a Leave────</option>
                           <!-- <option value="">Select a Leave</option> -->
                          <option data-price="sl"value="sl">Sick Leave</option>
                          <option data-price="cl"value="cl">Casual Leave</option>
                        </select>
                      </td>
                            <!-- <td><input type="checkbox" name="leaveCB" id="leaveCB" hidden=""></td> -->

                           <td><input   type="time" class="Input_timepicker_In" id="timePickerIn" name="timePickerIn[]" pattern="\d{1,2}:\d{2}([ap]m)?" width="200"   /></td>

                           <!-- <td><input  type="text" class="timepickerIn" id="timepickerIn" name="timePickerIn[]" pattern="\d{1,2}:\d{2}([ap]m)?" width="200"  required /></td> -->
                          
                           <td><input type="time" class="Input_timepicker_Out" id="timePickerOut" name="timePickerOut[]"pattern="\d{1,2}:\d{2}([ap]m)?" width="200"   /></td> 

                           <!-- <td><input class="timePickerOut" id="timePickerOut" name="timePickerOut[]" pattern="\d{1,2}:\d{2}([ap]m)?" width="200" required  /></td> -->
                        
                            <td><input type="text" id="notes" class="form-control" id="notes" name="notes[]" value=""></td>
                            <?php if ($row['meeting_status']==1) {?>
                              <td width="15%">
                      <select class="form-control meetingStatusTypeSelect" name="meetingStatusTypeSelect[]" id="meetingStatusTypeSelect"  required >
                          <option data-price=""value="">Select Meeting Status</option>
                          <option data-price="p" value="p">Present</option>
                          <option data-price="a"value="a">Absent</option>
                          <option  disabled>─────Select a late type─────</option>
                           <!-- <option value="">Select a late type</option> -->
                          <option data-price="l"value="l">late</option>
                          <option data-price="ml"value="ml">Meeting late</option>
                          <option disabled>──────Select a Leave────</option>
                           <!-- <option value="">Select a Leave</option> -->
                          <option data-price="sl"value="sl">Sick Leave</option>
                          <option data-price="cl"value="cl">Casual Leave</option>
                        </select>
                      </td>
                          <td><input type="text" id="meetingNotes" class="form-control" id="meetingNotes" name="meetingNotes[]" value=""></td>
                             <?php } else{ ?>
                              <input type="hidden" id="meetingStatusTypeSelect" class="form-control" id="meetingStatusTypeSelect[]" name="meetingStatusTypeSelect[]" value="">
                              <input type="hidden" id="meetingNotes" class="form-control" id="meetingNotes" name="meetingNotes[]" value="">
                             <?php } ?>
                             
                        </tr>
                 <?php 
                 $i++;
               } } ?>
                    </tbody>
                </table>
                <input class="form-control btn btn-success" type="submit" id="insertAttendance" name="insertAttendance" value="Insert" style="width: 20% ; align:right">
                <br>
                <span class="emptyMessage" style="color: red;"></span>
                </form>
                </div>
                <!-- End of table div -->
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

    $('#datepicker').datepicker({ format: 'yyyy-mm-dd' });

$(document).ready(function(){

$('.statusTypeSelect').change(function() {
    var SValue = $(this).val();
   if (SValue=='a' || SValue=='sl' || SValue=='cl'||SValue=='a' ||SValue=='a') {
      $(this).closest('tr').find('.Input_timepicker_In').val('');
      $(this).closest('tr').find('.Input_timepicker_Out').val('');
      
      $(this).closest('tr').find('.Input_timepicker_In').prop('readonly',true);
      $(this).closest('tr').find('.Input_timepicker_Out').prop('readonly',true);
    
       $(this).closest('tr').find('.Input_timepicker_In').prop('required',false);
       $(this).closest('tr').find('.Input_timepicker_Out').prop('required',false);
       // For Meeting status
       if (SValue=='sl'){
        $(this).closest('tr').find('.meetingStatusTypeSelect').val('sl');
       } 
       if (SValue=='cl'){
        $(this).closest('tr').find('.meetingStatusTypeSelect').val('cl');
       }
         // For Meeting status

   }
   else {
      $(this).closest('tr').find('.Input_timepicker_In').prop('required',true);
       $(this).closest('tr').find('.Input_timepicker_Out').prop('required',true);

     $(this).closest('tr').find('.Input_timepicker_In').prop('readonly',false);
      $(this).closest('tr').find('.Input_timepicker_Out').prop('readonly',false);

   }
  
});
  
   $('#datepicker').datepicker();
 $("employeeTable").delegate("tr.rows", "click", function(){
        alert("Click!");
    });
$('#employeeTable').on('change', '.leaveTypeSelect', function() {
  // console.log("Limon");
       var $current_dropdown = $(this),
        $other_dropdown = $(this).closest('tr').find('select').not(this);

});
 
 // Form Subitting Event
 $("#insertAttendanceForm").on('submit',(function(e) {
  e.preventDefault();
  $(".loader").show();
   var eID = $(".employeeID").val();
  if (eID!=undefined) {
           $.ajax({
          url: "controller/attendance/addAttendance.php", // Url to which the request is send
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,        // To send DOMDocument or non processed data file it is set to false
          success: function(data)   // A function to be called if request succeeds
          {
           $(".loader").hide();
                if($.trim(data) == "existexist"){
                          swal({
                      title: "Error!",
                      text: "Attendance Allready Exist",
                      icon: "error",
                      closeOnClickOutside: true,
                      closeModal: true,
                      closeOnEsc: true,
                      allowOutsideClick: true,
                      dangerMode: true,
                        });
                  }
                 else if($.trim(data) == "successsuccess") {

                         swal({
                      title: "Success!",
                      text: "Attendance Inserted Successfully",
                      icon: "success",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: false,
                        }); 
                  }
   
                   else  {
                         swal({
                      title: "Error!",
                      // text: "Attendance Failed to Insert",
                      text: data,
                      icon: "info",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: true,
                        });
                      }
          
          }
          });
                 }
                  else{
                   $(".emptyMessage").html("Nothing to submit");
                         $(".emptyMessage").show();
                          setTimeout(function(){
                          $(".emptyMessage").fadeOut();
                          },4000);
                  }

     }));
 // Form Subitting Event

});

</script>
   <script src="inc/js/employee_details_in_modal.js"></script>

</body>

</html>
