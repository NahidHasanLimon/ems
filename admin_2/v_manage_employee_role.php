<?php include_once'inc/header.php';Session::checkAdmin_3_RolePermission(); ?>

  <!-- Header -->
    <?php

     

     ?>
      <!-- End of Header -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
        $AssignJobRoleUser=$usr->current_jobs_endDateisNull_all_employee_details();
      
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
          <h6 class="h4 mb-4 text-gray-800">Manage Employee Role</h6>

        <div class="col-xs-1 text-center messageShowingDiv">
        
      </div>
     
          <!-- My Code -->
         <div class="row">

          

          <div class="col-sm-8"> 
           
              
             <div class="col-sm-6" >
             <form action="" method="post" name="" id="updateEmployeeRoleForm">          
        <select class="form-control" name="selectEmployee" id="selectEmployee" >
          <option value="">Select an employee</option>
          <?php 
                 
                   if($AssignJobRoleUser){
                     $users_data=array();
                    // print_r($AssignJobRoleUser);

                               while($row = mysqli_fetch_array($AssignJobRoleUser))
                               {
                                 $users_data[] = $row;
                   ?>
                   <option class="form-control" value="<?php echo $row['emp_id']; ?>"> <?php echo $row['first_name'].' '.$row['last_name']; ?> </option>
                 <?php } } ?>
        </select>
        </div>
      <div class="form-group mt-3">
         <label for="labelEmployeeRole" id="labelEmployeeRole" class="col-sm-4 control-label font-weight-bold">Employe Role :</label>
        <div class="col-sm-6">          
         <select class="form-control" name="selectEmployeeRole" id="selectEmployeeRole">
          <option value="">Select an Employee Role</option>
          <option value="0">Employee</option>
          <option value="1">Execuitve</option>
          <option value="2">Admin</option>
          <option value="3">Super Admin</option>
           
         </select>
        </div>
      </div>
   
      <div class="form-group">
        <div class="col-sm-4">          
          <input type="submit"  class="form-control bg-gradient-primary text-gray-100" id="editJobRoleSubmit" name="editJobRoleSubmit" value="Update Role" >
        </div>
      </div>

      </form>
           
         <span class="empty" style="display: none; color: red;  ">**Field Must not be Empty**</span>
        <span class="success_response" id="success_response" style="display: none"> Employee Role Updated Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">Failed to Update</span>
        <span class="error_responseJob" id="error_responseJob" style="display: none; color: red;">Same Role Allready Exist</span>

         </div>
         <div class="col-sm-4">  
            <div class="form-group">
            <label for="lastName" class="col-sm-2 control-label font-weight-bold">Photo</label>
              <div class="col-sm-6">
                 <div class="image-preview_div" id="thumb-output" style="border-color: red" > 
                    <img src="/photo/<?php echo $rowJobDetails['photo'] ?>" alt="">
                   
                 </div> 
              </div>
            </div> 
          </div> 
           
         </div>
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
        // New From Validation

$(document).ready(function(){
 $('#selectEmployee').on('change',function(){
          $("#thumb-output").empty();
           $("#AssignedJobDetailsDiv").hide();
         var selectedEmployeeID = $(this).val();
          // $("#thumb-output").empty();
          var users_data_js_array_script = <?php echo json_encode($users_data); ?>;
          $.each(users_data_js_array_script,
            function(propName, propVal)
            {
            if(propVal['emp_id']==selectedEmployeeID){
                 $('#name').val(propVal['name']);
                 var photo= propVal['photo'];
                 var role= propVal['role'];
                 console.log(role);
                 $('#thumb-output').append( '<img src= "/ems/photo/' +photo + '">');              
              $('#selectEmployeeRole option[value="' + role + '"]').prop('selected', true);              
            }

            })      
    });
  // Form Subitting Event
$("#updateEmployeeRoleForm").on('submit',(function(e) {
  e.preventDefault();   
   var selectEmployee=$("#selectEmployee").val();
  var selectEmployeeRole=$("#selectEmployeeRole").val();
     if (selectEmployee== '' || selectEmployeeRole=='') {
      $(".empty").show();
                       setTimeout(function(){

                        $(".empty").fadeOut();
                       },3000);

     }
   if(selectEmployee== ''){
          $('#selectEmployee').next().show();
          return false;
        }  
 
   if(selectEmployeeRole== ''){
          $('#selectEmployeeRole').next().show();

          return false;
        }
        if($("#selectEmployeeRole, #selectEmployee").val()!=""){
       
                 $.ajax({
          url: "controller/employee/updateEmployeeRole.php", // Url to which the request is send
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,        // To send DOMDocument or non processed data file it is set to false
          success: function(data)   // A function to be called if request succeeds
          {

                 if($.trim(data) == "success") {
                  $('#thumb-output').html('');
                  $('#file-input').val('');
                  $('#updateEmployeeRoleForm').trigger("reset");
                  $('#updateEmployeeRoleForm')[0].reset();
                       $(".success_response").show();
                       setTimeout(function(){
                        $(".success_response").fadeOut();
                       },3000);
                       location.reload();
                  }
                 else if($.trim(data) == "Same Role Allready Exist") {
    //use #for id and dot(.) for class
                       $(".error_email").html(data);
                       $(".error_email").show();
                       setTimeout(function(){
                        $(".error_email").fadeOut();
                       },3000);


                  } else {
                         $(".error_response").html(data);
                         $(".error_response").show();
                          setTimeout(function(){
                          $(".error_response").fadeOut();
                          },3000);

                      }
          
          }
          });
                 // Ajax Request
               }
               else{
                  // $("#error").html("<b> Field Can not be Empty</b>");
                  alert("Field Can not be Empty ");
               }       

     }));


   
});


</script>
  

</body>

</html>
