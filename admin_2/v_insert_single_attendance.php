<?php include_once 'inc/header.php';  ?>
      <!-- End of Header -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
       // $allActiveEmployee=$usr->all_active_employee_details();
       $allActiveEmployee=$usr->current_jobs_endDateisNull_all_employee_details();
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
        <div class="container-fluid mb-5">

          <!-- Page Heading -->
          <h6 class="h4 mb-4 text-gray-800">Add Single Attendance</h6>
   <!-- form div -->
          <!-- Row -->
          <div class="row ml-2">

            <!-- col-sm-2 -->
          <!--   <div class="col-xs-2">
            Place Blank
            </div> -->
             <!-- End col-sm-2 -->

          <!-- col-sm-6 -->
          <div class="col-sm-6 ml-2 ">
 <form action="" method="post" id="insertSingleAttendanceForm" autocomplete="off">
  <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">Name:</label>
        <div class="col-sm-8">          
        <select class="form-control" name="selectEmployee" id="selectEmployee">
          <option value="">Select an employee</option>
          <?php
           if($allActiveEmployee){
                    $users_data=array();
                    print_r($allActiveEmployee);
                               while($row = mysqli_fetch_array($allActiveEmployee))
                               {
                          $users_data[]=$row;
                   ?>
                   <option class="form-control" value="<?php echo $row['emp_id']; ?>"> <?php echo $row['first_name'].' '.$row['last_name']; ?> </option>
                 <?php } } ?>
        </select>
        </div>
      </div>
   <div class="form-group">
      <label for="dob" class="col-sm-4 control-label font-weight-bold">Attendance Date:</label>
      <div class="col-sm-8">
      <input class="form-control" type="text" id="datepicker" name="datepicker"  data-date-format='yyyy-mm-dd'required="">
      </div>
      </div>   
       <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">Status:</label>
        <div class="col-sm-8">          
         <select class="form-control statusTypeSelect" name="statusTypeSelect" id="statusTypeSelect"  required >
                          <option data-price=""value="">Select Status</option>
                          <option data-price="p"value="p">Present</option>
                          <option data-price="a"value="a">Absent</option>
                          <option data-price="hd"value="hd">Half Day</option>
                          <option  disabled>─────Select a late type─────</option>
                           <!-- <option value="">Select a late type</option> -->
                          <option data-price="ml"value="ml">Meeting late</option>
                          <option data-price="l"value="l">Late</option>
                          <option disabled>──────Select a Leave────</option>
                           <!-- <option value="">Select a Leave</option> -->
                          <option data-price="sl"value="sl">Sick Leave</option>
                          <option data-price="cl"value="cl">Casual Leave</option>
                        </select>
        </div>
      </div>
      <div class="form-group">
        <label for="timePickerIn" class="col-sm-2 control-label font-weight-bold">Time In:</label>
        <div class="col-sm-8">          
       <input type="time" class="form-control Input_timepicker_In" id="timePickerIn" name="timePickerIn" pattern="\d{1,2}:\d{2}([ap]m)?" width="200"   />
        </div>
      </div>

     <div class="form-group">
        <label for="timePickerOut" class="col-sm-6 control-label font-weight-bold">Time Out:</label>
        <div class="col-sm-8">          
       <input type="time" class="form-control Input_timepicker_Out" id="timePickerOut" name="timePickerOut"pattern="\d{1,2}:\d{2}([ap]m)?" width="200"/>
        </div>
      </div>

<div class="form-group">
<label for="lastName" class="col-sm-2 control-label font-weight-bold">notes:</label>
<div class="col-sm-8">
<textarea class="form-control" name="notes" id="notes" value="Type Any Notes"required="">  </textarea> 
</div>
</div>
 

 

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
  <input type="hidden" name="formSubmitorNot" value="formSubmitorNot">
  <input type="hidden" id="actionValue" name="actionValue" value="insert">
    <input type="submit" name="addSingleAttendance" id="addSingleAttendance" class="btn btn-primary btn-lg    login-button" value="Add">

    </div>
  
  </div> 

</form>


     </div>

      <!-- End col-sm-8  First Div-->
       <!-- col-sm-2 -->
 
     <div class="col-sm-4">  

        <div class="form-group">
        <label for="lastName" class="col-sm-2 control-label font-weight-bold">Photo()</label>
        <div class="col-sm-6">
           <div class="image-preview_div" id="thumb-output" style="border-color: red" > </div> 
           
            <!-- file-input -->

        </div>
        </div> 
 </div> 
                  </div>
                  <!-- End of row   -->
                


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
   if (SValue=='a' || SValue=='sl' || SValue=='cl'||SValue=='a' ||SValue=='a' || SValue=='a'||SValue=='a') {
      $('.Input_timepicker_In').val('');
      $('.Input_timepicker_Out').val('');
      
      $('.Input_timepicker_In').prop('readonly',true);
      $('.Input_timepicker_Out').prop('readonly',true);
      
       $('.Input_timepicker_In').prop('required',false);
       $('.Input_timepicker_Out').prop('required',false);
   }
   else {
      $('.Input_timepicker_In').prop('required',true);
       $('.Input_timepicker_Out').prop('required',true);

     $('.Input_timepicker_In').prop('readonly',false);
      $('.Input_timepicker_Out').prop('readonly',false);

   }
  
});
  
   $('#datepicker').datepicker();

  $('#selectEmployee').on('change',function(){
    $("#thumb-output").empty();
         var selectedEmployeeID = $(this).val();
         console.log(selectedEmployeeID);
          var selectedEmployeeID = $(this).val();
          var users_data_js_array_script = <?php echo json_encode($users_data); ?>;
          $.each(users_data_js_array_script,
            function(propName, propVal)
            {
            console.log(users_data_js_array_script);
            if(propVal['emp_id']==selectedEmployeeID){
                 var photo= propVal['photo'];
                 console.log(photo);
                 $('#thumb-output').append( '<img src= "/ems/photo/' +photo + '">');
            }

            })
         
  });
 
 // Form Subitting Event
 $("#insertSingleAttendanceForm").on('submit',(function(e) {
  e.preventDefault();
   var eID = $('#selectEmployee').val();
  if (eID!=undefined) {
           $.ajax({
          url: "controller/attendance/single_addAttendance.php", // Url to which the request is send
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,        // To send DOMDocument or non processed data file it is set to false
          success: function(data)   // A function to be called if request succeeds
          {
               if($.trim(data) == "exist"){
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
                 else if($.trim(data) == "success") {
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
                   else{
                         swal({
                      title: "Error!",
                      text: "Attendance Failed to Insert",
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
  

</body>

</html>
