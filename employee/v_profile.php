<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkEmployeeSession();?>
<?php $pageSlug="Profile"; ?>
<?php include_once('inc/header.php'); ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    $emp_id =Session::get("emp_id");
        $findEmployeeInformation=$usr->find_employee_info($emp_id);
        $row =$findEmployeeInformation->fetch_assoc();
        $jobDetails= $usr->an_employees_assigned_jobs_details_based_on_designation($emp_id);
 ?>
 <!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- ==== Document Title ==== -->
    <title><?php echo $pageSlug; ?></title>
    
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
<?php include_once('inc/stylesheets.php'); ?>
    
    <!-- Page Level Stylesheets -->

</head>
<body id="page1">
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
                <div class="container">
                    <!-- My Code -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="jobHistory-tab" data-toggle="tab" href="#jobHistory" role="tab" aria-controls="jobHistory" aria-selected="false">Job History</a>
                                </li> 
                                 <li class="nav-item">
                                    <a class="nav-link" id="changePassword-tab" data-toggle="tab" href="#changePassword" role="tab" aria-controls="changePassword" aria-selected="false">Change Password</a>
                                </li>
                            </ul>
     
          <!-- form div -->
          <div class="tab-content profile-tab" id="myTabContent">
          <div class="tab-pane fade show active m-2" id="home" role="tabpanel" aria-labelledby="home-tab">

 <form action="" method="post" id="updateProfileForm" enctype="multipart/form-data" autocomplete="off" onSubmit="return validation();">    
          <div class="container">
          <!-- Row -->
          <div class="row ">

          <!-- col-sm-6 -->
          <div class="col-sm-6 ">

 


  <input type="hidden" value="<?php echo $emp_id ?>" name="employee_id">   
     <div class="form-group">
        <label for="firstName" class="col-sm-4 control-label font-weight-bold">First Name:</label>
        <div class="col-sm-8">          
        <input type="text" class="form-control" name="firstName" id="firstName"  placeholder="Enter your Name " value="<?php echo $row['first_name']; ?>" required />
        </div>
      </div>
      <div class="form-group">
        <label for="lastName" class="col-sm-4 control-label font-weight-bold">Last Name:</label>
        <div class="col-sm-8">          
        <input type="text" class="form-control" name="lastName" id="lastName"  placeholder="Enter your Last Name" value="<?php echo $row['last_name'];?> " required />
        </div>
      </div>
 
    <div class="form-group">
    <label for="email" class="col-sm-4 control-label font-weight-bold">Email :</label>
    <div class="col-sm-8">
     <input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email" value="<?php echo $row['email']; ?>"required="" autocomplete="off" />
     <span class="error_email" id="invalid_email" style="color: red; display: none">Your Email is invalid</span>
    </div>
    </div>
 
      <div class="form-group">
      <label for="gender" class="col-sm-4 control-label font-weight-bold">Gender:</label>
      <div class="col-sm-12 form-inline">
      <label class="radio-inline">
      <input type="radio" name="gender" class="gender" id="gender" value="1" <?php if($row['gender']==1)echo 'checked' ?> >Male
      </label>&emsp;
      <label class="radio-inline">
      <input type="radio" name="gender" class="Gender" id="gender" value="2" <?php if($row['gender']==2)echo 'checked' ?>>Female
      </label>&emsp;
      <label class="radio-inline">
      <input type="radio" name="gender" class="Gender" id="gender" value="3" <?php if($row['gender']==3)echo 'checked' ?>>Others
      </label>
       
      </div>
      </div>
      
 
      <div class="form-group">
      <label for="dob" class="col-sm-4 control-label font-weight-bold">DOB:</label>
      <div class="col-sm-8">
      <input class="form-control" type="text" id="datepicker" name="datepicker"  data-date-format='yyyy-mm-dd' value=" <?php echo $row['dob']; ?> " required="">
      </div>
      </div>

      <div class="form-group">
      <label for="mobileNo" class="col-sm-4 control-label font-weight-bold">Mobile:</label>
      <div class="col-sm-8">
       <input type="number" class="form-control" name="mobileNo" id="mobileNo"  placeholder="Enter Your Mobile No" value="<?php echo $row['mobileNo']; ?>"  required=""/>
       
      </div>
      </div>

      <div class="form-group">
      <label for="nid" class="col-sm-4 control-label font-weight-bold">NID :</label>
      <div class="col-sm-8">
      <input type="number" class="form-control" name="nid" id="nid"  placeholder="Enter your nid(OnlyNumber)" value="<?php echo $row['nid']; ?>" />
      </div>
      </div>



      <div class="form-group">
      <label for="address" class="col-sm-4 control-label font-weight-bold">Address:</label>
      <div class="col-sm-8">
      <textarea class="form-control" name="address" id="address" value="Enter Your Address"required=""><?php echo $row['address']; ?></textarea> 
      </div>
      </div>
 </div>
      <!-- First Div-->
       <!-- Start Second Div -->
    <div class="col-sm-4">  

    <div class="form-group">
    <span  class="col-sm-4 control-label font-weight-bold">Photo(JPG,JPEG,PNG,GIF)</span>
    <div class="col-sm-6">
       <div class="image-preview_div" id="thumb-output" style="border-color: red" > 
        <img src="/ems/photo/<?php echo $row['photo'] ?>" alt="">
       </div> 
        <!-- file-input -->
    <input class="mt-3" type="file" id="file-input" name="file-input" multiple />
     <span class="file_upload_response" id="file_upload_response" style="display: none"></span>
    </div>
    </div>  

        <span class="empty" style="display: none ">**Field Must not be Empty**</span>
        <span class="disable"  style="display: none">Disabled Account!! Warning!!</span>
        <span class="success_response" id="success_response" style="display: none">Employee Updated Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">***</span>

       <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" name="addEmployeeSubmit2" id="addEmployeeSubmit2" class="btn btn-primary btn-lg mt-5   login-button" value="Update"/>
        </div>
      </div>
      </div> 
      <!-- End Second Div -->

  </div> 
  <!-- End of row -->
  
                  </div>
                  <!-- End of Form container   -->
                </form>
              </div>
              <!-- end of home tab -->

                           <div class="tab-pane fade m-2" id="jobHistory" role="tabpanel" aria-labelledby="jobHistory-tab">
                         <div class="jobHistoryContainer">
                                        <?php if ($jobDetails) { ?>
                      <table class="table responsive table-striped table-dark table table-bordered text-center"> 
                         <thead>
                        <td>Sl#</td>
                        <td>Designation</td>
                        <td>Department</td>
                        <td>Company</td>
                        <td>Salary</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                      </thead>
                       <tbody>
                      <?php
                      $i=1;
                    while($row=$jobDetails->fetch_assoc()){
                    ?>
                   
                     
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row['des_name']; ?></td>
                          <td><?php echo $row['dep_name']; ?></td>
                          <td><?php echo $row['comp_name']; ?></td>
                          <td><?php echo $row['salary']; ?></td>
                          <td><?php echo $row['start_date']; ?></td>
                          <td><?php echo ($row['end_date']=="")?"Current": $row['end_date']; ?></td>
                        </tr>
                    
                 <?php  $i++;  } ?>
                        </tbody>
                          </table>
                   <?php  }
                else{
                  echo "No Job Yet";
                } ?>
                         </div>
                   </div>
                   <!-- end of Job History Tab -->
                <div class="tab-pane fade m-2" id="changePassword" role="tabpanel" aria-labelledby="changePassword-tab">
                    <form action="" method="post" id="updatePasswordForm" autocomplete="off">
                        <div class="row mb-3">
                              <div class="col-md-4">
                                  <label class=" control-label">Current</label>
                              </div>
                              <div class="col-md-8 input-group">
                            <input class="form-control" type="password" name="currentPassword" id="currentPassword" placeholder="type your current password" > <span class="ml-2" style=" display:none ;" id="errorCurrentPass"><i class="fa fa-times" style="max-width: 40%;font-size:20px;color:red"></i>Wrong current password</span>
                              </div>
                          </div>
                          <div class="row mb-3">
                              <div class="col-md-4">
                                  <label class=" control-label">New</label>
                              </div>
                              <div class="col-md-8 input-group">
                           <input class="form-control" type="password" name="newPassword" id="newPassword" placeholder="type a new password" autocomplete="off">
                              </div>
                             <span class="ml-2" style=" display:none;" id="errorNewPass"></span>

                          </div> 
                           <div class="row mb-3">
                              <div class="col-md-4">
                                  <label class=" control-label">Confirm New </label>
                              </div>
                              <div class="col-md-8">
                             <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="confirm new password" autocomplete="off">
                              </div>
                          </div> 
                           <span class="registrationFormAlert" id="passwordValidityResponse" style="align-content: right;"> </span>   
                         <input class="btn btn-info bg-gradient-success text-gray-100 seeAllEmployee float-right" type="submit" name="changePasswordSubmit" id="changePasswordSubmit" value="update">
                              </div>
                        </form>
                                     
                     </div>
                     <!-- end of changePassword Tab -->
            </div>

                </div>
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
<?php include_once('inc/scripts.php') ?>
    <!-- Page Level Scripts -->
    <script type="text/javascript">
    $('#datepicker').datepicker({ format: 'yyyy-mm-dd' });
   // New From Validation
         function validation(){
        if($("#name, #email, #password, #nid,  #mobileNo,  #datepicker, #gender, #file-input").val()==""){
            $("#name, #email, #password,  #nid,  #mobileNo,  #datepicker, #gender, #file-input").addClass('is-invalid');
            return false;
        }else{
            $("#name, #email, #password, #nid, #mobileNo, #datepicker, #gender, #file-input").removeClass('is-invalid');
        }
         
        
    }
        // New From Validation
        function checkPasswordLength() {
    var newPasswordLength = $("#newPassword").val().length;
    var confirmPasswordLength = $("#confirmPassword").val().length;
    if (newPasswordLength<= 5){
       $("#errorNewPass").html("at least 6 characters.").css('color', 'red');;
         $("#errorNewPass").show();
       $("#confirmPassword").attr('readonly','true');
       return false;
   }
    else{
      $("#confirmPassword").removeAttr('readonly');
       $('#errorNewPass').html('');
      return true;
    }

}
   function checkPasswordMatch() {
    var currentPassword = $("#currentPassword").val();
    var password = $("#newPassword").val();
    var confirmPassword = $("#confirmPassword").val();

    if (checkPasswordLength()) {
      if (password != confirmPassword){
       $("#passwordValidityResponse").html("Password Do not match.").css('color', 'red');;

       return false;
   }
    else{
      $("#passwordValidityResponse").html("Password match.").css('color', 'green');;
      return true;
    }
    }
    else{
      return false;

    }
    
}


$(document).ready(function(){
    $(".loader").fadeOut("slow");
    $("updatePasswordForm").attr('autocomplete', 'off');
     $("#confirmPassword,#newPassword").keyup(checkPasswordMatch);
//  
  $("addEmployeeForm").attr('autocomplete', 'off');
  
   $('#datepicker').datepicker();

  $('.error_email').hide();
  $("#email").click(function(){
     $('.error_email').hide();
    });
  // new Form Validation
  $("#name").on("keyup",function(){
            if($("#name").val()==""){
                $("#name").addClass('is-invalid');
                return false;
            }else{
                $("#name").removeClass('is-invalid');
            }
        });
        $("#email").on("keyup",function(){
            if($("#email").val()==""){
                $("#email").addClass('is-invalid');
                return false;
            }else{
                $("#email").removeClass('is-invalid');
            }
        });  
        $("#mobileNo").on("keyup",function(){
            if($("#mobileNo").val()==""){
                $("#mobileNo").addClass('is-invalid');
                return false;
            }else{
                $("#mobileNo").removeClass('is-invalid');
            }
        });  
        $("#nid").on("keyup",function(){
            if($("#nid").val()==""){
                $("#nid").addClass('is-invalid');
                return false;
            }else{
                $("#nid").removeClass('is-invalid');
            }
        }); 
        $("#gender").on("keyup",function(){
            if($("#gender").val()==""){
                $("#gender").addClass('is-invalid');
                return false;
            }else{
                $("#gender").removeClass('is-invalid');
            }
        });
        $("#password").on("keyup",function(){
            if($("#password").val()==""){
                $("#password").addClass('is-invalid');
                return false;
            }else{
                $("#password").removeClass('is-invalid');
            }
        });
        $("#address").on("keyup",function(){
            if($("#address").val()==""){
                $("#address").addClass('is-invalid');
                return false;
            }else{
                $("#address").removeClass('is-invalid');
            }
        }); 
        $("#datepicker").on("change",function(){
            if($("#datepicker").val()==""){
                $("#datepicker").addClass('is-invalid');
                return false;
            }else{
                $("#datepicker").removeClass('is-invalid');
            }
        });
  // new Form Validation

  $('#file-input').on('change', function(){
    var sizef = document.getElementById('file-input').files[0].size;
                if(sizef > 1048567){
                    alert('File Size Should be Less Than 1 MB;');
                     // $('#file-input').removeAttr('value');
                      $('#file-input').val('');

                      $('.file_upload_response').html('File Size Should be Less Than 1 MB');
                       $(".file_upload_response").show();

                       setTimeout(function(){

                        $(".file_upload_response").fadeOut();
                       },3000);
                         $('#thumb-output').html('');
                }else {
                    //action
                    //Preview
                    if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
      $('#thumb-output').html(''); //clear html of output element
      var data = $(this)[0].files; //this file data
      
      $.each(data, function(index, file){ //loop though each file
        if(/(\.|\/)(jpeg|jpe?g|png)$/i.test(file.type)){ //check supported file type
          var fRead = new FileReader(); //new filereader
          fRead.onload = (function(file){ //trigger function on successful read
          return function(e) {
            var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
            $('#thumb-output').append(img); //append image to output element
            $('.image-preview_div').css("display", "block");
          };
            })(file);
          fRead.readAsDataURL(file); //URL representing the file's data.
        }
      });
      
    }else{
      alert("Your browser doesn't support File API!"); //if File API is absent
    }
                    //Preview
                }  

      });

 // Form Subitting Event
$("#updateProfileForm").on('submit',(function(e) {
  e.preventDefault();
       
   var email=$("#email").val();
   if(email== ''){
          $('#email').next().show();
          return false;
        }
        if(IsEmail(email)==false){
          $('#invalid_email').show();
          return false;
        }

        if($("#name, #email, #nid,  #mobileNo,  #datepicker, #gender, #file-input").val()!=""){

       
                 $.ajax({
          url: "controller/employee/updateProfile.php", // Url to which the request is send
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,        // To send DOMDocument or non processed data file it is set to false
          success: function(data)   // A function to be called if request succeeds
          {
           $('#thumb-output').html('');
            $('#file-input').val('');
                 if($.trim(data) == "success") {
                         swal({
                      title: "Success!",
                      text: "Updated Successfully",
                      icon: "success",
                      closeOnClickOutside: true,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: true,
                      dangerMode: false,
                        }).then(function(){
                            location.reload();
                        });
                  }
                 else if($.trim(data) == "Email address Allready Exist") {
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
                  alert("Field Can nto be MEpty ");

               }       

     }));

   // Form Subitting Event
   $("#updatePasswordForm").on('submit',(function(e) {
  e.preventDefault();
     if (checkPasswordMatch()) {
        $.ajax({
          url: "controller/changePassword.php",
          type: "POST",            
          data: new FormData(this),
          contentType: false,      
          cache: false,            
          processData:false,       
          success: function(data)  
          {
                 if($.trim(data) == "success") {
                    $('#thumb-output').html('');
                  // $('#updatePasswordForm').trigger("reset");
                  $('#updatePasswordForm')[0].reset();
                  $("#passwordValidityResponse").html("Password Changed Successfully.").css('color', 'green');;
                       $('#passwordValidityResponse').show();
                       setTimeout(function(){
                        $("#passwordValidityResponse").fadeOut();
                       },3000);
                  }
                  else if($.trim(data) == "error") {
                  $('#thumb-output').html('');
                  // $('#divCheckPasswordMatch').html('');
                  $('#file-input').val('');
                  $('#updatePasswordForm').trigger("reset");
                  $('#updatePasswordForm')[0].reset();
                       $(".success_response").show();
                       setTimeout(function(){
                        $(".success_response").fadeOut();
                       },3000);
                  }
                 else if($.trim(data) == "same") {
                
                  $('#passwordValidityResponse').html('You entered your current password').css('color', 'red');;
                  // $('#updatePasswordForm').trigger("reset");
                  // $('#updatePasswordForm')[0].reset();
                       $("#passwordValidityResponse").show();
                       setTimeout(function(){
                        $("#passwordValidityResponse").fadeOut();
                       },3000);
                  }
                  else if($.trim(data) == "wrong") {
                  // $('#updatePasswordForm').trigger("reset");
                  // $('#updatePasswordForm')[0].reset();
                       $("#errorCurrentPass").show();
                       setTimeout(function(){
                        $("#errorCurrentPass").fadeOut();
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
          

         

     }));

   
});
 function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
          return false;
        }
        else{
          return true;
        }
      }

</script>
  

</body>
</html>
