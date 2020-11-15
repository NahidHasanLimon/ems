<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="all-projects"; ?>
<?php include_once('../inc/header.php'); ?>
<?php 
  $clients=$cln->all_client_details();
  $project_categories=$pro->all_project_category_details();
  $employees=$usr->current_jobs_endDateisNull_all_employee_details();
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
                        <span class="label-text sr-only">Month</span>
                        <input type="text" class="form-control" name="filter_month_picker"id="filter_month_picker" placeholder="Select your month..." />
                       
                  </label>
                 <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Client</span>
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
                        <span class="label-text sr-only">Category</span>
                        <select class="form-control" name="filter_categories" id="filter_categories">
                                    <option value="" class=""> Select a Category</option>
                                    <?php if($project_categories){
                           while($rowTCategories = mysqli_fetch_array($project_categories))
                           { ?> 
                          <option value="<?php echo $rowTCategories['id']; ?>"> <?php echo ucfirst($rowTCategories['name']); ?> </option> 
                                <?php } } ?>
                      </select>
                  </label>
                   <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Select a Person</span>
                        <select class="form-control" name="filter_assigned_to" id="filter_assigned_to">
                                    <option value="" > Select an Employee</option>
                                    <?php if($employees){
                           while($rowEmployees = mysqli_fetch_array($employees))
                           { ?> 
                          <option value="<?php echo $rowEmployees['emp_id']; ?>"> <?php echo ucfirst($rowEmployees['first_name'].' '.$rowEmployees['last_name']); ?> </option>                                 <?php } } ?>
                      </select>
                  </label>
                   <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Approval Status</span>
                        <select class="form-control" name="filter_approval_status" id="filter_approval_status">
                                    <option value="" > Select Approval Status</option>
                            <option value="1">Approved</option>
                            <option value="0">UnApproved</option>
                      </select>
                  </label> 
                  <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Completion Status</span>
                        <select class="form-control" name="filter_completion_status" id="filter_completion_status">
                                    <option value="" > Select Completion Status</option>
                            <option value="1">Prospect</option>
                            <option value="2">Meeting Set</option>
                            <option value="3">RFQ</option>
                            <option value="4">Pitch Prepared</option>
                            <option value="5">Quotation Sent</option>
                            <option value="6">Work Order Received</option>
                            <option value="7">Ongoing</option>
                            <option value="8">Work Done</option>
                            <option value="9">Bill Sent</option>
                            <option value="10">Completed</option>
                      </select>
                  </label>

                      <input type="button" id="filterBtn" value="Filter" class="btn btn-sm btn-rounded btn-success mr-2  mb-3">
                      <input type="button" id="resetBtn" value="Reset" class="btn btn-sm btn-rounded btn-error mr-2  mb-3">
                                </div>
                            </form>

                  <!-- for filterChecking -->
                <table class="table responsive table-striped table-dark table table-borderless text-center" id="all_projects_table">
                                <thead class="text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Client</th>
                                        <th>Assigned to</th>
                                        <th>Category</th>
                                        <th>Expense</th>
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
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Page Level Scripts -->
    <script type="text/javascript">  
  $("#filter_month_picker").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        showCalendar: false,
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('yy-m', new Date(year, month, 1)));
        }
    });
  $(document).ready(function(){
     $(".loader").fadeOut("slow");

fetch_data();
// setInterval( function () {
//      $('#all_projects_table').DataTable().destroy();
//         fetch_data();
// },100000 );

   function fetch_data(filterFormData = '')
  {
   var dataTable = $('#all_projects_table').DataTable({
    "processing" : true,
    "serverSide" : true,
     "searching": false,
    "order" : [],
    "columnDefs": [
    { "orderable": false, "targets": [0,1,2] }
  ],
    "ajax" : {
     url:"../controller/project/all_project_fetch.php",
     type:"POST",
     data:{
      filterFormData:filterFormData
       // data:$('#add_project_cat_form').serialize(),
     }
   
    }
   });
  }
  // view modal project
  
    $(document).on('click', '.viewProject', function(){
        var project_id = $(this).attr("id");
        $('#projectDetailsModal').modal('show'); 
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
      // Deletev bbutoon press 
    $(document).on('click', '.deleteProject', function(){
        var del_project_id = $(this).attr("id");
        console.log(del_project_id);
          $.ajax({
                     url:"../controller/project/del_project.php",
                     method:"POST",
                     data:{del_project_id:del_project_id},
                     success:function(data){
                          if (data=='success') {
                            swal({
                      title: "Success!",
                      text: data,
                      icon: "success",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: false,
                        }).then(function(){
                          $('#all_projects_table').DataTable().destroy();
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
                      allowOutsideClick: false,
                      dangerMode: false,
                        });
                           
                     }
                  
                     }
                })
      

      });
    // end of delete button 

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
    $('#all_projects_table').DataTable().destroy();
      fetch_data(filterFormData);
  }


           
      });
 $('#resetBtn').on("click", function(event){
           $('#filteringForm')[0].reset();
      $('#all_projects_table').DataTable().destroy();
      fetch_data();
           
      });

  // Filter Form Submit
   });
    

</script>
 

</script>

</body>
</html>
