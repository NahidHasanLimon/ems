

  <!-- Header -->
    <?php include_once 'inc/header.php';  ?>
      <!-- End of Header -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
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
      
         <!-- My Code -->
        

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
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


$(document).ready(function(){
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
$("#addEmployeeForm").on('submit',(function(e) {
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

        if($("#name, #email, #password, #nid,  #mobileNo,  #datepicker, #gender, #file-input").val()!=""){

       
                 $.ajax({
          url: "controller/employee/addEmployee.php", // Url to which the request is send
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
    //use #for id and dot(.) for class
                       $(".success_response").show();

                       setTimeout(function(){

                        $(".success_response").fadeOut();
                       },3000);


                  }
                 else if($.trim(data) == "Email address Allready Exist") {
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
                  alert("Field Can nto be MEpty ");

               }       

     }));

   // Form Subitting Event

   
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
