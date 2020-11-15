<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkEmployeeSession();?>
<?php $pageSlug="pending-tasks"; ?>
<?php include_once('../inc/header.php'); ?>
<?php 

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
                                        <th>Task</th>
                                        <th>Created By</th>
                                        <th>E.Satrt</th>
                                        <th>E.End</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                            </tbody>
                            </table>
                            <div id="responseMessageDiv"></div>
                            
                    <!-- <button type="button" class="btn btn-rounded btn-primary float-right m-5" id="approve_allTasksBtn"><i class="fa fa-paper-plane" aria-hidden="true"></i>Start all</button> -->
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
     url:"../controller/task/pending_tasks_fetch.php",
     type:"POST"
    }
   });
  }

  // view modal project
   $(document).on('click', '.viewTask', function(){
        var task_id = $(this).attr("id");
        $('#projectDetailsModal').modal('show'); 
          $.ajax({
                     url:"../controller/task/task_info.php",
                     method:"POST",
                     data:{task_id:task_id},
                      // dataType:"json",  
                     success:function(data){
                    $('#projectDetailsDiv').html(data); 
                     $('#projectDetailsModal').modal('show');  
                     }
                })
      }); 
    $(document).on('click', '.startBtnTask', function(){
        var start_task_id = $(this).attr("id");
         if (confirm("Do you want Start task?")){
          $.ajax({
                     url:"../controller/task/process_task.php",
                     method:"POST",
                     data:{start_task_id:start_task_id},
                     success:function(data){
                       if($.trim(data) == "success") {
                        $("#responseMessageDiv").html('<span class="label label-success" id="responseMessage">Task StartedSuccessfully</span>');
                        $('#responseMessage').fadeIn().delay(10000).fadeOut();
                         $('#pendingTasksTable').DataTable().destroy();
                            fetch_data();
        //                   swal({
        // title: "Success!",text: 'Task Started',icon: "success",closeOnClickOutside: false,
        //               closeModal: true, closeOnEsc: false,allowOutsideClick: false,
        //               dangerMode: false,
        //                 }).then(function(){
                         
        //                 }); 
                      }else{
                         $("#responseMessage").html('<span class="label label-warning" id="responseMessage">Failed to Start</span>');
                        $('#responseMessage').fadeIn().delay(10000).fadeOut();
                      }
                      
                     }
                });
        }

      });
      $(document).on('click', '#approve_allTasksBtn', function(){
        var approve_all_task_ids=[];
        $('.approveTask').each(function() {
          approve_all_task_ids.push(this.id);
        });
       
        console.log(approve_all_task_ids);
          $.ajax({
                     url:"../controller/task/approve_task.php",
                     method:"POST",
                     data:{approve_all_task_ids:approve_all_task_ids},
                      // dataType:"json",  
                     success:function(data){
                       if($.trim(data) == "success") {
                          swal({
        title: "Success!",text: 'All Task  Approved Successfully',icon: "success",closeOnClickOutside: false,
                      closeModal: true, closeOnEsc: false,allowOutsideClick: false,
                      dangerMode: false,
                        }).then(function(){
                          $('#pendingTasksTable').DataTable().destroy();
                            fetch_data();
                        }); 
                      } 
                      
                     }
                })

      });
   });
    

</script>
 

</script>

</body>
</html>
