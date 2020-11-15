<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php
$pageSlug="end-role";
$filepath = realpath(dirname(__FILE__));
?>
<?php include_once('inc/header.php') ?>
<?php    $AssignJobRoleUser=$usr->all_currentAssigned_jobs_active_employee_details(); ?>
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

         
          <!-- col-sm-6 -->
          <div class="col-sm-8 ">     
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
     </div>
      <div class="row">
        <div class="col-sm-8" id="AssignedJobDetailsDiv"> 
        
       </div> 
     <div class="col-sm-4">  
    <div class="form-group">
    <label for="photo" class="col-sm-4 control-label font-weight-bold">Photo</label>
    <div class="col-sm-4" >
       <div class="image-preview_div affix" id="thumb-output" style="border-color: red" >
        <!-- <img src="" id="image_emp" alt=""> -->

        </div> 
    </div>
    </div>
 </div> 
 <!-- End of Col-sm-4 -->
 
               
          </div>
   <!-- end of row -->
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

$(document).ready(function(){

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
                 $('#thumb-output').append( '<img class="fit" src= "/ems/photo/' +photo + '">');
                
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
                $('#AssignedJobDetailsDiv').html(data); 
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

</body>
</html>
