<?php include_once 'inc/header.php'; 
     Session::checkAdminRole_2_3_Permission();
      ?>

      <!-- End of Header -->
       <!-- my PHP Code  -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
       $AssignJobRoleUser=$usr->all_currentAssigned_jobs_active_employee_details();
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
           <p> <h6 class="text-center"><b>End  Employee Role</b></h6>

          <!-- Page Heading -->
          <!-- <h6 class="h4 mb-4 text-gray-800 text-center">Company CRUD</h6> -->
      
     
          <!-- My Code -->
<!-- form div -->
          <!-- Row -->
          <!-- border border-primary -->
          <div class="row">

            <!-- col-sm-2 -->
          <!--   <div class="col-xs-2">
            Place Blank
            </div> -->
             <!-- End col-sm-2 -->

          <!-- col-sm-6 -->
          <div class="col-sm-8 ">
    <form action="" method="post" id="EmployeeEndRoleForm" enctype="multipart/form-data" autocomplete="off" >       
     <div class="form-group">
        <label for="firstName" class="col-sm-4 control-label font-weight-bold">Select Employee:</label>
        <div class="col-sm-6">          
        <select class="form-control" name="selectEmployee" id="selectEmployee">
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
      </div>
      <span class="success_response te" id="success_response" style="display: none">Job Roll End Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">***</span>
      <div class="col-sm-12" id="AssignedJobDetailsDiv" style="display: none;"> 
        <table class="table-responsive table-bordered" id="assignedJobTable"> 
          <thead>
            <th>Designation</th>
            <th>Department</th>
            <th>Company</th>
            <th>Salary</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Action</th>
          </thead> 
          <tbody id="assignedJobTableBody">   
          </tbody>
        </table>
       </div>
        </form>
     </div>

      <!-- End col-sm-8  First Div-->
       <!-- col-sm-2 -->
  



     <div class="col-sm-4">  

    <div class="form-group">
    <label for="lastName" class="col-sm-2 control-label font-weight-bold">Photo</label>
    <div class="col-sm-6">
       <div class="image-preview_div" id="thumb-output" style="border-color: red" >
        <!-- <img src="" id="image_emp" alt=""> -->

        </div> 

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
// include_once (  $baseUrl.'admin/inc/partials/logoutModal.php');
// include File In respective to Header File Location 
include_once ($filepath.'/inc/partials/logoutModal.php'); 
 ?> 
<!-- Scripts -->
<?php 
include_once ($filepath.'/inc/partials/scripts.php'); 
 ?> 
<!-- Scripts -->


 <script type="text/javascript">

$(document).ready(function(){
  // $("#selectEmployee").click(function () { 
  //   // $('#thumb-output').val('');
  //    // $("#thumb-output").empty();
    
    
  // }); 
 $(document).on('click', '.endJobRole', function(){  
  if( !confirm('Are you sure you want to End this Job Role?')) {
                    return false;
   }
    var endJobRoleID = $(this).attr("id");  
           if(endJobRoleID != '')  
           {  
                $.ajax({  
                     url:"controller/job_role/end_role_employee.php",  
                     method:"POST",  
                     data:{endJobRoleID:endJobRoleID},  
                     success:function(data){  
                      // alert(data);
                           if($.trim(data) == "success") {

                       // $(".success_response").show();

                       // setTimeout(function(){

                       //  $(".success_response").fadeOut();
                       // },3000);
                       swal({
                      title: "Success!",
                      text: "Employee Job Role Ended Successfully",
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
                       $("#AssignedJobDetailsDiv").hide();
                         
                     }  
                });  
           } 
    
    
  });

//  
 
         // On Change Function
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
                 $('#thumb-output').append( '<img src= "/ems/photo/' +photo + '">');
                
            }

            })
           
       
        if(selectedEmployeeID){
            $.ajax({
                type:'POST',
                url:'controller/job_role/end_role_employee.php',
                data:'selectedEmployeeID='+selectedEmployeeID,
                // dataType:"json",
                success:function(data){

               
                  if (data!='') {
                  // console.log(data);
                $('#assignedJobTableBody').html(data); 
                $("#AssignedJobDetailsDiv").show();
                }
                else{
                 // $('#assignedJobTableBody').html('<h1>No Data Available</>'); 
                  $("#AssignedJobDetailsDiv").hide();
                 
                }
                }
            }); 
        }
    });
    
});
 

</script>
  
  
<!-- Scripts for this page onlyt  -->

</body>


</html>
