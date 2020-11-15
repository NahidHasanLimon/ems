<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="terminate-employee"; ?>
<?php include_once('inc/header.php'); ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    $resultJobRole=$usr->current_jobs_endDateisNull_all_employee_details();
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
<!--  div container -->
<div class="container">
          <!-- Row -->
          <div class="row">
          <!-- col-sm-6 -->
          <div class="col-sm-6 ml-2 ">

  <form action="" method="post" id="addEmployeeTerminateForm" enctype="multipart/form-data" autocomplete="off" >       
     <div class="form-group">
        <label for="firstName" class="col-sm-4 control-label font-weight-bold">Select a Name:</label>
        <div class="col-sm-6">          
        <select class="form-control" name="selectEmployee" id="selectEmployee">
          <option value="">Select an employee</option>
          <?php 
                 
                   if($resultJobRole){
                    $users_data=array();
                    var_dump($resultJobRole);

                               while($rowJobRole = mysqli_fetch_array($resultJobRole))
                               {
                                 $users_data[] = $rowJobRole;
                   ?>
                   <option class="form-control" value="<?php echo $rowJobRole['emp_id']; ?>"> <?php echo $rowJobRole['first_name'].$rowJobRole['last_name'] ?> </option>
                 <?php } } ?>
        </select>
        </div>
      </div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden" name="formSubmitorNot" value="formSubmitorNot">
       <input type="hidden" id="actionValue" name="actionValue" value="insert">
    <input type="submit" name="terminateEmployee" id="terminateEmployee" class="btn btn-danger btn-lg mt-5   login-button" value="Terminate"  onclick="return confirm(' you want to terminate?');">
    </div>
  </div> 
     </div>

      <!-- End col-sm-8  First Div-->
       <!-- col-sm-2 -->
  

  </form>

     <div class="col-sm-4">  

<div class="form-group">
<div class="col-sm-6">
   <div class="image-preview_div" id="thumb-output" style="border-color: red" > </div> 
   
    <!-- file-input -->

</div>
</div> 
 </div> 
 <!-- End of Col-sm-4 -->
                  </div>
                  <!-- End of row   -->

       </div>         

<!-- end of For Div -->
        
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
    $(".loader").fadeOut("slow");
  $("#selectEmployee").click(function () { 
    // $('#thumb-output').val('');
     // $("#thumb-output").empty();
  });

//  
  $("addEmployeeTerminateForm").attr('autocomplete', 'off');
  
   

  $('.error_email').hide();
  $("#email").click(function(){
     $('.error_email').hide();
    });
  // new Form Validation
  
         // On Change Function
      $('#selectEmployee').on('change',function(){
        // var selectedEmployeeID = $(this).val();
        //   $("#thumb-output").empty();
       
        // if(selectedEmployeeID){
        //     $.ajax({
        //         type:'POST',
        //         url:'controller/employee/terminate_employee.php',
        //         data:'selectedEmployeeID='+selectedEmployeeID,
        //         dataType:"json",
        //         success:function(data){
                     
        //              $('#thumb-output').append( '<img src= "controller/employee/' +data.photo + '">');
                    
        //         }
        //     }); 
        // }
        $("#thumb-output").empty();
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
           
    });
  
 // Form Subitting Event
$("#addEmployeeTerminateForm").on('submit',(function(e) {
  e.preventDefault();
       
  

        if($("#selectEmployee").val()!=""){

       
                 $.ajax({
          url: "controller/employee/terminate_employee.php", // Url to which the request is send
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,        // To send DOMDocument or non processed data file it is set to false
          success: function(data)   // A function to be called if request succeeds
          {
           $('#thumb-output').html('');
            $('#file-input').val('');
            // alert(data);
                 if($.trim(data) == "1") {

                       // $(".success_response").show();

                       // setTimeout(function(){

                       //  $(".success_response").fadeOut();
                       // },3000);
                       swal({
                      title: "Success!",
                      text: "Employee Terminated Successfully",
                      icon: "success",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: false,
                        }).then(function(){
                            $('#addEmployeeTerminateForm')[0].reset();
                            location.reload();
                        }); 

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

   // Form Subitting Event
   
});
 

</script>

</body>
</html>
