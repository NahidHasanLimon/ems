<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkEmployeeSession();?>
<?php $pageSlug="up-coming-tasks"; ?>
<?php include_once('../inc/header.php'); ?>
<?php 
  $upcomingTask=$tsk->all_up_coming_task_for_logged_employee();
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
                   <?php if($upcomingTask){ ?>
                                <thead class="text-white">
                                    <tr>
                                        <th>Task</th>
                                        <th>Client</th>
                                        <th>Project</th>
                                        <th>Category</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Created by</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>                                
                                <tbody>
                      <?php while ($row=$upcomingTask->fetch_assoc()) { ?>
                                  
                          <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['client_name']; ?></td>
                            <td><?php echo $row['project_name']; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['start_date'] ? date('d M,Y ', strtotime($row['end_date'])) : '' ?></td>
                            <td><?php echo $row['end_date'] ? date('d M,Y ', strtotime($row['end_date'])) : '' ?></td>
                            <td><?php echo $row['created_by_name']; ?></td>
                            <td><button type="button" class="btn btn-rounded btn-info viewTask"  id="<?php echo $row['id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i>View</button> </td>
                          </tr>  
                            </tbody>
                            <?php } }  ?>
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
  $(".loader").fadeOut("slow");
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
                    $('#modal_title').html('Task Details'); 
                    $('#projectDetailsDiv').html(data); 
                     $('#projectDetailsModal').modal('show');  
                     }
                })
      });

</script>
 

</script>

</body>
</html>
