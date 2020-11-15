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
    <link rel="icon" href="favicon.png" type="image/png">
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
                    <div class="col-md-6">
                        <div class="panel" id="chart-container" >
                           
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel">
                               
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel">
                                
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
    <!-- Fusion Charts -->
    <!-- <div id="chart-container">FusionCharts will render here</div> -->
  <!-- <script src="js/jquery-2.1.4.js"></script> -->
  <script src="fusionChart/js/fusioncharts.js"></script>
  <script src="fusionChart/js/fusioncharts.charts.js"></script>
  <script src="fusionChart/js/themes/fusioncharts.theme.zune.js"></script>
  <!-- <script src="fusionChart/js/app.js"></script> -->
  <script type="text/javascript">
     function fetch_chart_data(){
 $.ajax({

        url: 'http://localhost/ems/admin/fusionChart/server_side/wokring_days_fusion_chart_data.php',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "Monthly Working Days Overview",
                "xAxisName": "Employee",
                "yAxisName": "Attendance Days",
                "rotatevalues": "1",
                "theme": "zune",
                
            };

            apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'chart-container',
                width: '550',
                height: '350',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData
                }
            });
            apiChart.render();
        }
    });
     }
      $(function() {
        fetch_chart_data();
   
});
  </script>
  <!-- Fusion Charts -->


</body>
</html>
