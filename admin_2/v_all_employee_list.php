<?php include_once 'inc/header.php';  ?>
      <!-- End of Header -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
       if (isset($_POST['viewAllEmployee'])) {
        $resultEmployeeList=$usr->all_employee_details();   
       }
        
       
      ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

   <!-- Sidebar -->
    <?php include_once 'inc/partials/sidebar.php';  ?>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include_once 'inc/partials/nav-bar.php';  ?>
      <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h6 class="h4 mb-4 text-gray-800">All Employee List</h6>
        <div class="col-xs-1 text-center messageShowingDiv">
        <span class="disable"  style="display: none">Disabled Account!! Warning!!</span>
        <span class="empty" style="display: none ">**Field Must not be Empty**</span>
        <span class="success_response" id="success_response" style="display: none">Employee Added Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">***</span>
      </div>
     
          <!-- My Code -->
         
         <div class="container">
              <table class="table responsive table table-striped table-bordered " id="dataTable">
                <thead>
                  <th>photo</th>
                  <th>Name</th>
            
                  <th>Actions</th>
                  
                </thead>
                <tbody id="employeeListTableBody">
                <?php 
                while($row = mysqli_fetch_array($resultEmployeeList))
                               { ?>
                                <tr>
                                  <td>
          <a href="#" class="view_emp_modal" id="<?php echo $row['emp_id'] ?>"><img src="../photo/<?php echo $row['photo'] ?>" width="65" height="60" /></a>
        </td>
        <td class="text-info name_modal" style="min-width: 150px;">
          <a href="#" class="view_emp_modal"id="<?php echo $row['emp_id'] ?>"><?php echo  $row['first_name']." ".$row['last_name'] ?><a href="#">
          </td>
                          
                          <td>
                            
                            <input type="button" class="btn btn-danger btn-xs viewEmployeesData" 
                                id="<?php echo $row["emp_id"] ?>" value="View" >
                        <a href="v_edit_employee.php?emp_id=<?php echo $row['emp_id'];?>" type="button" name="View" id="<?php echo $row["emp_id"]; ?>" class="btn btn-primary btn-xs editEmployeesData" role="button">Edit</a>
                            
                            <?php  if  (Session::get("loggedRole")==3) { ?>
                               <input type="button" class="btn btn-danger btn-xs deleteEmployeesData" 
                                id="<?php echo $row["emp_id"] ?>" value="Delete" >
                              
                          <?php } ?>

                          </td>
                                
                                </tr>

                               <?php } ?>
                </tbody>
                
              </table>
              <form action="v_employee_list.php" method="post">

                
                 <input type="submit" name="hideAllEmployee" class="bg-gradient-success text-gray-100 hideAllEmployee" id="hideAllEmployee" value="Hide All Employee" >
              </form>
             
         </div>
         <!-- My Code -->
        

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
 <?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/partials/logoutModal.php');  
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/modal/modal_view_employee.php');  
 ?> 
<!-- Scripts -->
<?php 
include_once ($filepath.'/inc/partials/scripts.php'); 
 ?> 
<!-- Scripts -->
 <script type="text/javascript">
  
  $(document).ready(function(){
   
    
              

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
