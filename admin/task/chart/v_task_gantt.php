<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="chart-task"; ?>
<?php include_once('../../inc/header.php'); ?>
 <!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $pageSlug;?></title>
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" href="favicon.png" type="image/png">
    <?php include_once('../../inc/stylesheets.php'); ?>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
</head>
<body>
     <div class="loader" ></div>
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Navbar Start -->
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/nav.php') ?>
        <!-- Navbar End -->

        <!-- Sidebar Start -->
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/sidebar.php') ?>
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
                <!-- mycode -->
              <div class="row align-items-center justify-content-center">
                <form method="post" class="justify-content-center" id="month_pickerForm" name="month_pickerForm">
                  <div class="form-inline">
                <input type="datepicker" class="form-control" name="month_picker" id="month_picker">
                <input type="submit" class="btn  btn-rounded btn-success m-2" name="month_pickerSubmit" id="month_pickerSubmit" value="Search">
                </div>
              </form>
            </div>
          <div id="chart-container" class="m-4">Chart will render here!</div>
                <!-- mycode -->
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
 <?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/scripts.php') ?>
    <!-- Page Level Scripts -->
    <script type="text/javascript" src="<?php echo $baseUrl.'admin/inc/js/jquery.mtz.monthpicker.js'; ?>"></script>
   <script type="text/javascript">
      $(document).ready(function(){
     $(".loader").fadeOut("slow");
       fetch_chart_data(month);
   });
      // $('#month_picker').monthpicker();
      $('#month_picker').monthpicker({ 
       pattern:'yyyy-mm',
      });
   </script> 
   <script type="text/javascript">
      var month;
     function fetch_chart_data(month=""){
 $.ajax({
        url:"../../controller/chart/task/gantt.php",
        type: 'GET',
        data:{month:month},
        success: function(data) {
          var cat=data.list_date;
          console.log(cat.category);
          var motnh_year_name=data.motnh_year_name;
          var obj = [];
          obj[0] = cat;
          chartData = data;
          var chartProperties = {
        "caption": "Task Management - Task Schedule",
        "subcaption":motnh_year_name,
        "dateformat": "mm-dd-yyyy hh:mm:ss",
        "outputDateFormat": "ddds mnl, yyyy ",
        "canvasBorderAlpha": "30",
        "showCanvasBorder": "1",
        "theme": ""
            };
      apiChart = new FusionCharts({
                type: 'gantt',
                renderAt: 'chart-container',
                width: '100%',
                height: '950',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "categories":obj,/* categories for list of date*/
                    "processes": data.process_j,/*list for employee name*/
                     "tasks": data.task_n
                }
            });
            apiChart.render();
        }
    });
     }
$(function() {
      $("#month_pickerForm").on('submit',(function(e) {
  e.preventDefault();
  // $(".loader").show();
   var month = $("#month_picker").val();
   // alert(month);
   fetch_chart_data(month);
        }));
 // Form Subitting Event     
});
  </script>
</body>
</html>
