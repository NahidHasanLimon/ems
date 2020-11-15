

  <!-- Header -->
    <?php include_once 'inc/header.php';  
    Session::checkAdminRole_2_3_Permission();
    ?>
      <!-- End of Header -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
       $unApprovedDate=$atn->unApproved_attendanceDate_role_2();
 if (empty($_POST['date_picker']) ) {
  if (isset($_GET['at_date'])) {
     $startDate=$_GET['at_date'];
  }else{
    $now = new DateTime();
      $startDate= $now->format('Y-m-d');
  }
   }else
        {
  $startDate=$_POST['date_picker'];
      }
  $role2_app_data=$atn->role2_approval_data($startDate);
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
        <h6 class="h4 mb-4 text-gray-800">Approve Attendance</h6>
        <div class="col-xs-1 text-center messageShowingDiv">
        <span class="disable"  style="display: none">Disabled Account!! Warning!!</span>
        <span class="empty" style="display: none ">**Field Must not be Empty**</span>
        <span class="success_response" id="success_response" style="display: none">Attendance Approved Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">***</span>
      </div>
     
          <!-- My Code -->
          <!-- Choosing Month -->
    <div class="row align-items-center justify-content-center">
      <div class="col-14 mb-2">
              <form class="form-inline" action="" method="post" autocomplete="off" >
      <div class="form-check form-check-inline">
        <input type="text" class="form-control" name="date_picker"id="date_picker" placeholder="Select your Date..." style="width:95%;"/>
        <button value="Search" name="search" id="search" class="form-control btn btn-info btn-sm ml-2" type="submit" onClick="return document.getElementById('date_picker').value !='' " style="width: 20%;"><i class="fas fa-search"></i></button>
      </div>
              </form>
      </div>
    </div>
 <!-- Choosing Month -->
 <!-- Display Choosen Month -->
 <h6 class="text-center" id="month" value="<?php
                  echo date('F , Y,D', strtotime($startDate));
                  ?>">  <b>
                    <?php
                  echo date('d F , Y,D', strtotime($startDate));
                  ?> </h6>
  <!-- Display Choosen Month  -->
   <!-- Unapproved Date Showing -->
  <div class="card">  
 
     <?php  if ($unApprovedDate) {
               ?>

         <div class="card-header">
        <span>Unapproved Date</span>
         </div>
          <div class="card-body">
          <ul style=" margin:0.5em auto;">
         <?php
                 while($rowunApprovedeDate=$unApprovedDate->fetch_assoc())
                               {
                 ?>
                  <a style="text-align:center; display:inline-block; padding:0.1em 1em" href="?at_date=<?php echo $rowunApprovedeDate['at_date'];?>">  <?php echo  $rowunApprovedeDate['at_date']; ?> </a>

       <?php   } ?>
     </ul>
     </div>
    <?php  } else{  ?>
     <div class="card-header">
        <span>No Date for Approve</span>
         </div>
      <?php  }  ?>
  </div>
  <!-- Unapproved Date -->
         <div class="container">
          <?php  if ($role2_app_data) {
           ?>
           
             
         <div id="tableDiv">
          <table class="table-responsive table table-striped table-hover " id="employeeTable">       
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                          
                            <th>Status</th>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                      <form action="" method="post" id="approve_attendance_2Form" >                  
                <?php  
                $i=1;
       while($row = mysqli_fetch_array($role2_app_data))
                               {
                 ?>
                        <tr>
                          <input class="employee_name" type="hidden" id="attendanceDate" name="attendanceDate[]" value="<?php echo $row['at_date']; ?>" required >
                          <input class="employeeID" type="hidden" id="employeeID" name="employeeID[]" value="<?php echo $row['emp_id']; ?>" required >
                          <input class="tempID" type="hidden" id="tempID" name="tempID[]" value="<?php echo $row['tempID']; ?>" required >
                           <td>
          <a href="#" class="view_emp_modal" id="<?php echo $row['emp_id'] ?>"><img src="../photo/<?php echo $row['photo'] ?>" width="65" height="60" /></a>
        </td>
        <td class="text-info name_modal" style="min-width: 150px;">
          <a href="#" class="view_emp_modal"id="<?php echo $row['emp_id'] ?>"><?php echo  $row['first_name']." ".$row['last_name'] ?><a href="#">
          </td>
                      <td>
                        <select class="form-control statusTypeSelect" name="statusTypeSelect[]" id="statusTypeSelect"  required >

                          <option value="">Select a late type</option>
                          <option value="p" <?php echo  $row["status"] == "p" ? "selected" : "" ?> >Present</option>
                          <option value="a" <?php echo  $row["status"] == "a" ? "selected" : "" ?> >Absent</option>
                          <option value="hd" <?php echo  $row["status"] == "hd" ? "selected" : "" ?> >Half Day</option>
                          <option disabled>─────Select a late type─────</option>
                           <!-- <option value="">Select a late type</option> -->
                          <option value="ml" <?php echo  $row["status"] == "ml" ? "selected" : "" ?> >Meeting late</option>
                          <option value="l" <?php echo  $row["status"] == "l" ? "selected" : "" ?> >Late</option>
                          <option disabled>──────Select a Leave────</option>
                           <!-- <option value="">Select a Leave</option> -->
                          <option value="sl" <?php echo  $row["status"] == "sl" ? "selected" : "" ?> >Sick Leave</option>
                          <option value="cl" <?php echo  $row["status"] == "cl" ? "selected" : "" ?> >Casual Leave</option>
                        </select>
                      </td>
                          
                           <td><input   type="time" class="Input_timepicker_In"  id="timePickerIn" name="timePickerIn[]" pattern="\d{1,2}:\d{2}([ap]m)?" width="200" value="<?php echo $row['c_in']; ?>"  /></td>
                          
                          <td><input type="time" class="Input_timepicker_Out" id="timePickerIn" name="timePickerOut[]"pattern="\d{1,2}:\d{2}([ap]m)?" value="<?php echo $row['c_out']; ?>" width="200"   /></td>
                        
                            <td><input type="text" class="form-control" id="notes" name="notes[]" value="<?php echo $row['notes'];  ?>"></td>
                        </tr>
              <?php 
                 $i++;
               } ?>
                </tbody>
                </table>
            <div class="form-check form-check-inline float-right">
              <!-- update_button_3 -->
              <input class="form-control btn btn-primary mr-2" type="hidden" name="update_button_2" value="Update" id="approve_button_2"/>
              <input class="form-control btn btn-success" type="submit" name="approve_button_2" value="Approve" id="approve_button_2"/>
            </div>

                </form>

               <?php } else {
                echo "Data Not Available for this Date";
               } ?>
                   
                
                   </div>

                
              </div>
             
                <!-- End of table div -->
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
  
 
  
    $('#date_picker').datepicker({ format: 'yyyy-mm-dd' });
    $('#date_picker').datepicker();

$(document).ready(function(){
var data = $("#approve_attendance_2Form").serialize();
// alert(data);

$('.statusTypeSelect').change(function() {
    var SValue = $(this).val();
   if (SValue=='a' || SValue=='sl' || SValue=='cl'||SValue=='a') {
      $(this).closest('tr').find('.Input_timepicker_In').val('');
      $(this).closest('tr').find('.Input_timepicker_Out').val('');
      
      $(this).closest('tr').find('.Input_timepicker_In').prop('readonly',true);
      $(this).closest('tr').find('.Input_timepicker_Out').prop('readonly',true);
      
       $(this).closest('tr').find('.Input_timepicker_In').prop('required',false);
       $(this).closest('tr').find('.Input_timepicker_Out').prop('required',false);

   }
   else {
      $(this).closest('tr').find('.Input_timepicker_In').prop('required',true);
       $(this).closest('tr').find('.Input_timepicker_Out').prop('required',true);

     $(this).closest('tr').find('.Input_timepicker_In').prop('readonly',false);
      $(this).closest('tr').find('.Input_timepicker_Out').prop('readonly',false);

   }
  
}).change();


 // Form Subitting Event
 $("#approve_attendance_2Form").on('submit',(function(e) {
  e.preventDefault();
   var eID = $(".employeeID").val();
  if (eID!=undefined) {
           $.ajax({
          url: "controller/attendance/approve_attendance_2.php", // Url to which the request is send
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,        // To send DOMDocument or non processed data file it is set to false
          success: function(data)   // A function to be called if request succeeds
          {
               if($.trim(data) == "exist") {

                          swal({
                      title: "Error!",
                      text: "Attendance Allready Exist",
                      icon: "error",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: true,
                        });
                  }
                 else if($.trim(data) == "success") {
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
