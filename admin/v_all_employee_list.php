<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php
$pageSlug="employee-list";
include_once 'inc/header.php';
$filepath = realpath(dirname(__FILE__));
if (isset($_POST['viewAllEmployee'])) {
$resultEmployeeList=$usr->all_employee_details();   
}
?>
<?php include_once('inc/header.php');?>
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
</head>
<body>
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
              <table class="table responsive table-striped table-dark table table-borderless text-center"id="dataTable">
                <thead>
                  <th>Photo</th>
                  <th>Name</th>
            
                  <th>Actions</th>
                  
                </thead>
                <tbody id="employeeListTableBody">
                <?php 
                while($row = mysqli_fetch_array($resultEmployeeList))
                               { ?>
                                <tr>
                                 <td>
          <a href="#" class="view_emp_modal" id="<?php echo $row['emp_id'] ?>"><img class="rounded mx-auto d-block" src="../photo/<?php echo $row['photo'] ?>" width="50" height="50" /></a>
        </td>
        <th scope="row" class="text-info align-middle name_modal" style="min-width: 150px; ">
          <a href="#" class="view_emp_modal"id="<?php echo $row['emp_id'] ?>"><?php echo  $row['first_name']." ".$row['last_name'] ?><a href="#">
          </th>
                          
                          <th scope="row" class="align-middle">
                            
                            <button type="button" class="btn btn-rounded btn-info viewEmployeesData" 
                                id="<?php echo $row["emp_id"] ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>

                        <a href="v_edit_employee.php?emp_id=<?php echo $row['emp_id'];?>" type="button" name="View" id="<?php echo $row["emp_id"]; ?>" class="btn btn-rounded btn-primary editEmployeesData rounded" role="button"><i class="far fa-edit"></i></a>
                            
                            <?php  if  (Session::get("loggedRole")==3) { ?>
                               <button type="button" class="btn btn-rounded btn-danger deleteEmployeesData" 
                                id="<?php echo $row["emp_id"] ?>" value="Delete"><i class="fa fa-trash" aria-hidden="true" style="font-size:18px;"></i></button>
                              
                          <?php } ?>

                          </th> 
                                </tr>

                               <?php } ?>
                </tbody>
                
              </table>
              <form action="v_employee_list.php" method="post">

                
                 <input type="submit" name="hideAllEmployee" class="btn btn-info bg-gradient-success text-gray-100 seeAllEmployee" id="hideAllEmployee" value="Hide All Employee" >
              </form>
             
         </div>
                <!-- mycode -->
                
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/modal/modal_view_employee.php');   ?>
    <!-- Scripts -->
<?php include_once('inc/scripts.php') ?>
    <!-- Page Level Scripts -->
     <script type="text/javascript">
  
  $(document).ready(function(){
   $('#dataTable').DataTable();    
      $(document).on('click', '.deleteEmployeesData', function(){
      if (confirm('Are you sure to Delete?')) {
           var del_employee_id = $(this).attr("id");
          
           if(del_employee_id != '')
           {
                $.ajax({
                     url:"controller/employee/deleteEmployee.php",
                     method:"POST",
                     data:{del_employee_id:del_employee_id},
                     success:function(data){
                           alert(data);
                          location.reload();
                     }
                });
           } }
      });

             

               });


</script>
  <script src="inc/js/employee_details_in_modal.js"></script>
</body>
</html>
