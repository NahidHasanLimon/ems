<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="manage-employee-role"; ?>
<?php include_once('inc/header.php'); ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    $AssignJobRoleUser=$usr->current_jobs_endDateisNull_all_employee_details();
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
          <input type="submit"  class="btn btn-rounded btn-primary" id="editJobRoleSubmit" name="editJobRoleSubmit" value="Update Role" >
        </div>
      </div>

      </form>
         </div>
         <div class="col-sm-4">  
            <div class="form-group">
              <div class="col-sm-6">
                 <div class="image-preview_div" id="thumb-output" style="border-color: red" > 
                    <img src="/photo/<?php echo $rowJobDetails['photo'] ?>" alt="">
                   
                 </div> 
              </div>
            </div> 
          </div> 
          
         </div>
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
    <!-- Scripts -->
 <script type="text/javascript">
        // New From Validation
$(document).ready(function(){
    $(".loader").fadeOut("slow");
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
