<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="Task Timeline"; ?>
<?php include_once('inc/header.php'); ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
 ?>
 <?php
 $employees=$usr->all_currentAssigned_jobs_active_employee_details();
   if (!isset($_POST['date_picker']) || !isset($_POST['select_employee']) ) {
  $now = new DateTime();
  $startDate= $now->format('Y-m').'-01';
  $taskName=$gc->task_name();
  $emp_nameR="All Task";
   }
        else
        {
  $startDate=$_POST['date_picker'].'-01';
  $emp_id=$_POST['select_employee'];
  $taskName=$gc->an_employee_task_name_in_a_month($emp_id,$startDate);

  $emp_name=$gc->find_employee_name($emp_id);
  if ($emp_name) {
  $emp_nameResult=$emp_name->fetch_assoc();
  $emp_nameR=$emp_nameResult['first_name'].' '.$emp_nameResult['last_name'];
  }else{
    $emp_nameR="No Name";
  }
  
      }
        // $taskName=$gc->task_name();
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
    <!-- page level scripts -->
    <style type="text/css">
        HTML CSS JSResult
EDIT ON
/* RESET RULES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
:root {
  --white: #fff;
  --divider: lightgrey;
  --body: #f5f7f8;
}

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

ul {
  list-style: none;
}

a {
  text-decoration: none;
  color: inherit;
}

body {
  background: var(--body);
  font-size: 16px;
  font-family: sans-serif;
  padding-top: 40px;
}

.chart-wrapper {
  /*max-width: 1150px;*/
  padding: 0 10px;
  margin: 0 auto;
}


/* CHART-VALUES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.chart-wrapper .chart-values {
  position: relative;
  display: flex;
  /*margin-bottom: 20px;*/
  margin-bottom: 10px;
  font-weight: bold;
  /*font-size: 1.2rem;*/
  font-size: 1rem;
}

.chart-wrapper .chart-values li {
  flex: 1;
  /*min-width: 80px;*/
  /*min-width: 10px;*/
  min-width: 5px;
  text-align: center;
}

.chart-wrapper .chart-values li:not(:last-child) {
  position: relative;
}

.chart-wrapper .chart-values li:not(:last-child)::before {
  content: '';
  position: absolute;
  right: 0;
  height: 510px;
  border-right: 1px solid var(--divider);
  content: "|";
}
/*new*/
/*.chart-wrapper .chart-values li:not(:last-child):after {
  content: "|";
  }*/


/* CHART-BARS
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.chart-wrapper .chart-bars li {
  position: relative;
  color: var(--white);
  /*margin-bottom: 15px;*/
  margin-bottom: 5px;
  /*font-size: 16px;*/
  font-size: 10px;
  /*font-size: 10px;*/
  /*border-radius: 20px;*/
  /*border-radius: 10px;*/
  border-radius: 5px;
  /*padding: 10px 20px;*/
  /*padding: 5px 5px;*/
  padding: 1px 1px;
  width: 0;
  opacity: 0;
  transition: all 0.65s linear 0.2s;
  text-align: center;
}

@media screen and (max-width: 600px) {
  .chart-wrapper .chart-bars li {
    padding: 10px;
  }
}


/* FOOTER
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.page-footer {
  font-size: 0.85rem;
  padding: 10px;
  text-align: right;
  color: var(--black);
}

.page-footer span {
  color: #e31b23;
}



/*Resources1×0.5×0.25×Rerun*/
    </style>
    <!-- page level scripts -->
</head>
<body>
     <div class="loader" ></div>
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
                 <h2 class="page--title h5"><?php echo $pageSlug;  ?></h2>
            </section>
            <!-- Page Header End -->

            <!-- Main Content Start -->
            <section class="main--content">
                <!-- mycode -->
                <div class="container">
                  <!-- Choosing Month -->
    <div class="row align-items-center justify-content-center">
      <div class="col-14 mb-2">
       <p> <h6 class="text-center"> <b> Task  </b></h6>
              <form class="form-inline" name="SearchForm" action="blank.php" method="post" autocomplete="off"onsubmit="validateForm()">
                <div class="row">
                    <input type="text" class="form-control" name="date_picker"id="date_picker" placeholder="Select your month..."/>
                    <select name="select_employee" id="select_employee" class="form-control" required="">
                      <option>Select an Employee</option>
                      <?php if ($employees){ 
                        while ($rowEmp=$employees->fetch_assoc()) { ?>
                           <option value="<?php echo $rowEmp['emp_id']; ?>"><?php echo $rowEmp['first_name'].' '.$rowEmp['last_name']; ?></option>
                      <?php } } ?>
                     
                    </select>
                        <!-- <button value="Search" name="search" id="search" class="form-control btn btn-info btn-sm ml-2" type="submit" onClick="return document.getElementById('date_picker').value !='' && document.getElementById('select_employee').value !='' " ><i class="fas fa-search"></i></button> -->
                        <input type="submit" name="">

                        </div>
                </form>
              </p>
      </div>
    </div>

 <!-- Choosing Month -->
 <!-- Display Choosen Month -->
 <h3 class="text-center" id="month" value="<?php
                  echo date('F , Y', strtotime($startDate));
                  ?>">  <b><?php
                  echo date('F , Y', strtotime($startDate));
                  ?></b> Details </h3>

                  <h4 class="text-center"><?php echo($emp_nameR);  ?></h4>
 <!-- Display Choosen Month -->

</div>
 <div class="chart-wrapper border p-2">
                    <ul class="chart-bars">
  <?php
  if ($taskName) {
  $i=1;
   while ($rowTask=$taskName->fetch_assoc()) {
    // print_r($rowTask);
     $i++;
     list($yearStart, $monthStart, $dayStart) = explode("-", $rowTask['start_date']);
       // echo $dayStart;
       list($yearEnd, $monthEnd, $dayEnd) = explode("-", $rowTask['end_date']);
       // echo $dayEnd;


     ?>
    <!-- <?php echo $dayStart;?>-<?php echo $dayEnd; ?>  -->
     
     <li data-task_id="<?php echo $rowTask['id'];?>" data-duration="<?php echo $dayStart.'-'.$dayEnd;?>" data-color="#30997a"><?php echo $rowTask['name']; ?></li> 
 <?php } ?>
  
  </ul>
  <ul class="chart-values">
  <?php for ($i=1; $i <31; $i++) { ?>
       <?php if ($i<10) { ?>
           <li>0<?php echo $i; ?></li>
      <?php  } else{ ?>
 <li><?php echo $i; ?></li>
    
<?php } } }else{echo "No Task Assigned";} ?>
  </ul>
</div>


             </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->


    <!-- Scripts -->
<?php include_once('inc/scripts.php') ?>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<!-- $(".loader").fadeOut("slow"); -->
    <!-- Page Level Scripts -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script type="text/javascript">
   function validateForm() {
    var a = document.forms["SearchForm"]["date_picker"].value;
    var b = document.forms["SearchForm"]["select_employee"].value;
    if (a == null || a == "", b == null || b == "") {
      alert("Please Fill All Required Field");
      return false;
    }
  }
  $("#date_picker").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
        }
    });

        function createChart(e) {
  const days = document.querySelectorAll(".chart-values li");
  const tasks = document.querySelectorAll(".chart-bars li");
  const daysArray = [...days];

  tasks.forEach(el => {
    const duration = el.dataset.duration.split("-");
    const startDay = duration[0];
    const endDay = duration[1];
    let left = 0,
      width = 0;

    if (startDay.endsWith("½")) {
      const filteredArray = daysArray.filter(day => day.textContent == startDay.slice(0, -1));
      left = filteredArray[0].offsetLeft + filteredArray[0].offsetWidth / 2;
    } else {
      const filteredArray = daysArray.filter(day => day.textContent == startDay);
      left = filteredArray[0].offsetLeft;
    }

    if (endDay.endsWith("½")) {
      const filteredArray = daysArray.filter(day => day.textContent == endDay.slice(0, -1));
      width = filteredArray[0].offsetLeft + filteredArray[0].offsetWidth / 2 - left;
    } else {
      const filteredArray = daysArray.filter(day => day.textContent == endDay);
      width = filteredArray[0].offsetLeft + filteredArray[0].offsetWidth - left;
    }

    // apply css
    el.style.left = `${left}px`;
    el.style.width = `${width}px`;
    if (e.type == "load") {
      el.style.backgroundColor = el.dataset.color;
      el.style.opacity = 1;
    }
  });
}

window.addEventListener("load", createChart);
window.addEventListener("resize", createChart);
         $(document).ready(function(){
$('#departmentTable').DataTable();
 $(".loader").fadeOut("slow");
});
    </script>
    

</body>
</html>
