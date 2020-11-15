<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php 
$pageSlug="Home";
$filepath = realpath(dirname(__FILE__));
?>
<?php include_once('inc/header.php'); ?>
<?php 
if (Session::get("loggedRole")==3 || Session::get("loggedRole")==2 ) {

  if (Session::get("loggedRole")==3) {
      $unApproved_attendanceDate=$atn->unApproved_attendanceDate_role_3();
    }
    else if (Session::get("loggedRole")==2) {
      $unApproved_attendanceDate=$atn->unApproved_attendanceDate_role_2();
    }
     if ($unApproved_attendanceDate) {
       $totalUnapprovedDays=mysqli_num_rows($unApproved_attendanceDate);
      }
      else{
        $totalUnapprovedDays=0;
      }
    }
    else {
       $totalUnapprovedDays=0;
    }

// Count Current Employee and male Female
     $current_employee_count_gender=$usr->current_employee_count_gender();
      if ($current_employee_count_gender) {
            $fetchCurEmployeeNumber=mysqli_fetch_assoc($current_employee_count_gender);
            $totalCurEmployee=$fetchCurEmployeeNumber['total'];
            $totalCurMale=$fetchCurEmployeeNumber['male'];
            $totalCurFemale=$fetchCurEmployeeNumber['female'];
            $totalCurOthers=$fetchCurEmployeeNumber['others'];
          }else{
            $totalCurEmployee=0;
            $totalCurMale=0;
            $totalCurFemale=0;
            $totalCurOthers=0;
          }

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
    <link rel="icon" href="customLogo_95by25.png" type="image/png">
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
                <div class="container-fluid">
                    <h2 class="page--title h5">Dashboard</h2>
                </div>
            </section>
            <!-- Page Header End -->

            <!-- Main Content Start -->
            <section class="main--content">
                <div class="row gutter-20">
                    <div class="col-md-4">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel">
                                <div class="miniStats--header bg-darker">
                                   

                                    
                                    <p class="miniStats--label text-white bg-orange">
                                        <i class="fa fa-level-down-alt"></i>
                                        <span>Attendance</span>
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-user text-blue"></i>

                                    <p class="miniStats--caption text-blue">
                                        <table class="table-responsive table style--2 text-orange">
                                            <tr><td></td> <td ><b>yesterday</b></td> <td ></td> <td >Today</td></tr>
                                            <tr><td>In:</td><td >12.00</td> <td ></td> <td>C. Soon</td></tr>
                                            <tr><td>Out:</td><td >12.00</td> <td ></td> <td>C. Soon</td></tr>
                                            
                                        </table>
                                    </p>
                                    
                                    
                                </div>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel">
                                <div class="miniStats--header bg-darker">
                                    

                                    <p class="miniStats--label text-white bg-orange">
                                        <i class="fa fa-level-down-alt"></i>
                                        <span>Issues</span>
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-ticket-alt text-orange"></i>
                                    <p class="miniStats--num text-orange mb-1">
                                        U. App. Att.: <br>
                                        Un app. Att.:
                                    </p>
                                </div>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel">
                                <div class="miniStats--header bg-darker">
                                   

                                    <p class="miniStats--label text-white bg-green">
                                        <i class="fa fa-level-up-alt"></i>
                                        <span>Number of Employee</span>
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-user text-green"></i>

                                    <p class="miniStats--caption text-green">Number of</p>
                                    <h3 class="miniStats--title h6">Employee</h3>
                                    <p class="miniStats--num text-green">
                                        <i class="fa fa-male"></i><span> &nbsp;<?php echo $totalCurMale;?> </span>&nbsp;
                                        <i class="fa fa-female"></i><span> &nbsp;<?php echo $totalCurFemale;?> </span>
                                </p>
                                </div>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>



                    
                </div>
            </section>
            <!-- Main Content End -->


        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
<?php include_once('inc/scripts.php') ?>

    <!-- Page Level Scripts -->

</body>
</html>
