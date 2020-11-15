<?php include_once('inc/header.php'); ?>
<?php 
       $filepath = realpath(dirname(__FILE__));
      ?>
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
                                    <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#2bb3c0">5,6,9,4,9,5,3,5,9,15,3,2,2,3,9,11,9,7,20,9,7,6</p>

                                    <p class="miniStats--label text-white bg-blue">
                                        <i class="fa fa-level-up-alt"></i>
                                        <span>Attendance</span>
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-user text-blue"></i>

                                    <p class="miniStats--caption text-blue">
                                        <table class="table-responsive table style--2 text-orange">
                                            <tr><td></td> <td ><b>yesterday</b></td> <td ></td> <td >Today</td></tr>
                                            <tr><td>In:</td><td >12.00</td> <td ></td> <td>7.00</td></tr>
                                            <tr><td>Out:</td><td >12.00</td> <td ></td> <td>7.00</td></tr>
                                            
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
                                    <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#e16123">2,2,3,9,11,9,7,20,9,7,6,5,6,9,4,9,5,3,5,9,15,3</p>

                                    <p class="miniStats--label text-white bg-orange">
                                        <i class="fa fa-level-down-alt"></i>
                                        <span>10%</span>
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-ticket-alt text-orange"></i>

                                    <p class="miniStats--caption text-orange">Issues</p>
                                    <h3 class="miniStats--title h4">Tickets Answered</h3>
                                    <p class="miniStats--num text-orange">
                                        Un app. Att.: <br>
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
                                    <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#009378">2,2,3,9,11,9,7,20,9,7,6,5,6,9,4,9,5,3,5,9,15,3</p>

                                    <p class="miniStats--label text-white bg-green">
                                        <i class="fa fa-level-up-alt"></i>
                                        <span></span>
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-user text-green"></i>

                                    <p class="miniStats--caption text-green">Number of</p>
                                    <h3 class="miniStats--title h4">Employee</h3>
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
