<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="approve-attendance-super-admin"; ?>
<?php include_once('inc/header.php'); ?>
<?php
$filepath = realpath(dirname(__FILE__));
if (empty($_POST['date_picker']) ) {
    if (isset($_GET['at_date'])) {
        $startDate=$_GET['at_date'];
      }else{
  $now = new DateTime();
  $startDate= $now->format('Y-m-d');
  $startDate=date('Y-m-d', strtotime('-1 day', strtotime($startDate)));
}
  }else
     {
    $startDate=$_POST['date_picker'];
    }
 $role3_approval_data=$atn->role3_approval_data($startDate);
 $role3_approval_data2=$atn->role3_approval_data($startDate);
 $unApprovedDate=$atn->unApproved_attendanceDate_role_3();

// start of count sum
 $totalPresent=0;
$totalAbsent=0;
$totalSickLeave=0;
$totalCasualLeave=0;
$totalLate=0;
$totalMeetingLate=0;
$totalHalfDay=0;
if ($role3_approval_data_count=$atn->role3_approval_data($startDate)) {
while($countData=$role3_approval_data_count->fetch_assoc()){
if ($countData['status']=='p') {
 $totalPresent++;
}
elseif($countData['status']=='a') {
  $totalAbsent++;
}
elseif($countData['status']=='l') {
  $totalLate++;
}
elseif($countData['status']=='ml') {
  $totalMeetingLate++;
}
elseif($countData['status']=='sl') {
  $totalSickLeave++;
}
elseif($countData['status']=='cl') {
  $totalCasualLeave++;
}
elseif($countData['status']=='hd') {
  $totalHalfDay++;
}

 }
}
 // end of  count sum
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
           <!-- Unapproved Date Showing -->
  <div class="card mb-3" style="background-color:  #3D3D3D;">  
 
     <?php  if ($unApprovedDate) {
         ?>
         <div class="card-header text-center">
        <span>Unapproved Date</span>
         </div>
          <div class="card-body">
         <ul style=" margin:0.5em auto;">
         <?php

                 while($rowunApprovedeDate=$unApprovedDate->fetch_assoc())
                               {
                 ?>
               <a style="text-align:center; display:inline-block; padding:0.1em 1em" href="?at_date=<?php echo $rowunApprovedeDate['at_date'];?>" target="_blank">  <?php echo  $rowunApprovedeDate['at_date']; ?> </a>
       <?php   } ?>
     </ul>
     </div>

  
</div>
  <!-- Unapproved Date -->

          <!-- Choosing Month -->
        <div class="row align-items-center justify-content-center">
          <div class="col-14 mb-2">
                  <form class="form-inline" action="" id="" method="post" autocomplete="off" >
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
 <h6 class="text-center" id="month" value="<?php
                  echo date('F , Y,D', strtotime($startDate));
                  ?>">  <b>
                    <?php
                  echo date('d F , Y,D', strtotime($startDate));
                  // echo date('d F, Y');
                  ?> </h6>
  <!-- Display Choosen Month  -->

 
         <div class="container">
          <?php  if ($role3_approval_data) {
                 $isAdminApproved=mysqli_fetch_assoc($atn->role3_approval_data($startDate))["approved_2"];
           ?>
         <div id="tableDiv">
          <?php if ($isAdminApproved==1) {
            echo '<span href="#" class="btn btn-info btn-icon-split btn-sm m-2">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Approved by Admin</span>
                  </span>';
          }else{
            echo '<span href="#" class="btn btn-danger btn-icon-split btn-sm m-2">
                    <span class="icon text-white-50">
                      <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <span class="text">Not Approved by Admin</span>
                  </span>';
          } ?>
         <span style="color: #ffffff; font-weight: bold;font-size: 15px;">
              Present: <?php echo $totalPresent; ?> ||
              Absent: <?php echo $totalAbsent; ?> ||
              Late: <?php echo $totalLate; ?> ||
              Meeting Late: <?php echo $totalMeetingLate; ?> ||
              Sick Leave: <?php echo $totalSickLeave; ?> ||
              Casual Leave: <?php echo $totalCasualLeave; ?> ||
              Half Day: <?php echo $totalHalfDay; ?>
        </span>
          <table class=" table-responsive table table-striped table-hover table-responsive" id="employeeTable">
          
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                          
                            <th>Status</th>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th>Notes</th>
                            <th>Meeting.Status</th>
                            <th>Meeting Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                      <form  method="post" id="approve_attendance_3Form" >
                   
                <?php  
                $i=0;
               
                 
             
                 while($rowApprovalData_3 =$role3_approval_data->fetch_assoc())
                               {

                 ?>

                        <tr>
                          <input class="employee_name" type="hidden" id="attendanceDate" name="attendanceDate[]" value="<?php echo $rowApprovalData_3['at_date']; ?>" required >
                          <input class="employeeID" type="hidden" id="employeeID" name="employeeID[]" value="<?php echo $rowApprovalData_3['emp_id']; ?>" required >
                            <input  type="hidden" id="tempID" name="tempID[]" 
                            value="<?php echo $rowApprovalData_3['tempID']; ?>" required >
                            <input  type="hidden" id="tempMeetingID" name="tempMeetingID[]" 
                            value="<?php echo $rowApprovalData_3['tempMeetingID']; ?>" required >

                          <td>
          <a href="#" class="view_emp_modal" id="<?php echo $rowApprovalData_3['emp_id'] ?>"><img src="../photo/<?php echo $rowApprovalData_3['photo'] ?>" width="65" height="60" /></a>
        </td>
        <td class="text-info name_modal" style="min-width: 150px;">
          <a href="#" class="view_emp_modal"id="<?php echo $rowApprovalData_3['emp_id'] ?>"><?php echo  $rowApprovalData_3['first_name']." ".$rowApprovalData_3['last_name'] ?><a href="#">
          </td>
            
                      <td>
                        <select class="form-control statusTypeSelect" class="statusTypeSelect" name="statusTypeSelect[]" id="statusTypeSelect"  required >

                          <option value="checkNull">Select a late type</option>
                          <option data-price="a" value="a" <?php echo  $rowApprovalData_3["status"] == "a" ? "selected" : "" ?> >Absent</option>
                          <option data-price="p" value="p" <?php echo  $rowApprovalData_3["status"] == "p" ? "selected" : "" ?> >Present</option>
                          <option data-price="hd" value="hd" <?php echo  $rowApprovalData_3["status"] == "hd" ? "selected" : "" ?> >Half Day</option>
                          <option disabled>─────Select a late type─────</option>
                           <!-- <option value="">Select a late type</option> -->
                          <option data-price="l" value="l" <?php echo  $rowApprovalData_3["status"] == "l" ? "selected" : "" ?> >Late</option>
                          <option data-price="ml" value="ml" <?php echo  $rowApprovalData_3["status"] == "ml" ? "selected" : "" ?> >Meeting late</option>
                          <option  disabled>──────Select a Leave────</option>
                           <!-- <option value="">Select a Leave</option> -->
                          <option data-price="sl" value="sl" <?php echo  $rowApprovalData_3["status"] == "sl" ? "selected" : "" ?> >Sick Leave</option>
                          <option data-price="cl" value="cl" <?php echo  $rowApprovalData_3["status"] == "cl" ? "selected" : "" ?> >Casual Leave</option>
                        </select>
                      </td>

                           <td><input   type="time" class="Input_timepicker_In"  id="timePickerIn" name="timePickerIn[]" pattern="\d{1,2}:\d{2}([ap]m)?" width="200" value="<?php echo $rowApprovalData_3['c_in']; ?>"  /></td>
                          
                           <td><input type="time" class="Input_timepicker_Out" id="timePickerOut" name="timePickerOut[]"pattern="\d{1,2}:\d{2}([ap]m)?" value="<?php echo $rowApprovalData_3['c_out']; ?>" width="200"   /></td>
                        
                            <td><input type="text" class="form-control" id="notes" name="notes[]" value="<?php echo $rowApprovalData_3['notes'];  ?>"></td>
                            <?php if ($rowApprovalData_3['meeting_status']==1 && !empty($rowApprovalData_3['meeting_at_status']) ) { ?>
                             <td>
                        <select class="form-control meetingStatusTypeSelect" class="meetingStatusTypeSelect" name="meetingStatusTypeSelect[]" id="meetingStatusTypeSelect"  required >

                          <option value="checkNull">Select a late type</option>
                          <option value="p" <?php echo  $rowApprovalData_3["meeting_at_status"] == "p" ? "selected" : "" ?> >Present</option>
                          <option value="a" <?php echo  $rowApprovalData_3["meeting_at_status"] == "a" ? "selected" : "" ?> >Absent</option>
                          <option value="hd" <?php echo  $rowApprovalData_3["meeting_at_status"] == "hd" ? "selected" : "" ?> >Half Day</option>
                          <option disabled>─────Select a late type─────</option>
                           <!-- <option value="">Select a late type</option> -->
                          <option value="l" <?php echo  $rowApprovalData_3["meeting_at_status"] == "l" ? "selected" : "" ?> >Late</option>
                          <option value="ml" <?php echo  $rowApprovalData_3["meeting_at_status"] == "ml" ? "selected" : "" ?> >Meeting late</option>
                          <option disabled>──────Select a Leave────</option>
                           <!-- <option value="">Select a Leave</option> -->
                          <option value="sl" <?php echo  $rowApprovalData_3["meeting_at_status"] == "sl" ? "selected" : "" ?> >Sick Leave</option>
                          <option value="cl" <?php echo  $rowApprovalData_3["meeting_at_status"] == "cl" ? "selected" : "" ?> >Casual Leave</option>
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
               }
               // end of while
                ?>
                </tbody>
                </table>
          <span class="success_response mb-3" id="success_response" style="display: none"></span>
        <span class="error_response" id="error_response" style="display: none;">***</span>
            <div class="form-check form-check-inline float-right">
              <!-- update_button_3 -->
              <!-- approve_button_3 -->
           


              <input class="form-control btn btn-primary m-2" type="button" name="update_button_3" value="Update" id="update_button_3" >
                 <input class="form-control btn btn-success m-2" type="button" name="approve_button_3" value="Approve" id="approve_button_3" >
           
                 </div>

                </form>

               <?php } else {
                echo "Data Not Available For This Date";
               } ?>
                   
                   </div>
                
              </div>
             
                <!-- End of table div -->
                  <?php  } else{  ?>
     <div class="card-header">
        <span>No Date for Approve</span>
         </div>
    <?php } ?> 
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
    <!-- Scripts -->
 <script type="text/javascript">
  
   $("#dialog-message").dialog({
          autoOpen: false,
          show: {
              effect: "blind",
              duration: 1000
          },
          hide: {
              effect: "explode",
              duration: 1000
          }
      });
  
    // $('#date_picker').datepicker({ format: 'yyyy-mm-dd' });
    // $('#date_picker').datepicker();
      $('#datepicker').datepicker({ 
     dateFormat: 'yy-mm-dd'
  });

$(document).ready(function(){
$(".loader").fadeOut("slow");
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
// Update Attendance
 $(document).on('click', '#update_button_3', function (e){
   $(".loader").show();
          e.preventDefault();
            var eID = $(".employeeID").val();
           
  if (eID!=undefined) {
       $.ajax({
          url: "controller/attendance/update_attendance_3.php", // Url to which the request is send
          type: "POST",             
          data: new FormData(approve_attendance_3Form), 
          contentType: false,       
          cache: false,             
          processData:false,        
          success: function(data)   
          {
            $(".loader").hide();
               if($.trim(data) == "empty") {

                        $(".emptyMessage").html("Field must not be empty");
                         $(".emptyMessage").show();
                       setTimeout(function(){
                        $(".emptyMessage").fadeOut();
                       },3000);
                  }
                 else if($.trim(data) == "11") {
                       swal({
                      title: "Success!",
                      text: "Attendance Updated Successfully",
                      icon: "success",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: false,
                        });                                     
                  }  
                  else if($.trim(data) == "00") {
                          swal({
                      title: "Error!",
                      text: "Attendance Failed to Update",
                      icon: "error",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: true,
                        });
                     
                  }
   
                   else  {
                      swal({
                      title: "Error!",
                      text: "Attendance Failed to Update",
                      icon: "error",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: true,
                        });
                          
                      }
          
          }
          });
           // end of request
                 }
                  else{
                   $(".emptyMessage").html("Field can not be empty");
                         $(".emptyMessage").show();
                          setTimeout(function(){
                          $(".emptyMessage").fadeOut();
                          },4000);
                  }
           

});
 // end of update
 // approve attendance
 $(document).on('click', '#approve_button_3', function (e){
   $(".loader").show();
          e.preventDefault();
            var eID = $(".employeeID").val();
  if (eID!=undefined) {
           $.ajax({
          url: "controller/attendance/approve_attendance_3.php", // Url to which the request is send
          type: "POST",             
          data: new FormData(approve_attendance_3Form), 
          contentType: false,       
          cache: false,             
          processData:false,        
          success: function(data)   
          {
            $(".loader").hide();

               if($.trim(data) == "empty") {

                        $(".emptyMessage").html("Field must not be empty");
                         $(".emptyMessage").show();
                       setTimeout(function(){
                        $(".emptyMessage").fadeOut();
                       },3000);
                  }
                 else if($.trim(data) == "exist") {
                        swal({
                      title: "Error!",
                      text: "Attendance Allready Exist",
                      icon: "error",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: true,
                        }).then(function(){
                          location.reload();
                        }); 
                  }
                 else if($.trim(data) == "11") {
                        swal({
                      title: "Success!",
                      text: "Attendance Approved Successfully",
                      icon: "success",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: false,
                        }).then(function(){
                          location.reload();
                        }); 
                     
                  }
                   else  {
                          swal({
                      title: "Error!",
                      text: "Attendance Failed to Approved",
                      icon: "error",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: true,
                        }).then(function(){
                          location.reload();
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

});
 // end of approve attendance

});

</script>
  <script src="inc/js/employee_details_in_modal.js"></script>

</body>
</html>
