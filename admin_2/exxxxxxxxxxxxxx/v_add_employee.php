<?php 
$filepath = realpath(dirname(__FILE__));
// include_once ($filepath.'/inc/header.php');
 ?>

  <!-- Header -->
    <?php include_once 'inc/header.php';  ?>
      <!-- End of Header -->

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
          <h6 class="h6 mb-4 text-gray-800">Add Employee</h6>
          <!-- My Code -->

        <div class="container mt-2 mb-4">
    <div class="row justify-content-md-center">
        <div class="col-sm-4 border border-primary shadow rounded pt-2">
            <div class="text-center"><img src="https://placehold.it/80x80" class="rounded-circle border p-1"></div>
            <div class="col-sm-12">
                <form method="post" id="singnupFrom" onSubmit="return validation();">
                    <div class="form-group">
                        <label class="font-weight-bold">Email</label>
                        <div class="input-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter valid email">
                            <div class="input-group-append"><button type="button" class="btn btn-primary" onClick="return emailCheck();"><i class="fa fa-envelope"></i></button></div>
                        </div>
                    </div>
                    <div id="next-form" class="collapse">
                        <div class="form-group">
                            <label class="font-weight-bold">User Name <small class="text-danger"><em>This will be your login name!</em></small></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Choose your user name">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Phone #</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="(000)-(0000000)">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Confirm Password</label>
                            <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="***********">
                            <em id="cp"></em>
                        </div>
                        <div class="form-group">
                            <label><input type="checkbox" name="condition" id="condition"> I agree with the <a href="javascript:;">Terms &amp; Conditions</a> for Registration.</label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Sign Up" class="btn btn-block btn-danger">
                        </div>
                    </div> <!--/.next-form-->
                </form>
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

  <script>
    function emailCheck(){
        if($("#email").val()==""){
            $("#email").addClass('is-invalid');
            return false;
        }else{
            var regMail     =   /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
            if(regMail.test($("#email").val()) == false){
                $("#email").addClass('is-invalid');
                return false;
            }else{
                $("#email").removeClass('is-invalid');
                $('#next-form').collapse('show');
            }
 
        }
    }
    function validation(){
        if($("#username, #phone, #password, #cpassword").val()==""){
            $("#username, #phone, #password, #cpassword").addClass('is-invalid');
            return false;
        }else{
            $("#username, #phone, #password, #cpassword").removeClass('is-invalid');
        }
         
        if($("#password").val()!=$("#cpassword").val()){
            $("#cpassword").addClass('is-invalid');
            $("#cp").html('<span class="text-danger">Password and confirm password not matched!</span>');
            return false;
        }
    }
    $(document).ready(function(e) {
        $("#username").on("keyup",function(){
            if($("#username").val()==""){
                $("#username").addClass('is-invalid');
                return false;
            }else{
                $("#username").removeClass('is-invalid');
            }
        });
        $("#phone").on("keyup",function(){
            if($("#phone").val()==""){
                $("#phone").addClass('is-invalid');
                return false;
            }else{
                $("#phone").removeClass('is-invalid');
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
        $("#cpassword").on("keyup",function(){
            if($("#cpassword").val()==""){
                $("#cpassword").addClass('is-invalid');
                return false;
            }else{
                $("#cpassword").removeClass('is-invalid');
            }
        });
    });
</script>

  

</body>

</html>
