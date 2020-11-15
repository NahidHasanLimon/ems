<?php include_once ('inc/header.php'); ?>
 <?php 
  $employee_id=$_SESSION['emp_id'];
  $at_date=date("Y-m-d");
  // print_r($at_date);
  $find_employee_info= $usr->find_employee_info($employee_id);
  $empDetails=$find_employee_info->fetch_assoc();

  $jobDetails= $usr->an_employees_assigned_jobs_details_based_on_designation($employee_id);

  ?>
  <!-- Navigation -->
 
  <!-- Page Content -->
  <div class="container">
  <div class="container emp-profile">
           
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="/ems/photo/<?php echo $_SESSION['photo'] ?>" alt="Card image" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top: 200px;">
                        <div class="profile-head">
                                    <h5>
                                       <?php echo $_SESSION['first_name'].' '. $_SESSION['last_name'] ?>
                                    </h5>
                                    <h6>
                                        <!-- Web Developer and Designer -->
                                    </h6>
                                   <p class="proile-rating"><span>
                                      <?php 
                                      if ($empDetails['gender']==1) {
                                        echo "Male";
                                      }elseif ($empDetails['gender']==2) {
                                       echo "Female";
                                      }elseif ($empDetails['gender']==3) {
                                        echo "Others";
                                      }else{
                                        echo "Open";
                                      }
                                      
                                        ?>
                                      </span>
                                    </p>
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
                        </div>
                    </div>
                    <div class="col-md-2">
                        <!-- <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>First Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $empDetails['first_name']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label> Last Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $empDetails['last_name']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $empDetails['email']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                 <p><?php echo $empDetails['mobileNo']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Date of Birth</label>
                                            </div>
                                            <div class="col-md-6">
                                                 <p><?php echo date("F jS, Y", strtotime($empDetails['dob'])); ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                 <p><?php echo $empDetails['address']; ?></p>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>NID</label>
                                            </div>
                                            <div class="col-md-6">
                                                 <p><?php echo $empDetails['nid']; ?></p>
                                            </div>
                                        </div>
                            </div>
                           <div class="tab-pane fade" id="jobHistory" role="tabpanel" aria-labelledby="jobHistory-tab">
                                      <?php if ($jobDetails) { ?>
                      <table class=" table table-bordered table-responsive"> 
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
                  <div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="changePassword-tab">
                    <form action="" method="post" id="updatePasswordForm" autocomplete="off">
                        <div class="row mb-3">
                              <div class="col-md-4">
                                  <label>Current</label>
                              </div>
                              <div class="col-md-8 input-group">
                            <input class="" type="password" name="currentPassword" id="currentPassword" placeholder="type your current password" > <span class="ml-2" style=" display:none ;" id="errorCurrentPass"><i class="fa fa-times" style="max-width: 40%;font-size:20px;color:red"></i>Wrong current password</span>
                              </div>
                          </div>
                          <div class="row mb-3">
                              <div class="col-md-4">
                                  <label>New</label>
                              </div>
                              <div class="col-md-8 input-group">
                           <input class="" type="password" name="newPassword" id="newPassword" placeholder="type a new password" autocomplete="off">
                         <span class="ml-2" style=" display:none;" id="errorNewPass"><i class="fa fa-times" style="max-width:40%;font-size:20px;color:red"></i>6</span>
                              </div>

                          </div> 
                           <div class="row mb-3">
                              <div class="col-md-4">
                                  <label>Confirm New </label>
                              </div>
                              <div class="col-md-8">
                             <input class="" type="password" name="confirmPassword" id="confirmPassword" placeholder="confirm new password" autocomplete="off">
                              </div>
                          </div> 
                           <span class="registrationFormAlert" id="passwordValidityResponse" style="align-content: right;"> </span>   
                          <div class="row mt-3">
                              <div class="col-md-4">
                                  
                              </div>
                              <div class="col-md-4">
                             <input class="btn btn-primary btn-sm change-password-btn" type="submit" name="changePasswordSubmit" id="changePasswordSubmit" value="Save">
                              </div>
                          </div>
                        </form>
                                     
                     </div>

                           

                        </div>
                    </div>
                </div>      
        </div>
                           
</div>
 
<script>
  // .removeAttr("readonly")  (
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

  $(document).ready(function() {
      // $("#currentPassword").removeAttribute('autocomplete');
     $("updatePasswordForm").attr('autocomplete', 'off');
     $("#confirmPassword,#newPassword").keyup(checkPasswordMatch);
    
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
</script>
</body>

</html>
