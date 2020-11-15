<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkEmployeeSession();?>
<?php $pageSlug="add-project"; ?>
<?php include_once('../inc/header.php'); ?>
<?php 
$clients=$pro->all_client_details();
$project_categories=$pro->all_project_category_details();
$employees=$usr->current_jobs_endDateisNull_all_employee_details();
$completion_status=$pro->project_completion_status();

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
<!-- start of form div -->
                <div class="container">

                  <form class="text-white" name="add_project_form" id="add_project_form" method="POST" autocomplete="off">

                                <!-- Form Group Start -->
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right text-white">Project Name</span>
                                    <div class="col-md-6">
                                      <div class="form-inline">
                                        <input type="text" name="p_name" id="p_name" class="form-control form-control-rounded" >
                                        <input type="datepicker" name="p_concate_month_picker" id="p_concate_month_picker" class="form-control form-control-rounded ml-1 customPicker" placeholder="Concate Month">
                                        </div>

                                    </div>
                                </div>
                                <!-- Form Group End -->

                                <hr>
                                <!-- Form Group Start -->
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right text-white">Description</span>
                                    <div class="col-md-6">
                                        <textarea name="p_description" id="p_description" class="form-control" placeholder="Text input area"></textarea>
                                    </div>
                                </div>
                                <!-- Form Group End -->
                                 <!-- Form Group Start -->
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right text-white">Project Category</span>
                                    <div class="col-md-6">
                                         <select class="form-control" name="p_category" id="p_category">
                                          <option value="" > Select a Category</option>
                                          <?php if($project_categories){
                                 while($rowProjectCat = mysqli_fetch_array($project_categories))
                                 { ?> 
                  <option value="<?php echo $rowProjectCat['id']; ?>"> <?php echo ucfirst($rowProjectCat['name']); ?> </option> 
                        <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Form Group End -->    
                              <!-- Form Group Start -->
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right text-white">Assigned to </span>
                                    <div class="col-md-6">
                                         <select class="form-control" name="p_assigned_to" id="p_assigned_to" required="">
                          <option value="" > Select an Employee</option>
                          <?php if($employees){
                 while($rowEmp = mysqli_fetch_array($employees))
                        { ?> 
                <option value="<?php echo $rowEmp['emp_id']; ?>"> <?php echo ucfirst($rowEmp['first_name'].' '.$rowEmp['last_name']); ?> </option> 
                <?php } } ?>
                   </select>
                                    </div>
                                </div>
                                <!-- Form Group End -->
                                <!-- Form Group Start -->
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right text-white">Completion Status</span>
                                    <div class="col-md-6">
                                      <select class="form-control" name="p_completion_status" id="p_completion_status" required="">
                          <option value=""> Select a Completion Status</option>
                          <?php if($completion_status){
                 while($rowCS = mysqli_fetch_array($completion_status))
                        { ?> 
                <option value="<?php echo $rowCS['id']; ?>"> <?php echo ucfirst($rowCS['status']); ?> </option> 
                <?php } } ?>
                   </select>
                                    </div>
                                </div>
                                <!-- Form Group End --> 
                                 <!-- Form Group Start -->
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right text-white">Projected Start Date</span>

                                    <div class="col-md-6">
                                        <input class="form-control datepicker" name="p_start_date" data-date-format="yyyy-mm-dd" id="p_start_date">
                                    </div>
                                </div>
                                <!-- Form Group End -->
                                  <!-- Form Group Start -->
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right text-white">Projected End Date</span>

                                    <div class="col-md-6">
                                        <input class="form-control datepicker" data-date-format="yyyy-mm-dd" name="p_end_date" id="p_end_date" autocomplete="off">
                                    </div>
                                </div>
                                <!-- Form Group End -->   
                                 <!-- Form Group Start -->
                                 <div class="form-group pt-1 pb-1">
                                            <label class="form-check">
                                                <input type="checkbox" name="tagClientorNot" value="1" class="form-check-input form-control" id="tagClientorNot">
                                                <span class="form-check-label text-md-right">Tag a Client?</span>
                                            </label>
                                        </div>
                                <!-- Form Group End --> 
                                <!-- Form Group Start -->
                                <div class="form-group row" id="clientDiv" style="display: none;">
                                    <span class="label-text col-md-2 col-form-label text-md-right text-white">Select a  Client</span>

                                    <div class="col-md-6">
                                        <select class="form-control" name="p_selectClient" id="p_selectClient">
                                          <option value="" > Select a Client</option>
                                          <?php if($clients){
                                 while($row = mysqli_fetch_array($clients))
                                 { ?> 
                  <option value="<?php echo $row['id']; ?>"> <?php echo ucfirst($row['name']); ?> </option> 
                        <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Form Group End -->
                               <!-- Form Group Start -->
                                <div class="form-group row">
                                    <span class="label-text col-md-2 col-form-label text-md-right text-white">Expense</span>

                                    <div class="col-md-6">
                                        <input type="number" name="p_budget" id="p_budget" class="form-control form-control-rounded" autocomplete="off">
                                    </div>
                                </div>
                                <!-- Form Group End -->

                                   <!-- Form Group Start -->
                                <div class="form-group row">
                                    <div class="col-md-8">
                                    <input type="submit" name="project_submit" id="project_submit" value="Submit" class="btn btn-lg btn-rounded btn-success float-right  mb-3">
                                    </div>
                                </div>
                                <!-- Form Group End -->  

                                <hr>
                            </form>
                    </div>
                    <!-- end of form div -->
               </div>
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/employee/inc/scripts.php') ?>
    <!-- Page Level Scripts -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

    //for gijo picker $('#datepicker').datepicker({ format: 'yyyy-mm-dd' });
    $("#p_start_date,#p_end_date").each(function(){
        $(this).datepicker({
               dateFormat: 'yy-mm-dd'
            });
        });
   $('#p_concate_month_picker').datepicker({
       dateFormat: 'yy MM',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('M y', new Date(year, month, 1)));
        }
   });

  $(document).ready(function(){

    $(".loader").fadeOut("slow");

    $("#tagClientorNot").change(function(){
       $("#clientDiv").toggle();
  }) 
  
 $('#add_project_form').on("submit", function(event){
           event.preventDefault();
                $.ajax({
                     url:"../controller/project/add_project.php",
                     method:"POST",
                     data:$('#add_project_form').serialize(),
                     beforeSend:function(){
                          // $('#submitType').val("Inserting");
                     },
                     success:function(data){
                     if($.trim(data) == "success") {
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
                          $('#add_project_form')[0].reset();
                          // location.reload();
                        }); 
                      } 
                      else if($.trim(data) == "error") {
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
           else{
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
                });
           
      });

    

            });
</script>
 

</script>

</body>
</html>
