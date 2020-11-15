<?php include_once'inc/header.php';Session::checkAdminRole_2_3_Permission();?>
<?php
$filepath = realpath(dirname(__FILE__));
$resultDep=$dep->all_department_details();
$resultComp=$comp->all_company_details();
$resultJobRole=$jobRole->all_notExistEmployee_details();
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
          <h6 class="h4 mb-4 text-gray-800">Apppoint Employee</h6>
       
     
          <!-- My Code -->
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


  <form action="" method="post" id="addEmployeeAppointForm" enctype="multipart/form-data" autocomplete="off" onSubmit="return validation();">       
     <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">Name:</label>
        <div class="col-sm-8">          
        <select class="form-control" name="selectEmployee" id="selectEmployee">
          <option value="">Select an un-appointed employee</option>
          <?php 
                 
                   if($resultJobRole){
                    print_r($resultJobRole);

                               while($rowJobRole = mysqli_fetch_array($resultJobRole))
                               {
                   ?>
                   <option class="form-control" value="<?php echo $rowJobRole['emp_id']; ?>"> <?php echo $rowJobRole['first_name'].' '.$rowJobRole['last_name']; ?> </option>
                 <?php } } ?>
        </select>
        </div>
      </div>
      <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">Company:</label>
        <div class="col-sm-8">          
        <select class="form-control" name="selectCompany" id="selectCompany">
          <option value="">Select a company</option>
          <?php 
                  
                   if($resultComp){
                    print_r($resultComp);

                               while($rowComp = mysqli_fetch_array($resultComp))
                               {
                   ?>
                   <option class="form-control" value="<?php echo $rowComp['comp_id']; ?>"> <?php echo $rowComp['comp_name']; ?> </option>
                 <?php } } ?>
        </select>
        </div>
      </div>
       <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">Department:</label>
        <div class="col-sm-8">          
        <select class="form-control" name="selectDepartment" id="selectDepartment">
          <option value="">Select a department</option>
          
        </select>
        </div>
      </div>
      <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">Designation:</label>
        <div class="col-sm-8">          
        <select class="form-control" name="selectDesignation" id="selectDesignation">
          <option value="">Select a designation</option>
          
        </select>
        </div>
      </div>

   <div class="form-group">
        <label for="firstName" class="col-sm-6 control-label font-weight-bold">Job Nature:</label>
        <div class="col-sm-8">          
        <select class="form-control" name="job_nature" id="job_nature">
          <option value="">Select a Job nature</option>
           <option value="1">Full Time</option>
          <option value="2">Part Time</option>
         
          
        </select>
        </div>
      </div>
 

 
<div class="form-group">
<label for="dob" class="col-sm-4 control-label font-weight-bold">Start Date:</label>
<div class="col-sm-8">
<input class="form-control" type="text" id="datepicker" name="datepicker"  data-date-format='yyyy-mm-dd'required="">
</div>
</div>



<div class="form-group">
<label for="dob" class="col-sm-4 control-label font-weight-bold">Salary</label>
<div class="col-sm-8">
<input class="form-control" type="number" id="salary" name="salary" required="">
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
    <input type="submit" name="addEmployeeAppointment" id="addEmployeeAppointment" class="btn btn-primary btn-lg    login-button" value="Appoint">

    </div>
  
  </div> 

</form>
  
        <span class="disable"  style="display: none">Disabled Account!! Warning!!</span>
        <span class="empty" style="display: none ">**Field Must not be Empty**</span>
        <span class="success_response" id="success_response" style="display: none">Employee Appoint Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">Failed to Insert</span>
        <span class="error_responseJob" id="error_responseJob" style="display: none; color: red;">Same Job Allready Exist</span>

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
                

<!-- end of For Div -->
        
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
 ?> 
<!-- Scripts -->
<?php 
include_once ($filepath.'/inc/partials/scripts.php'); 
 ?> 
<!-- Scripts -->
 <script type="text/javascript">
    $('#datepicker').datepicker({ format: 'yyyy-mm-dd' });
   // New From Validation
       
        // New From Validation


$(document).ready(function(){
  $("#selectEmployee").click(function () { 
    // $('#thumb-output').val('');
     // $("#thumb-output").empty();
  });

//  
  $("addEmployeeForm").attr('autocomplete', 'off');
  
   $('#datepicker').datepicker();

  $('.error_email').hide();
  $("#email").click(function(){
     $('.error_email').hide();
    });
  // new Form Validation
  
         // On Change Function
      $('#selectEmployee').on('change',function(){
        var selectedEmployeeID = $(this).val();
          $("#thumb-output").empty();
       
        if(selectedEmployeeID){
            $.ajax({
                type:'POST',
                url:'controller/job_role/insert_edit_delete.php',
                data:'selectedEmployeeID='+selectedEmployeeID,
                dataType:"json",
                success:function(data){
                    
                     $('#thumb-output').append( '<img src= "/ems/photo/' +data.photo + '">');
                    
                }
            }); 
        }
    });

       $('#selectCompany').on('change',function(){
        var selectedCompanyID = $(this).val();
        if(selectedCompanyID){
            $.ajax({
                type:'POST',
                url:'controller/job_role/insert_edit_delete.php',
                data:'selectedCompanyID='+selectedCompanyID,
                success:function(html){
                    $('#selectDepartment').html(html);
                    $('#selectDesignation').html('<option value="">Select Department first</option>'); 
                }
            }); 
        }else{
            $('#selectDepartment').html('<option value="">Select  Company First</option>');
            $('#selectDesignation').html('<option value="">Select Department first</option>'); 
        }
    });
    
    $('#selectDepartment').on('change',function(){
        var selectedDepartmentID = $(this).val();
        if(selectedDepartmentID){
            $.ajax({
                type:'POST',
                url:'controller/job_role/insert_edit_delete.php',
                data:'selectedDepartmentID='+selectedDepartmentID,
                success:function(html){
                    $('#selectDesignation').html(html);
                }
            }); 
        }else{
            $('#selectDesignation').html('<option value="">Select Department first</option>'); 
        }
    });
  
 // Form Subitting Event
$("#addEmployeeAppointForm").on('submit',(function(e) {
  e.preventDefault();
        if($("#selectEmployee, #selectCompany, #selectDepartment, #selectDesignation,  #datepicker, #salary").val()!=""){

       
                 $.ajax({
          url: "controller/job_role/insert_edit_delete.php", // Url to which the request is send
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,        // To send DOMDocument or non processed data file it is set to false
          success: function(data)   // A function to be called if request succeeds
          {        
            $('#file-input').val('');

                 if($.trim(data) == "success") {
                  $('#thumb-output').html('');
              
    //use #for id and dot(.) for class
                 // $(".success_response").html(data);
                         swal({
                      title: "Success!",
                      text: "Employee Appoint Successfully",
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
                 else if($.trim(data) == "error") {
                  swal({
                      title: "Error!",
                      text: "Failed to Appoint",
                      icon: "error",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: true,
                        }); 

                  } 
  else if($.trim(data) == "Same Job allready exist") {
    //use #for id and dot(.) for class
                       $(".error_responseJob").html(data);
                       $(".error_responseJob").show();
                       setTimeout(function(){
                        $(".error_responseJob").fadeOut();
                       },3000);


                  }  
                   else if($.trim(data) == "Field Must Not be Empty") {
    //use #for id and dot(.) for class
                       $(".error_responseJob").html(data);
                       $(".error_responseJob").show();
                       setTimeout(function(){
                        $(".error_responseJob").fadeOut();
                       },3000);


                  } 

          
          }
          });
                 // Ajax Request
               }
               else{
                  // $("#error").html("<b> Field Can not be Empty</b>");
                  alert("Field Can nto be Empty ");

               } 

               //View Employee From List      
               //View Employee From List      

     }));

   // Form Subitting Event




   
});


</script>
  

</body>

</html>
