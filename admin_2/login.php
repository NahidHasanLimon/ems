<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>7Teen EMS - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <style>
    .error{
      font-weight:2rem;
    }
  </style>

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" autocomplete="off">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                      <span class="error_email" id="invalid_email" style="display: none">Your Email is invalid</span>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                   <!--  <a href="index.html" class="btn btn-primary btn-user btn-block">
                      Login
                    </a> -->
                     <button type="submit" class="btn btn-primary btn-user btn-block" name="login_submit" id="login_submit">Log in</button>
                    <hr>
                    <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  </form>
                  
       <span class="disable"  style="display: none">Disabled Account!! Warning!!</span>
        <span class="empty" style="display: none ">Field Must not be Empty</span>
        <span class="error_failed" style="display: none; color: red; " >Email Password Do Not Matched</span>
                  <hr>
                 <!--  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div> -->
                  <!-- <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>


  <!-- ne js -->
  <script type="text/javascript">

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
          url:"controller/login/getlogin.php",
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


                  else if($.trim(data) == "error")
                  {
                    // alert("Email or password do not matched");
                          $(".error_failed").show();
                          setTimeout(function(){

                         $(".error_failed").fadeOut();
                       },3000);


                  }
                  else
                     {
                     // alert("Succesfully Logged In ");
                    //   window.location="index.php";
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
  <!-- NEw js end -->

</body>

</html>
