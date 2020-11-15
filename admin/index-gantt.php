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
   <script src="//cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.widgets.js"></script>
  <script src="fusionChart/js/fusioncharts.js"></script>
  <script src="fusionChart/js/fusioncharts.charts.js"></script>
  <script src="fusionChart/js/themes/fusioncharts.theme.zune.js"></script>

  <!-- <script src="fusionChart/js/app.js"></script> -->
  <script type="text/javascript">
      FusionCharts.ready(function() {
  var cnstrctnPlan = new FusionCharts({
    type: 'gantt',
    renderAt: 'chart-container',
    width: '750',
    height: '500',
    dataFormat: 'json',
    dataSource: {
      "chart": {
        "dateformat": "mm/dd/yyyy",
        "caption": "Social Media Optimization",
        "theme": "fusion",
        "canvasBorderAlpha": "40"
      },
      "datatable": {
        "headervalign": "bottom",
        "datacolumn": [{
          "headertext": "Owner",
          "headerfontsize": "18",
          "headervalign": "bottom",
          "headeralign": "left",
          "align": "left",
          "fontsize": "12",
          "text": [{
              "label": "John"
            },
            {
              "label": "David"
            },
            {
              "label": "Mary"
            },
            {
              "label": "John"
            },
            {
              "label": "Andrew & Harry"
            },
            {
              "label": "John & Harry"
            },
            {
              "label": "Neil & Harry"
            },
            {
              "label": "Neil & Harry"
            },
            {
              "label": "Chris"
            },
            {
              "label": "John & Richard"
            }
          ]
        }]
      },
      "categories": [{
          "category": [{
              "start": "08/01/2014",
              "end": "09/30/2014",
              "label": "Q3"
            },
            {
              "start": "10/01/2014",
              "end": "12/31/2014",
              "label": "Q4"
            },
            {
              "start": "01/01/2015",
              "end": "03/31/2015",
              "label": "Q1"
            }
          ]
        },
        {
          "category": [{
              "start": "08/01/2014",
              "end": "08/31/2014",
              "label": "Aug '14"
            },
            {
              "start": "09/01/2014",
              "end": "09/30/2014",
              "label": "Sep '14"
            },
            {
              "start": "10/01/2014",
              "end": "10/31/2014",
              "label": "Oct '14"
            },
            {
              "start": "11/01/2014",
              "end": "11/30/2014",
              "label": "Nov '14"
            },
            {
              "start": "12/01/2014",
              "end": "12/31/2014",
              "label": "Dec '14"
            },
            {
              "start": "01/01/2015",
              "end": "01/31/2015",
              "label": "Jan '15"
            },
            {
              "start": "02/01/2015",
              "end": "02/28/2015",
              "label": "Feb '15"
            },
            {
              "start": "03/01/2015",
              "end": "03/31/2015",
              "label": "Mar '15"
            }
          ]
        }
      ],
      "processes": {
        "fontsize": "12",
        "isbold": "1",
        "align": "left",
        "headerText": "Steps",
        "headerFontSize": "20",
        "headerVAlign": "bottom",
        "headerAlign": "left",
        "process": [{
            "label": "Identify Customers"
          },
          {
            "label": "Survey 500 Customers"
          },
          {
            "label": "Interpret Requirements"
          },
          {
            "label": "Market Analysis"
          },
          {
            "label": "Brainstorm concepts"
          },
          {
            "label": "Define Ad Requirements"
          },
          {
            "label": "Design & Develop"
          },
          {
            "label": "Mock test"
          },
          {
            "label": "Documentation"
          },
          {
            "label": "Start Campaign"
          }
        ]
      },
      "tasks": {
        "hoverFillColor": "#F4BEFF",
        "hoverFillAlpha": "80",
        "task": [{
            "start": "08/04/2014",
            "end": "08/10/2014"
          },
          {
            "start": "08/08/2014",
            "end": "08/19/2014"
          },
          {
            "start": "08/19/2014",
            "end": "09/02/2014"
          },
          {
            "start": "08/24/2014",
            "end": "09/02/2014"
          },
          {
            "start": "09/02/2014",
            "end": "09/21/2014"
          },
          {
            "start": "09/21/2014",
            "end": "10/06/2014"
          },
          {
            "start": "10/06/2014",
            "end": "01/21/2015",
            "hoverFillColor": "#1FC0FF",
            "hoverFillAlpha": "80"
          },
          {
            "start": "01/21/2015",
            "end": "02/19/2015"
          },
          {
            "start": "01/28/2015",
            "end": "02/24/2015"
          },
          {
            "start": "02/24/2015",
            "end": "03/27/2015"
          }
        ]
      }

    }
  }).render();
});

  </script>
  <!-- Fusion Charts -->


</body>
</html>
