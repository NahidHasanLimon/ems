<?php include_once'inc/header.php';
$filepath = realpath(dirname(__FILE__));?>
<?php
$resultDep=$dep->all_department_details();
$result=$des->all_designation_details();
// For Select Company
$resultCompany=$comp->all_company_details();
 ?>
       <!-- my PHP Code  -->

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
          <!-- <h6 class="h4 mb-4 text-gray-800 text-center">Company CRUD</h6> -->
      <div class="col-xs-1 text-center messageShowingDiv">
        <span class="disable"  style="display: none">Disabled Account!! Warning!!</span>
        <span class="empty" style="display: none ">**Field Must not be Empty**</span>
        <span class="success_response" id="success_response" style="display: none">Employee Added Successfully</span>
        <span class="error_response" id="error_response" style="display: none;">***</span>
      </div>
     
          <!-- My Code -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i>
              Designation...
            </div>
            <div class="card-body">
            
               <!-- for Select Company -->
             
              <!-- for Select Company -->
            
    <p> Displayed:<h4 class="text-left" id="cName"> </h4>    </p>
           
              <div class="table-responsive" id="try">
                           <div align="center">
                          <button type="button" class="btn-success btn-sm mb-2" name="addDesignationBtn" id="addDesignationBtn" data-toggle="modal" data-target="#add_designation_data_Modal" class="btn btn-primary"><i class="fas fa-plus fa-lg"></i>Add Designation</button>  <br />
                     </div>
        <div id="companyTable">
                <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTable" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL#</th>
                      <th>Designation</th>
                      <th>Department</th>
                      <th>Company</th>
                      <th>Actions </th>




                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                     <th>SL#</th>
                      <th>Designation</th>
                      <th>Department</th>
                      <th>Company</th>
                      <th>Actions </th>

                    </tr>
                  </tfoot>
                  <tbody id="userDataBody">
                   <?php

                         if($result){
                          $i=1;

                               while($row = mysqli_fetch_array($result))
                               {
                             
                               


                               ?>
                               <tr id="DepDatatableBody">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row["des_name"]; ?></td>
                                    <td><?php echo $row['dep_name']; ?></td>
                                    <td><?php echo $row['comp_name']; ?></td>
                                    
                                      <td>
                                      <button name="edit" value="Edit" id="<?php echo $row["des_id"]; ?>" class="btn btn-info btn-xs edit_data"><i class="far fa-edit"></i> </button> ||
                                   <button class="btn btn-danger btn-xs delete_data" name="delete" value="" id="<?php echo $row["des_id"]; ?>"><i class="fa fa-trash" aria-hidden="true" style="font-size:18px;"></i></button>
                                    </td>




                               </tr>
                               <?php  $i++;} }else{

                                echo"No Data available";
                               }
                             ?>




                  </tbody>
                </table>
              </div>
              </div>
            </div>

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
// include_once (  $baseUrl.'admin/inc/partials/logoutModal.php');
// include File In respective to Header File Location 
include_once ($filepath.'/inc/partials/logoutModal.php'); 
 ?> 
<!-- Scripts -->
<?php 
include_once ($filepath.'/inc/partials/scripts.php'); 
 ?> 
<!-- Scripts -->
<?php  
include_once ($filepath.'/inc/modal/modal_designation.php'); 
?>
<!-- Scripts for this page onlyt  -->

 <script type="text/javascript">
  $(document).ready(function(){

      $('#addDesignationBtn').click(function(){
           $('#submitType').val("Insert");
          $('#actionValue').val("insert");
           $('#designationForm')[0].reset();
      });

      
      $('#designationForm').on("submit", function(event){
           event.preventDefault();
           // alert("okkk");

          if($('#designationName').val() == "")
           {
                alert("Department name is required");
           }
          else if($('#selectCompanyFromModal').val() == "")
           {
                alert("Company selection is required");
           }  else if($('#selectDepartmentFromModal').val() == "")
           {
                alert("Department selection is required");
           }

           else
           {
                $.ajax({
                     url:"controller/designation/insert_edit_delete.php",
                     method:"POST",
                     data:$('#designationForm').serialize(),
                     beforeSend:function(){
                          $('#submitType').val("Inserting");
                     },
                     success:function(data){
                          // $('#designationForm')[0].reset();
                             alert("Successfully Done");
                             // alert(data);
                          // $('#dataTable tbody').html(data);
                          location.reload();

                     }
                });
           }
      });

     $(document).on('click', '.delete_data', function(){
      if (confirm('Are you sure to Delete?')) {
           var del_designation_id = $(this).attr("id");
          
           if(del_designation_id != '')
           {
                $.ajax({
                     url:"controller/designation/insert_edit_delete.php",
                     method:"POST",
                     data:{del_designation_id:del_designation_id},
                     success:function(data){
                           alert(data);
                          location.reload();
                     }
                });
           } }
      });

         $(document).on('click', '.edit_data', function(){

        var find_designation_id = $(this).attr("id");
            $('#submitType').val("update"); 
            $('#actionValue').val("update"); 
            $('#add_designation_data_Modal').show();
        
          $('.modal-title').text("Update Designation");

           $.ajax({
                     url:"controller/designation/insert_edit_delete.php",
                     method:"POST",
                     data:{find_designation_id:find_designation_id},
                      dataType:"json",  
                     success:function(data){
                     // alert(data.comp_name);
                     $('#hidden_designation_id').val(data.des_id);
                     $('#actionValue').val("update");
                     // $('#selectCompanyFromModal').val(data.comp);
                      $('#selectCompanyFromModal option[value="' + data.comp_id + '"]').prop('selected', true);
                       $('#selectDepartmentFromModal option[value="' + data.dep_id + '"]').prop('selected', true);
                     $('#designationName').val(data.des_name);
                     $('#add_designation_data_Modal').modal('show');  
                     }
                })
      
          
          
      });

         
       // Company and Department on Change Function

        $('#selectCompanyFromModal').on('change',function(){
        var companyIdFromModalSelect = $(this).val();
        if(companyIdFromModalSelect){
            $.ajax({
                type:'POST',
                url:'controller/designation/insert_edit_delete.php',
                data:'companyIdFromModalSelect='+companyIdFromModalSelect,
                success:function(html){
                     $('#selectDepartmentFromModal').html(html);
                }
            }); 
        }else{
            $('#selectDepartmentFromModal').html('<option value="">Select Company first</option>');
            // $('#designation').html('<option value="">Select Subject first</option>'); 
        }
    });





   });
    

</script>
  
<!-- Scripts for this page onlyt  -->

</body>

</html>
