<?php include_once 'inc/header.php'; 
     Session::checkAdminRole_2_3_Permission();
     ?>
      <!-- End of Header -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
         if (isset($_GET['jobRoleID'])) {
        $jobRoleID = (int)$_GET['jobRoleID'];
        // print_r($jobRoleID);
        $all_company_details=$comp->all_company_details($jobRoleID);

        $findJobRoleInformation=$jobRole->find_jobRole_details_byJobRoleID($jobRoleID);
        $rowJobDetails =$findJobRoleInformation->fetch_assoc();
        // print_r($rowJobDetails);

        $emp_first_name=$rowJobDetails['first_name'];
        $emp_last_name=$rowJobDetails['last_name'];
        $photo=$rowJobDetails['photo'];
        $comp_id=$rowJobDetails['comp_id'];
        $dep_id=$rowJobDetails['dep_id'];
        $des_id=$rowJobDetails['des_id'];
        $findAllDepartmanetbyCompID=$dep->find_SelectedCompanies_department_details($comp_id);
        $findAllDesignationbyDepID=$des->find_SelectedDepartment_designation_details($dep_id);
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
          <!-- Page Heading -->
          <h6 class="h4 mb-4 text-gray-800">Edit Job Role</h6>

        <div class="col-xs-1 text-center messageShowingDiv">
        
      </div>
     
          <!-- My Code -->
         <div class="row">

          

          <div class="col-sm-8"> 
            <div class="form-group">
            <label for="lastName" class="col-sm-6 control-label font-weight-bold">Employee Name</label>
              <div class="col-sm-8">
                <label for="" class="form-control"> <?php echo $emp_first_name.' '.$emp_last_name; ?> </label>
              </div> 
            </div>
        <form action="" method="post" name="" id="editJobRoleForm">
          <input type="hidden" name="hidden_employee_id" id="hidden_employee_id" value="<?php echo $rowJobDetails['emp_id'] ?>" >
          <input type="hidden" name="hidden_jobRoleID" id="hidden_jobRoleID" value="<?php echo $rowJobDetails['jobRoleID'] ?>" >

            <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">Company:</label>
        <div class="col-sm-8">          
        <select class="form-control" name="selectCompany" id="selectCompany">
          <option value="">Select a company</option>
          <?php 
                  
                   if($all_company_details){
                    // print_r($all_company_details);

                               while($rowAllComp = mysqli_fetch_array($all_company_details))
                               {
                   ?>
                   <option class="form-control" value="<?php echo $rowAllComp['comp_id'];?>" <?php if($rowAllComp['comp_id']==$comp_id)
                   echo "selected" ?> > <?php echo $rowAllComp['comp_name']; ?> </option>
                 <?php } } ?>
        </select>

        </div>
      </div>
        <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">Departemnt:</label>
        <div class="col-sm-8">          
         <select class="form-control" name="selectDepartment" id="selectDepartment">
          <option value="">Select a Department</option>
          <?php 
                  
                   if($findAllDepartmanetbyCompID){
                    // print_r($all_company_details);

                               while($rowAllDep=mysqli_fetch_array($findAllDepartmanetbyCompID))
                               {
                   ?>
                   <option class="form-control" value="<?php echo $rowAllDep['dep_id'];?>" <?php if($rowAllDep['dep_id']==$dep_id)
                   echo "selected" ?> > <?php echo $rowAllDep['dep_name']; ?> </option>
                 <?php } } ?>
        </select>

        </div>
      </div>
             <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">Designation:</label>
        <div class="col-sm-8">          
        <select class="form-control" name="selectDesignation" id="selectDesignation">
          <option value="">Select a Designation</option>
          <?php 
                  
                   if($findAllDesignationbyDepID){
                    // print_r($all_company_details);

                               while($rowAllDes=mysqli_fetch_array($findAllDesignationbyDepID))
                               {
                   ?>
                   <option class="form-control" value="<?php echo $rowAllDes['des_id'];?>" <?php if($rowAllDes['des_id']==$des_id)
                   echo "selected" ?> > <?php echo $rowAllDes['des_name']; ?> </option>
                 <?php } } ?>
        </select>

        </div>
      </div>
      <div class="form-group">
        <label for="notes" class="col-sm-2 control-label font-weight-bold">Start Date:</label>
        <div class="col-sm-8">          
           <input class="form-control" type="text" id="start_date" name="start_date"  data-date-format='yyyy-mm-dd'required="" style="width: 80%" placeholder="Select a Date" value="<?php echo $rowJobDetails['start_date']  ?>" >
        </div>
      </div>
      <div class="form-group">
        <label for="notes" class="col-sm-2 control-label font-weight-bold">End Date:</label>
        <div class="col-sm-8">          
           <input class="form-control" type="text" id="end_date" name="end_date"  data-date-format='yyyy-mm-dd' style="width: 80%" placeholder="Select a Date" value="<?php echo $rowJobDetails['end_date']  ?>" >
        </div>
      </div>

      <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">JobNature:</label>
        <div class="col-sm-8">          
        <select class="form-control" name="job_nature" id="job_nature">
          <option value="">Select a Job Nature</option>
          <option class="form-control" value="1" <?php if($rowJobDetails['job_nature']==1)
                   echo "selected" ?> > Full Time </option>
                   <option class="form-control" value="2" <?php if($rowJobDetails['job_nature']==2)
                   echo "selected" ?> > Part Time </option>
        </select>

        </div>
      </div>

        <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">Salary:</label>
        <div class="col-sm-8">          
          <input type="number" class="form-control" id="salary" name="salary" value="<?php echo $rowJobDetails['salary'] ?>" >
        </div>
      </div>
      <div class="form-group">
        <label for="notes" class="col-sm-2 control-label font-weight-bold">Notes:</label>
        <div class="col-sm-8">          
          <input type="text"  class="form-control"id="notes" name="notes" value="<?php echo $rowJobDetails['notes'] ?>" >
        </div>
      </div> 
      

      <!-- <div class="form-group">
        <label for="notes" class="col-sm-2 control-label font-weight-bold">End Date:</label>
        <div class="col-sm-8">          
          <input type="text"  class="form-control"id="notes" name="notes" value="<?php echo $rowJobDetails['notes'] ?>" >
        </div>
      </div> -->
   
      <div class="form-group">
        <div class="col-sm-2">          
          <input type="submit"  class="form-control bg-gradient-primary text-gray-100" id="editJobRoleSubmit" name="editJobRoleSubmit" value="Update" >
        </div>
      </div>
      </form>
           
        <span class="disable"  style="display: none">Disabled Account!! Warning!!</span>
        <span class="empty" style="display: none ">**Field Must not be Empty**</span>
        <span class="success_response" id="success_response" style="display: none"> Job Role Updated Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">Failed to Insert</span>
        <span class="error_responseJob" id="error_responseJob" style="display: none; color: red;">Same Job Allready Exist</span>

         </div>
         <div class="col-sm-4">  
            <div class="form-group">
            <label for="lastName" class="col-sm-2 control-label font-weight-bold">Photo</label>
              <div class="col-sm-6">
                 <div class="image-preview_div" id="thumb-output" style="border-color: red" > 
                    <img src="/ems/photo/<?php echo $rowJobDetails['photo'] ?> " alt="">
                   
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
    $('#start_date').datepicker({ format: 'yyyy-mm-dd' });
    $('#end_date').datepicker({ format: 'yyyy-mm-dd' });
        // New From Validation


$(document).ready(function(){

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

    // Form Submitt
    $("#editJobRoleForm").on('submit',(function(e) {
  e.preventDefault();
       
  

        if($("#employee_id, #selectCompany, #selectDepartment, #selectDesignation,#salary").val()!=""){

       
                 $.ajax({
          url: "controller/job_role/edit_jobRole.php", // Url to which the request is send
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,        // To send DOMDocument or non processed data file it is set to false
          success: function(data)   // A function to be called if request succeeds
          {
           if($.trim(data) == "success") {
                        swal({
                      title: "Success!",
                      text: "Employee JobRole Updated Successfully",
                      icon: "success",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: false,
                        }).then(function(){
                          location.reload();
                           $('#editJobRoleForm').trigger("reset");
                        }); 


                  }
                 else if($.trim(data) == "error") {
                       swal({
                      title: "Error!",
                      text: data,
                      icon: "error",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: false,
                        }); 


                  } 
  else if($.trim(data) == "Same Job allready exist") {
    //use #for id and dot(.) for class
                       $(".error_responseJob").html(data);
                       $(".error_responseJob").show();
                       setTimeout(function(){
                        $(".error_responseJob").fadeOut();
                       },3000);


                  }  else if($.trim(data) == "Field Must Not be Empty") {
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
                  alert("Field Can not be Empty ");

               } 

               //View Employee From List      
               //View Employee From List      

     }));

   
});


</script>
  

</body>

</html>
