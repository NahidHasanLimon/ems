<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="all-task"; ?>
<?php include_once('../inc/header.php'); ?>
<?php 
  $clients=$pro->all_client_details();
  $task_categories=$tsk->all_task_categories();
  $employees=$usr->current_jobs_endDateisNull_all_employee_details();
  $projects=$pro->all_project_details();

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
                  <!-- for filterChecking -->
          <form method="POST" name="filteringForm" id="filteringForm" autocomplete="off">
              <div class="form-inline">
                    <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Email Address</span>
                        <select class="form-control" name="filter_client" id="filter_client">
                                    <option value="" > Select a Client</option>
                                    <?php if($clients){
                           while($rowClient = mysqli_fetch_array($clients))
                           { ?> 
                          <option value="<?php echo $rowClient['id']; ?>"> <?php echo ucfirst($rowClient['name']); ?> </option> 
                                <?php } } ?>
                      </select>
                  </label>

                    <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Select a Person</span>
                        <select class="form-control" name="filter_person" id="filter_person">
                                    <option value="" > Select an Employee</option>
                                    <?php if($employees){
                           while($rowEmployees = mysqli_fetch_array($employees))
                           { ?> 
                          <option value="<?php echo $rowEmployees['emp_id']; ?>"> <?php echo ucfirst($rowEmployees['first_name'].' '.$rowEmployees['last_name']); ?> </option>                                 <?php } } ?>
                      </select>
                  </label>
                   <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Select a Category</span>
                        <select class="form-control" name="filter_categories" id="filter_categories">
                                    <option value="" class=""> Select a Category</option>
                                    <?php if($task_categories){
                           while($rowTCategories = mysqli_fetch_array($task_categories))
                           { ?> 
                          <option value="<?php echo $rowTCategories['id']; ?>"> <?php echo ucfirst($rowTCategories['name']); ?> </option> 
                                <?php } } ?>
                      </select>
                  </label> 
                  <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Select a project</span>
                        <select class="form-control" name="filter_projects" id="filter_projects">
                                    <option value="" class=""> Select a Project</option>
                                    <?php if($projects){
                           while($rowProjects = mysqli_fetch_array($projects))
                           { ?> 
                          <option value="<?php echo $rowProjects['id']; ?>"> <?php echo ucfirst($rowProjects['name']); ?> </option> 
                                <?php } } ?>
                      </select>
                  </label>
                   <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Status Approval</span>
                        <select class="form-control" name="filter_status" id="filter_status">
                                    <option value="" > Select a Status</option>
                                   <!--  <?php if($clients){
                           while($row = mysqli_fetch_array($clients))
                           { ?> 
                          <option value="<?php echo $row['id']; ?>"> <?php echo ucfirst($row['name']); ?> </option> 
                            <?php } } ?> -->
                            <option value="1">Approved</option>
                            <option value="0">UnApproved</option>
                      </select>
                  </label>

                      <input type="button" id="filterBtn" value="Filter" class="btn btn-sm btn-rounded btn-success mr-2  mb-3">
                      <input type="button" id="resetBtn" value="Reset" class="btn btn-sm btn-rounded btn-error mr-2  mb-3">
                                </div>
                            </form>

                  <!-- for filterChecking -->
                <table class="table responsive table-striped table-dark table table-borderless text-center" id="all_task_table">
                                <thead class="text-white">
                                    <tr>
                                    <th>SL#</th>
                                    <th>AS</th>
                                    <th>Name</th>
                                    <th>Client</th>
                                    <th>Assigned</th>
                                    <th>Category</th>
                                    <th>Project</th>
                                    <!-- <th>Created By</th> -->
                                    <th>Status</th>
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
     $(".loader").fadeOut("slow");

fetch_data();
// setInterval( function () {
//      $('#all_task_table').DataTable().destroy();
//         fetch_data();
// },100000 );

  function fetch_data(filterFormData = '')
  {
   var dataTable = $('#all_task_table').DataTable({
    "processing" : true,
    "serverSide" : true,
     "searching": false,
    "order" : [],
    "columnDefs": [
    { "orderable": false, "targets": [0,1,2,3,4,5,6,7] }
  ],
    "ajax" : {
     // url:"../controller/task/all_task_fetch.php",
     url:"../controller/task/queryBuilder.php",
     type:"POST",
     data:{
      filterFormData:filterFormData
       // data:$('#add_project_cat_form').serialize(),
     }
   
    }
   });
  }
   // alert(typeof(fetch_data));

  // fitering
   $("#fiter_client").change(function(){

   var fiter_client = $('#fiter_client').val();

   if(fiter_client != '')
   {
    $('#all_task_table').DataTable().destroy();
    fetch_data(fiter_client);
   }
   else
   {
    // alert('Select Both filter option');
    // $('#all_task_table').DataTable().destroy();
    // fetch_data();
   }
  });
  // end fitering
  // Filter Form Submit
   $('#filterBtn').on("click", function(event){
           event.preventDefault();
           // serializeArray
          // var filterFormData= $('#filteringForm').serialize();
          var filterFormData = $("#filteringForm :input")
    .filter(function(index, element) {
        return $(element).val() != '';
    })
    .serialize();
          // alert(typeof(filterFormData));
          console.log(filterFormData);
          // console.log(isEmptyArray(filterFormData));
           console.log(jQuery.isEmptyObject({filterFormData:"filter_client"}) );
    if(filterFormData == '')
   {
   alert('Select at least one field');
  }else{
    $('#all_task_table').DataTable().destroy();
      fetch_data(filterFormData);
  }


           
      });
 $('#resetBtn').on("click", function(event){
           $('#filteringForm')[0].reset();
      $('#all_task_table').DataTable().destroy();
      fetch_data();
           
      });

  // Filter Form Submit
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
                    $('#modal_title').html("Task Details"); 
                     $('#projectDetailsModal').modal('show');  
                     }
                })      
      }); 
       $(document).on('click', '.deleteTask', function(){
        var del_task_id = $(this).attr("id");
       swal({
            title: "Are you sure to delete ??",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
           if(del_task_id != '')
           {
                $.ajax({
                     url:"../controller/task/del_task.php",
                     method:"POST",
                     data:{del_task_id:del_task_id},
                     success:function(data){
                        if($.trim(data) == "success") {
                            swal({
                      title: "Success!",
                      text: 'Successfully Deleted',
                      icon: "success",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: true,
                      allowOutsideClick: true,
                      dangerMode: false,
                        }).then(function(){
                          $('#all_task_table').DataTable().destroy();
                           fetch_data();
                        });

                        }else{
                            swal({
                      title: "Error!",
                      text: data,
                      icon: "error",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClitrueck: true,
                      dangerMode: false,
                        });
                     }
                        }
                });
           }
          } 
        });      
            
      });

   });
    

</script>
 

</script>

</body>
</html>
