<?php include_once'inc/header.php'; 
Session::checkAdminRole_2_3_Permission();?>

      <!-- End of Header -->
       <!-- my PHP Code  -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
       // $resultJobRole=$usr->all_active_employee_details();
       $resultJobRole=$usr->current_jobs_endDateisNull_all_employee_details();
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
       <p> <h6 class="text-center"><b>Terminate Employee</b></h6>

          <!-- Page Heading -->
          <!-- <h6 class="h4 mb-4 text-gray-800 text-center">Company CRUD</h6> -->
      <div class="col-xs-1 text-center messageShowingDiv">
        <span class="disable"  style="display: none">Disabled Account!! Warning!!</span>
        <span class="empty" style="display: none ">**Field Must not be Empty**</span>
        <span class="success_response" id="success_response" style="display: none">Employee Terminated Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">***</span>
      </div>
     
          <!-- My Code -->
<!-- form div -->
          <!-- Row -->
          <div class="row border border-primary shadow rounded pt-2 ml-5 mr-5 pb-3">

            <!-- col-sm-2 -->
          <!--   <div class="col-xs-2">
            Place Blank
            </div> -->
             <!-- End col-sm-2 -->

          <!-- col-sm-6 -->
          <div class="col-sm-6 ml-2 ">


  <form action="" method="post" id="addEmployeeTerminateForm" enctype="multipart/form-data" autocomplete="off" >       
     <div class="form-group">
        <label for="firstName" class="col-sm-2 control-label font-weight-bold">Name:</label>
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
                   <option class="form-control" value="<?php echo $rowJobRole['emp_id']; ?>"> <?php echo $rowJobRole['first_name']; ?> </option>
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
<label for="lastName" class="col-sm-2 control-label font-weight-bold">Photo()</label>
<div class="col-sm-6">
   <div class="image-preview_div" id="thumb-output" style="border-color: red" > </div> 
   
    <!-- file-input -->

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
  
  
<!-- Scripts for this page onlyt  -->

</body>


</html>
