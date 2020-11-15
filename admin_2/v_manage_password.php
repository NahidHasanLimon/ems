<?php include_once'inc/header.php';
Session::checkAdmin_3_RolePermission();
Session::checkAdmin_3_RolePermission();
?>
      <!-- End of Header -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
        $AssignJobRoleUser=$usr->all_active_employee_details();
      
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
          <h6 class="h4 mb-4 text-gray-800">Change Password</h6>

        <div class="col-xs-1 text-center messageShowingDiv">
        
      </div>
     
          <!-- My Code -->
         <div class="row">

          <div class="col-sm-8">   
        <div class="col-sm-6" >
             <form action="" method="post"  name="updatePasswordForm" id="updatePasswordForm" autocomplete="off">          
        <select class="form-control" name="selectEmployee" id="selectEmployee" required="" >
          <option value="">Select an employee</option>
          <?php 
                 
                   if($AssignJobRoleUser){
                     $users_data=array();
                               while($row = mysqli_fetch_array($AssignJobRoleUser))
                               {
                                 $users_data[] = $row;
                   ?>
                   <option class="form-control" value="<?php echo $row['emp_id']; ?>"> <?php echo $row['first_name'].' '.$row['last_name']; ?> </option>
                 <?php } } ?>
        </select>
        </div>
      <div class="form-group mt-3">
         <label for="curtPassword" id="labelCurrentPassword" class="col-sm-4 control-label font-weight-bold">Current Password :</label><span id="errorCurPass"style='color:red;'></span>
        <div class="col-sm-6">          
        <input type="text" class="form-control" id="currentPassword" name="currentPassword" required="" />
        </div>
      </div>
        <div class="form-group mt-3">
         <label for="nwPassword" id="labelNewPassword" class="col-sm-4 control-label font-weight-bold">New  Password :</label> <span id="errorNewPass"style='color:red;'></span>
        <div class="col-sm-6">          
        <input type="text" class="form-control" id="newPassword" name="newPassword"  required=""  >
        </div>
      </div>
        <div class="form-group mt-3">
         <label for="conPassword" id="labelConfirmNewPassword" class="col-sm-4 control-label font-weight-bold">Confirm New Password :</label><span id="errorConfirmPass"style='color:red;'></span>
        <div class="col-sm-6">          
        <input type="text" class="form-control" id="confirmPassword" name="confirmPassword"  required="" onChange="checkPasswordMatch();" >
        
        </div>
      </div>
   
      <div class="form-group">
        <div class="col-sm-4">
        <p class="registrationFormAlert" id="divCheckPasswordMatch"> </p>         
          <input type="submit"  class="form-control bg-gradient-primary text-gray-100" id="updatePasswordSubmit" name="updatePasswordSubmit" value="Update" >
        </div>
      </div>

      </form>
           
         <span class="empty" style="display: none; color: red;  ">**Field Must not be Empty**</span>
         <span class="error" id="error" style="display: none; color: red;  ">**Field Must not be Empty**</span>
        <span class="success_response" id="success_response" style="display: none">Password Updated Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">Failed to Change Password</span>
        <span class="error_respons
        eJob" id="error_responseJob" style="display: none; color: red;">Same Role Allready Exist</span>

         </div>
         <div class="col-sm-4">  
            <div class="form-group">
            <label for="lastName" class="col-sm-2 control-label font-weight-bold">Photo</label>
              <div class="col-sm-6">
                 <div class="image-preview_div" id="thumb-output" style="border-color: red" > 
                    <img src="admin/controller/employee/<?php echo $rowJobDetails['photo'] ?> " alt="">
                   
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

include_once ($filepath.'/inc/partials/logoutModal.php'); 
 ?> 

<?php 
include_once ($filepath.'/inc/partials/scripts.php'); 
 ?> 
<!-- Scripts -->
 <script type="text/javascript">
        // New From Validation
      function checkPasswordMatch() {
    var password = $("#newPassword").val();
    var confirmPassword = $("#confirmPassword").val();

    if (password != confirmPassword){
       $("#divCheckPasswordMatch").html("Password Do not match.").css('color', 'red');;
       return false;
   }
    else{
      $("#divCheckPasswordMatch").html("Password match.").css('color', 'green');;
      return true;
    }
}

$(document).ready(function(){
  $("#currentPassword").attr('readonly', 'true');
  $("#confirmPassword,#newPassword").keyup(checkPasswordMatch);
  
 $('#selectEmployee').on('change',function(){
          $("#thumb-output").empty();
           $("#AssignedJobDetailsDiv").hide();
         var find_employe_id = $(this).val();    
          if (find_employe_id) {
                $.ajax({
          url: "controller/employee/changePassword.php", 
          type: "POST",   
          data:{find_employe_id:find_employe_id},
          dataType: 'json',     
          cache: false,           
          success: function(data)
          {
            $('#currentPassword').val(data.password);
            $('#thumb-output').append( '<img src= "controller/employee/' +data.photo + '">'); 
          }
          });

          } 
    });
  // Form Subitting Event
 
 

$("#updatePasswordForm").on('submit',(function(e) {
  e.preventDefault();
     
            var selectEmployee = $("#selectEmployee").val();
            var currentPassword = $("#currentPassword").val();
            var newPassword = $("#newPassword").val();
            var confirmPassword = $("#confirmPassword").val();
            var newPasswordLength = newPassword.length;
            var currentPasswordLength= currentPassword.length;
            var confirmPasswordLength= confirmPassword.length;

            if (currentPasswordLength<4) {
               // alert("short");
                  $( "#errorCurPass").html( "Too Short Current Pasword" );         
                    return false;
            }
            else if (newPasswordLength<4 ) {
                  $( "#errorNewPass").html( "Too Short New Password" );         
                    return false;
            }
            else if (confirmPasswordLength<4 ) {
                  $( "#errorConfirmPass").html( "Too Short" );         
                    return false;
            }
            else {
              if (currentPassword==newPassword) {
                 $( "#errorConfirmPass").html( "You entered your current Password!!" );
              }else{
                $( "#errorNewPass" ).empty();
                $( "#errorCurPass" ).empty();
                $( "#errorConfirmPass" ).empty();
                if (checkPasswordMatch()){
            $.ajax({
          url: "controller/employee/changePassword.php",
          type: "POST",            
          data: new FormData(this),
          contentType: false,      
          cache: false,            
          processData:false,       
          success: function(data)  
          {
           

                 if($.trim(data) == "success") {

                  $('#thumb-output').html('');
                  $('#divCheckPasswordMatch').html('');
                  $('#file-input').val('');
                  $('#updatePasswordForm').trigger("reset");
                  $('#updatePasswordForm')[0].reset();
                       $(".success_response").show();
                       setTimeout(function(){
                        $(".success_response").fadeOut();
                       },3000);
                  }
              else {
                         $(".error_response").html(data);
                         $(".error_response").show();
                          setTimeout(function(){
                          $(".error_response").fadeOut();
                          },3000);
                      }

          
          }
          });
          }
               // return false;
            }

            }
            

         

     }));


   
});


</script>
  

</body>

</html>
