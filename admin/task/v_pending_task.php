<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="pending-tasks"; ?>
<?php include_once('../inc/header.php'); ?>
<?php 

 ?>
 <!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    
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
    <?php include_once('../inc/stylesheets.php'); ?>

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
                <div class="container">
                <table class="table responsive table-striped table-dark table table-borderless text-center" id="pendingTasksTable">
                                <thead class="text-white">
                                    <tr>
                                        <th>Task</th>
                                        <th>Assigned To</th>
                                        <th>Created By</th>
                                        <th>Approved By</th>
                                        <th>Approved at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                            </tbody>
                            </table>
              </div>

         <?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/project/modal/view_project_modal.php'); ?>
                
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
        $('#modal_title').html('Task Details'); 
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
    $(document).on('click', '.approveTask', function(){
        var approve_task_id = $(this).attr("id");
          $.ajax({
                     url:"../controller/task/approve_task.php",
                     method:"POST",
                     data:{approve_task_id:approve_task_id},
                      // dataType:"json",  
                     success:function(data){
                       if($.trim(data) == "success") {
                          swal({
        title: "Success!",text: 'Project Approved Successfully',icon: "success",closeOnClickOutside: false,
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
