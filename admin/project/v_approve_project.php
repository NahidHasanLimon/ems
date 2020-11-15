<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="approve-projects"; ?>
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
                <table class="table responsive table-striped table-dark table table-borderless text-center" id="unApprovedProjectsTable">
                                <thead class="text-white">
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                            </tbody>
                            </table> 
                           
                           <button type="button" class="btn btn-rounded btn-primary float-right m-5" id="approve_all_projectsBtn"><i class="fa fa-paper-plane" aria-hidden="true"></i>Approve all</button> 
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
       $(".loader").fadeOut("slow");
    fetch_data();
// setInterval( function () {
//      $('#unApprovedProjectsTable').DataTable().destroy();
//         fetch_data();
// },100000 );

  function fetch_data()
  {
   var dataTable = $('#unApprovedProjectsTable').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "columnDefs": [
    { "orderable": false, "targets": 2 }
  ],
    "ajax" : {
     url:"../controller/project/unaprovedProjectsFetch.php",
     type:"POST"
    }
   });
  }
  // view modal project
  
    $(document).on('click', '.viewProject', function(){
        var project_id = $(this).attr("id");
        // $('#projectDetailsModal').modal('show'); 
          $.ajax({
                     url:"../controller/project/project_info.php",
                     method:"POST",
                     data:{project_id:project_id},
                      // dataType:"json",  
                     success:function(data){
                    $('#projectDetailsDiv').html(data); 
                     $('#projectDetailsModal').modal('show');  
                     }
                })
      

      });
    $(document).on('click', '.approveProject', function(){
        var approve_project_id = $(this).attr("id");
          $.ajax({
                     url:"../controller/project/approveProject.php",
                     method:"POST",
                     data:{approve_project_id:approve_project_id},
                      // dataType:"json",  
                     success:function(data){
                       if($.trim(data) == "success") {
                          swal({
        title: "Success!",text: 'Project Approved Successfully',icon: "success",closeOnClickOutside: false,
                      closeModal: true, closeOnEsc: false,allowOutsideClick: false,
                      dangerMode: false,
                        }).then(function(){
                          $('#unApprovedProjectsTable').DataTable().destroy();
                            fetch_data();
                        }); 
                      } 
                      
                     }
                })

      });
      $(document).on('click', '#approve_all_projectsBtn', function(){
        
        var approve_all_project_ids=[];
        $('.approveProject').each(function() {
          approve_all_project_ids.push(this.id);

        });
        console.log(approve_all_project_ids);
          $.ajax({
                     url:"../controller/project/approveProject.php",
                     method:"POST",
                     data:{approve_all_project_ids:approve_all_project_ids},
                      // dataType:"json",  
                     success:function(data){
                       if($.trim(data) == "success") {
                          swal({
        title: "Success!",text: 'All Project Approved Successfully',icon: "success",closeOnClickOutside: false,
                      closeModal: true, closeOnEsc: false,allowOutsideClick: false,
                      dangerMode: false,
                        }).then(function(){
                          $('#unApprovedProjectsTable').DataTable().destroy();
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
