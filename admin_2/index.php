<?php include_once 'inc/header.php'; ?>
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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">


            <!-- Pending Requests Card Example -->

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Current Employee</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $totalCurEmployee.'</br>';?>
                    </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>  
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Current Male Employee</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $totalCurMale.'</br>';?>
                    </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
             <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Current Female Employee</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $totalCurFemale.'</br>';?>
                    </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>   
        <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Un Appointed Employee</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php 
                      $numberOfUnEmployeed=$usr->employee_not_exist_in_jobRoleTable();
                      if ($numberOfUnEmployeed) {
                        $count=mysqli_num_rows ($numberOfUnEmployeed);
                        echo $count;
                      }
                      else{
                        echo "0";
                       
                      }
                      ?>
                    </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Attendance || Approved Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        echo $totalUnapprovedDays;
                         ?>
                    
               
                    </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>



          </div>


          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Welcome!! <?php echo Session::get("first_name").' '.Session::get("last_name") ?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                      <a class="dropdown-item" href="v_profile.php">Profile</a>
                      <a class="dropdown-item" href="v_logged_attendance_details.php">Attendance Details</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row"> 
                    <div class="col-sm-6">
                      <img class="img-profile rounded" src="<?php echo '/ems/photo/'.Session::get("photo") ?>" style="height: 180px;width: 180px;">
                    </div>
                     <div class="col-sm-6">
                      <?php 
                      $lr=Session::get("loggedRole");
                        if ($lr==3) {
                         echo '<strong> Logged Role: Super Admin </strong>';
                        }
                       ?>
                    </div>
                  </div>
                 

                </div>
              </div>
            </div>

            <!-- Pie Chart -->
           <!--  <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4"> -->
                <!-- Card Header - Dropdown -->
              <!--   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div> -->
                <!-- Card Body -->
                <!-- <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div> -->
               <!--    <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                  </div> -->
                </div>
              </div>
            </div>
            
          </div>

          <!-- Content Row -->
        

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
    <?php
     // include_once 'inc/footer.php';  
     ?>
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
 <?php  include_once ($filepath.'/inc/partials/logoutModal.php'); ?>
<!-- Scripts -->

<?php 
include_once ($filepath.'/inc/partials/scripts.php'); 
 ?> 
 
<!-- Scripts -->
  <!-- myScriptsForThisCompanyPage -->
   <script type="text/javascript">
 $(document).ready(function(){


            });

    // End of New Code
  $( function() {

    $( "#datepicker" ).datepicker({
       dateFormat: "yy-mm-dd"

    });

});
</script>
  

  <!-- myScriptsForThisCompanyPage -->

</body>

</html>
