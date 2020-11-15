
  <!-- Header -->
    <?php include_once 'inc/header.php'; 
     Session::checkAdminRole_2_3_Permission();
     ?>

      <!-- End of Header -->
       <!-- my PHP Code  -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
       $AssignJobRoleUser=$usr->all_assigned_jobs_active_employee_details();
      ?>

       <!-- my PHP Code  -->

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
           <p> <h6 class="text-center"><b>Promote || Edit Employee Role</b></h6>

          <!-- Page Heading -->
          <!-- <h6 class="h4 mb-4 text-gray-800 text-center">Company CRUD</h6> -->
    
     
          <!-- My Code -->
<!-- form div -->
          <!-- Row -->
          <!-- border border-primary -->
          <div class="row">          
          <div class="col-sm-8">
     <div class="form-group">
        <label for="firstName" class="col-sm-4 control-label font-weight-bold">Select Employee:</label>
        <div class="col-sm-6">          
        <select class="form-control" name="selectEmployee" id="selectEmployee">
          <option value="">Select an employee</option>
          <?php 
                 
                   if($AssignJobRoleUser){
                     $users_data=array();
                    print_r($AssignJobRoleUser);

                               while($row = mysqli_fetch_array($AssignJobRoleUser))
                               {
                                 $users_data[] = $row;
                   ?>
                  <option class="form-control" value="<?php echo $row['emp_id']; ?>"> <?php echo $row['first_name'].' '.$row['last_name']; ?> </option>
                 <?php } } ?>
        </select>
        </div>
      </div>
      <div class="col-sm-12" id="AssignedJobDetailsDiv" style="display: none;"> 
        <table class="table-responsive table-bordered" id="assignedJobTable"> 
          <thead>
            <th>Designation</th>
            <th>Department</th>
            <th>Company</th>
            <th>Salary</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th rowspan="2">Edit</th>
            <th rowspan="2">Promote</th>
          </thead> 
          <tbody id="assignedJobTableBody">
          </tbody>
        </table>
       </div>
     </div>

      <!-- End col-sm-8  First Div-->
  
  <div class="col-sm-4">  
    <div class="form-group">
    <label for="lastName" class="col-sm-2 control-label font-weight-bold">Photo</label>
      <div class="col-sm-6">
         <div class="image-preview_div" id="thumb-output" style="border-color: red" > </div> 
      </div>
    </div> 
  </div> 
 <!-- End of Col-sm-4 -->
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
include_once ($filepath.'/inc/partials/logoutModal.php'); 
include_once ($filepath.'/inc/modal/modal_promote_edit_role.php'); 
 ?> 
<!-- Scripts -->
<?php 
include_once ($filepath.'/inc/partials/scripts.php'); 
 ?> 
<!-- Scripts -->


 <script type="text/javascript">
$('#date_pickerModal').datepicker({ format: 'yyyy-mm-dd' });
$(document).ready(function(){
  $('#modal_promote_edit_role').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
});
 
 $(document).on('click', '.promoteJobRole', function(){  

    var promoteJobRoleID = $(this).attr("id");  
    var promoteEmployeeeID = $('#selectEmployee').val();
     $('#employee_id').val(promoteEmployeeeID); 
     $('#job_role_id').val(promoteJobRoleID); 
    // $('#modal_promote_edit_role').modal('show');
    // for preventing modal closing in outside click
     $('#modal_promote_edit_role').modal({
    show: true,
    keyboard: false,
    backdrop: 'static'
  }); 

    
  });

 
 
         // On Change Function
      $('#selectEmployee').on('change',function(){  
          $("#thumb-output").empty();
           $("#AssignedJobDetailsDiv").hide();
         var selectedEmployeeID = $(this).val();
         
          var users_data_js_array_script = <?php echo json_encode($users_data); ?>;
        
          $.each(users_data_js_array_script,
            function(propName, propVal)
            {
            if(propVal['emp_id']==selectedEmployeeID){
                 var photo= propVal['photo'];
                 $('#thumb-output').append( '<img src= "/ems/photo/' +photo + '">');
             
            }

            })
           
       
        if(selectedEmployeeID){
            $.ajax({
                type:'POST',
                url:'controller/job_role/promote_employee.php',
                data:'selectedEmployeeID='+selectedEmployeeID,
              
                success:function(data){
                  if (data!='') {
                  // console.log(data);
                $('#assignedJobTableBody').html(data); 
                $("#AssignedJobDetailsDiv").show();
                }
                else{
                  $("#AssignedJobDetailsDiv").hide();
                 
                }
                }
            }); 
        }
    });
      // only for modal changes
      $('#selectCompanyFromModal').on('change',function(){
        var selectedCompanyID = $(this).val();
        // alert(selectedCompanyID);
        if(selectedCompanyID){
            $.ajax({
                type:'POST',
                 url:'controller/job_role/insert_edit_delete.php',
                data:'selectedCompanyID='+selectedCompanyID,
                success:function(html){
                    $('#selectDepartmentFromModal').html(html);
                    $('#selectDesignationFromModal').html('<option value="">Select Department first</option>'); 
                }
            }); 
        }else{
            $('#selectDepartmentFromModal').html('<option value="">Select  Company First</option>');
            $('#selectDesignationFromModal').html('<option value="">Select Department first</option>'); 
        }
    });
    
    $('#selectDepartmentFromModal').on('change',function(){
        var selectedDepartmentID = $(this).val();
        if(selectedDepartmentID){
            $.ajax({
                type:'POST',
                url:'controller/job_role/insert_edit_delete.php',
                data:'selectedDepartmentID='+selectedDepartmentID,
                success:function(html){
                    $('#selectDesignationFromModal').html(html);
                }
            }); 
        }else{
            $('#selectDesignationFromModal').html('<option value="">Select Department first</option>'); 
        }
    });



    $("#promoteEmployee").on('submit',(function(e) {
  e.preventDefault();

                 $.ajax({
          url: "controller/job_role/promote_employee.php", // Url to which the request is send
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
                      text: "Employee Promoted Successfully",
                      icon: "success",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: false,
                        }).then(function(){
                          location.reload();
                            $('#promoteEmployee').trigger("reset");
                           $('#promoteEmployee')[0].reset();
                          $('#modal_promote_edit_role').modal('toggle');
                        }); 


                  }
                 else if($.trim(data) == "Same Job allready exist") {
    //use #for id and dot(.) for class
                      $(".error_response").html(data);
                         $(".error_response").show();
                          setTimeout(function(){
                          $(".error_response").fadeOut();
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
                     

     }));
  
    
});
 

</script>
  
  
<!-- Scripts for this page onlyt  -->

</body>


</html>
