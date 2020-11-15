<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="employee-list"; ?>
<?php include_once('inc/header.php'); ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    $AssignJobRoleUser=$usr->all_assigned_jobs_active_employee_details();
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
                <div class="container">
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
        <table class="table responsive table-striped table-dark table table-borderless text-center" id="assignedJobTable"> 
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
      <div class="col-sm-6">
         <div class="image-preview_div" id="thumb-output" style="border-color: red" > </div> 
      </div>
    </div> 
  </div> 
 <!-- End of Col-sm-4 -->
                  </div>
                  <!-- End of row   -->
<!-- end of For Div -->
</div>
        
         <!-- My Code -->
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
$('#date_pickerModal').datepicker({ format: 'yyyy-mm-dd' });
$(document).ready(function(){
    $(".loader").fadeOut("slow");
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
</body>
</html>
