<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');?>
<?php $pageSlug="on-process-project"; ?>
<?php include_once('../inc/header.php'); ?>
<?php
// $projects= $pro->all_project_details();

 ?>
 <!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- ==== Document Title ==== -->
    <title><?php echo $pageSlug; ?></title>
    
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
<?php include_once('../inc/stylesheets.php'); ?>
    
    <!-- Page Level Stylesheets -->

</head>
<body>
     <div class="loader" ></div>
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Navbar Start -->
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/employee/inc/nav.php') ?>
        <!-- Navbar End -->

        <!-- Sidebar Start -->
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/employee/inc/sidebar.php') ?>
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
                <table class="table responsive table-striped table-dark table table-borderless text-center" id="pendingTasksTable">
                                <thead class="text-white">
                                    <tr>
                                        <th></th>
                                        <th>Project</th>
                                        <th>Client</th>
                                        <th>Assigned</th>
                                        <th>Projected Start</th>
                                        <th>Projected End</th>
                                        <th>Actual Start</th>
                                        <th>Status</th>
                                        <th>Actual End</th>
                                    </tr>
                                </thead>
                                <tbody>
                              
                            </tbody>
                            </table>
                            <div id="responseMessageDiv"></div>
              </div>
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/employee/project/modal/view_project_modal.php'); ?>
                
                <!-- mycode -->
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
 <?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/employee/inc/scripts.php') ?>
    <!-- Page Level Scripts -->
    <script type="text/javascript">    
  $(document).ready(function(){
     fetch_data();
     $('.nav a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active')
    $('.nav a').click(function(){
      $(this).parent().addClass('active').siblings().removeClass('active')  
    })
    
  $(".loader").fadeOut("slow");
  function fetch_data()
  {
   var dataTable = $('#pendingTasksTable').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
     "ordering": false,
    "columnDefs": [
    { "orderable": false, "targets": 2 }
  ],
    "ajax" : {
     url:"../controller/project/all_processing_project_fetch.php",
     type:"POST"
    }
   });
  }

  // view modal project
   $(document).on('click', '.viewProject', function(){

//     var setLastSelected = function(element) {
//    $(element).data('lastSelected', $(element).find("option:selected"));
// };
// $("select").each(function () {
//    setLastSelected(this);
// });
        var project_id = $(this).attr("id");
        $('#projectDetailsModal').modal('show'); 
          $.ajax({
                     url:"../controller/project/project_info.php",
                     method:"POST",
                     data:{project_id:project_id},
                      // dataType:"json",  
                     success:function(data){
                    $('#modal_title').html('Project Details'); 
                    $('#projectDetailsDiv').html(data); 
                     $('#projectDetailsModal').modal('show');  
                     }
                })
      }); 
    $(document).on('click', '.endBtnProject', function(){
        var end_project_id = $(this).attr("id");
        if (confirm("want to end this project?")){
          $.ajax({
                     url:"../controller/project/process_project.php",
                     method:"POST",
                     data:{end_project_id:end_project_id},
                     success:function(data){
                       if($.trim(data) == "success") {
                        $("#responseMessageDiv").html('<span class="label label-success" id="responseMessage">Project End Successfully</span>');
                        $('#responseMessage').fadeIn().delay(10000).fadeOut();
                         $('#pendingTasksTable').DataTable().destroy();
                            fetch_data();
                      }else{
                         $("#responseMessage").html('<span class="label label-warning" id="responseMessage">Failed to End Project</span>');
                        $('#responseMessage').fadeIn().delay(10000).fadeOut();
                      }
                      
                     }
                })
        }
          
      });
    // start Button Project
      $(document).on('click', '.startBtnProject', function(){
        var start_project_id = $(this).attr("id");
         if (confirm("want to Start this Project?")){
          $.ajax({
                     url:"../controller/project/process_project.php",
                     method:"POST",
                     data:{start_project_id:start_project_id},
                     success:function(data){
                       if($.trim(data) == "success") {
                        $("#responseMessageDiv").html('<span class="label label-success" id="responseMessage">Project Started Successfully</span>');
                        $('#responseMessage').fadeIn().delay(10000).fadeOut();
                         $('#pendingTasksTable').DataTable().destroy();
                            fetch_data();
                      }else{
                         $("#responseMessage").html('<span class="label label-warning" id="responseMessage">Failed to Start</span>');
                        $('#responseMessage').fadeIn().delay(10000).fadeOut();
                      }
                      
                     }
                });
        }

      });
       // start  Button Task
       // status change
      $(document).on('change', '.selectProjectStatus', function(){
        var selectProjectStatus= $(this).find(':selected').val();
        var statusChangeProject_id= $(this).data('id');
        var current_project_status = $(this).data("current_project_status");
            if (confirm("want to Start this Project?")){
           if(statusChangeProject_id!='' && selectProjectStatus!='')
           {
      // return false;
         $.ajax({
                     url:"../controller/project/process_project.php",
                     method:"POST",
                     data:{statusChangeProject_id:statusChangeProject_id,selectProjectStatus:selectProjectStatus},
                      // dataType:"json",  
                     success:function(data){
                          if($.trim(data) == "success"){
                            $("#responseMessageDiv").html('<span class="label label-success" id="responseMessage">Project Status Changed Successfully</span>');
                        $('#responseMessage').fadeIn().delay(10000).fadeOut();
                         $('#pendingTasksTable').DataTable().destroy();
                            fetch_data();
                          }
                     }
                });
    }else{

       alert("Select a status from bellow ");
      $(this).val(current_project_status).attr("selected", "selected");

    }
  }else{
       $(this).val(current_project_status).attr("selected", "selected");
       console.log("back to previous");
  }
    // end of confirm
                });
      // end of status change


      });
  

      
    

</script>
 

</script>

</body>
</html>
