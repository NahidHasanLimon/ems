<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkEmployeeSession();?>
<?php $pageSlug="all-task"; ?>
<?php include_once('../inc/header.php'); ?>
<?php 
  $clients=$pro->all_client_details();
  $task_categories=$tsk->all_task_categories();
  $employees=$usr->current_jobs_endDateisNull_all_employee_details();
  // $taskStatus=$usr->current_jobs_endDateisNull_all_employee_details();
  $projects=$pro->all_project_list();

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
                  <!-- for filterChecking -->
          <form method="POST" name="filteringForm" id="filteringForm" autocomplete="off">
              <div class="form-inline">
                    <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Filter by Client</span>
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
                        <span class="label-text sr-only">Filter by Cat.</span>
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
                        <span class="label-text sr-only">Filter by Status</span>
                        <select class="form-control" name="filter_status" id="filter_status">
                                    <option value="" > Select a Status</option>
                           <option value="1">Status 1</option>
                            <option value="2">Status 2</option>
                            <option value="3">Status 3</option>
                            <option value="4">Status 4</option>
                      </select>
                  </label> 
                    <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Filter by Cat.</span>
                        <select class="form-control" name="filter_project" id="filter_project">
                                    <option value="" class=""> Select a Project</option>
                                    <?php if($projects){
                           while($rowProjects = mysqli_fetch_array($projects))
                           { ?> 
                          <option value="<?php echo $rowProjects['id']; ?>"> <?php echo ucfirst($rowProjects['name']); ?> </option> 
                                <?php } } ?>
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
                                    <th>Name</th>
                                    <th>Client</th>
                                    <th>Category</th>
                                    <th>project</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                            </tbody>
                            
                            </table> 
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
     url:"../controller/task/all_task_fetch.php",
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
    // For Task History Toggling Button
    jQuery.fn.extend({
    toggleText: function (a, b){
        var that = this;
            if (that.text() != a && that.text() != b){
                that.text(a);
            }
            else
            if (that.text() == a){
                that.text(b);
            }
            else
            if (that.text() == b){
                that.text(a);
            }
        return this;
    }
});

       $(document).on("click","#taskHistoryBtn", function(){
        $("#taskHistoryDiv").toggle();
        // $(".taskHistoryDiv").css("display", "block");

         $("#taskHistoryBtn").toggleText('Hide Task History', 'Show Task History');
        // alert("ok");
      }); 
    // For Task History Toggling Button
   });
    

</script>
 

</script>

</body>
</html>
