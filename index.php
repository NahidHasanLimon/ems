<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');
 Session::checkAdminOrUserLogin();
 ?>
<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ==== Document Title ==== -->
    <title>EMS-7TEEN</title>
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- ==== Favicon ==== -->
    <link rel="icon" href="favicon.png" type="image/png">

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="assets/css/morris.min.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/jquery-jvectormap.min.css">
    <link rel="stylesheet" href="assets/css/horizontal-timeline.min.css">
    <link rel="stylesheet" href="assets/css/weather-icons.min.css">
    <link rel="stylesheet" href="assets/css/dropzone.min.css">
    <link rel="stylesheet" href="assets/css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="assets/css/ion.rangeSlider.skinFlat.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Page Level Stylesheets -->
    <style>
        .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('gif/Preloader_3.gif') 50% 50% no-repeat rgb(249,249,249);
    /*background: url('gif/giphy.gif') 50% 50% no-repeat rgb(249,249,249);*/
    opacity: .8;
}
    </style>

</head>
<body>
<div class="loader"></div>
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Login Page Start -->
        <!--<div class="m-account-w" data-bg-img="assets/img/account/wrapper-bg.jpg">-->
        <div class="m-account-w" data-bg-img="assets/img/account/Night-view-Dhaka-Bangladesh.jpg">
            <div class="m-account">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <!-- Login Content Start -->
                        <div class="m-account--content-w" data-bg-img="assets/img/account/Night-view-Dhaka-Bangladesh.jpg">
                            <div class="m-account--content">
                                <!-- <h2 class="h2">Don't have an account?</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <a href="register.html" class="btn btn-rounded">Register Now</a> -->
                            </div>
                        </div>
                        <!-- Login Content End -->
                    </div>

                    <div class="col-md-6">
                        <!-- Login Form Start -->
                        <div class="m-account--form-w">
                            <div class="m-account--form">
                                <!-- Logo Start -->
                                <div class="logo">
                                    <!--<img src="assets/img/logo.png" alt="">-->
                                    <img src="assets/img/7teen_re2.png" alt="">
                                </div>
                                <!-- Logo End -->

                                <form action="#" method="post" id="loginForm">
                                    <label class="m-account--title">Login to your account</label>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <input type="email" name="email" id="email" placeholder="Email" class="form-control" autocomplete="off" required>
                                        </div>
                                        <span class="error_email" id="invalid_email" style="display: none; color:#db6134;">Your Email is invalid</span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <input type="password" name="password" id="password" placeholder="Password" class="form-control" autocomplete="off" required>
                                            
                                        </div>
                                    </div>

                                    <div class="m-account--actions">
                                        <a href="enter_email.php" class="btn-link">Forgot Password?</a>

                                        <button type="submit" class="btn btn-rounded btn-info" id="login_submit">Login</button>
                                    </div>

                                    <div class="m-account--alt">
                                        <p><span class="error_failed" style="display: none; color:#db6134; " >Email or password do not matched</span></p>

                                        <div class="btn-list">
                                    <span class="disable"  style="display: none">Disabled Account!! Warning!!</span>
                                    <span class="empty" style="display: none ">Field Must not be Empty</span>
                                    
                                        </div>
                                    </div>

                                    <div class="m-account--footer">
                                        <p>&copy; 2019 7TEEN TECH</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Page End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/perfect-scrollbar.min.js"></script>
    <script src="assets/js/jquery.sparkline.min.js"></script>
    <script src="assets/js/raphael.min.js"></script>
    <script src="assets/js/morris.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery-jvectormap.min.js"></script>
    <script src="assets/js/jquery-jvectormap-world-mill.min.js"></script>
    <script src="assets/js/horizontal-timeline.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/jquery.steps.min.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <script src="assets/js/ion.rangeSlider.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- Page Level Scripts -->
     <script type="text/javascript">
 $(document).ready(function(){
$(".loader").fadeOut("slow");
            });

   $(function(){
    //for user registration
  $('.error_email').hide();
  $("#email").click(function(){
     $('.error_email').hide();
    });
      //For User Login
      $("#login_submit").click(function(){

       var email=$("#email").val();
       var password=$("#password").val();

          if(password== ''){
          $('#password').next().show();
          return false;
        }
        if(email== ''){
          $('#email').next().show();
          return false;
        }

      

       if(IsEmail(email)==false){
          // $('#invalid_email').show();
           $(".error_email").show();
                          setTimeout(function(){

                         $(".error_email").fadeOut();
                       },3000);

          return false;
        }

      //dataString is simply a variable
      var dataString ='email='+email+'&password='+password ;
      //ajax start
          $.ajax({
          //body of ajax

          type:"POST",
          url:"getlogin.php",
          data:dataString,
          //operation
          success: function(data){
            // alert(data);

                  if($.trim(data) == "empty") {
    //use #for id and dot(.) for class
                       $(".empty").show();

                       setTimeout(function(){

                        $(".empty").fadeOut();
                       },3000);


                  }


                  else if($.trim(data) == "employee")
                  {
                     window.location="employee/index.php";


                  }
                  else if($.trim(data) == "error")
                  {
                    // alert("Email or password do not matched");
                          $(".error_failed").show();
                          setTimeout(function(){

                         $(".error_failed").fadeOut();
                       },3000);


                  }
                  else if($.trim(data) == "admin")
                     {
                     // alert("Succesfully Logged In ");
                      window.location="admin/index.php";
                     }



          }




          });

                return false;

      });
      

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
