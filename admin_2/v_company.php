<?php include_once'inc/header.php';  ?>
<?php $filepath = realpath(dirname(__FILE__)) ?>
<?php $result=$comp->all_company_details();?>
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
              Company...
            </div>
            <div class="card-body">

            <div class="table-responsive" id="try">
                           <div align="center">
                          <button type="button" class="btn-success btn-sm mb-2" name="addCompanyBtn" id="addCompanyBtn" data-toggle="modal" data-target="#add_company_data_Modal" class="btn btn-primary"><i class="fas fa-plus fa-lg"></i>Add Company</button>  <br />
                     </div>
        <div id="companyTable">
                <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTable" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Actions </th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                     <th>ID</th>
                      <th>Name</th>
                      <th>Actions </th>



                    </tr>
                  </tfoot>
                  <tbody id="userDataBody">
                   <?php
                   $adv_payments_data=array();

                         if($result){

                               while($row = mysqli_fetch_array($result))
                               {
                                  $adv_payments_data[] = $row;


                               ?>
                               <tr id="mealDatatable">
                                    <td><?php echo $row["comp_id"]; ?></td>
                                    <td><?php echo $row["comp_name"]; ?></td>
                                    
                                      <td>
                                      <button name="edit" value="Edit" id="<?php echo $row["comp_id"]; ?>" class="btn btn-info btn-xs edit_data"><i class="far fa-edit"></i> </button> ||
                                   <button class="btn btn-danger btn-xs delete_data" name="delete" value="" id="<?php echo $row["comp_id"]; ?>"><i class="fa fa-trash" aria-hidden="true" style="font-size:18px;"></i></button>
                                    </td>




                               </tr>
                               <?php } }else{

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
include_once ($filepath.'/inc/modal/modal_company.php'); 
?>
<!-- Scripts for this page onlyt  -->

 <script type="text/javascript">
  $(document).ready(function(){

      $('#addCompanyBtn').click(function(){
           $('#submitType').val("Insert");
           $('#companyForm')[0].reset();
      });

      
      $('#companyForm').on("submit", function(event){
           event.preventDefault();
           // alert("okkk");

          if($('#companyName').val() == "")
           {
                alert("company Name is required");
           }

           else
           {
                $.ajax({
                     url:"controller/company/insert_edit_delete.php",
                     method:"POST",
                     data:$('#companyForm').serialize(),
                     beforeSend:function(){
                          $('#submitType').val("Inserting");
                     },
                     success:function(data){
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
                          $('#companyForm')[0].reset();
                          $('#dataTable tbody').html(data);
                          location.reload();
                        }); 


                     }
                });
           }
      });

     $(document).on('click', '.delete_data', function(){
      if (confirm('Are you sure to Delete?')) {
           var del_company_id = $(this).attr("id");
          
           if(del_company_id != '')
           {
                $.ajax({
                     url:"controller/company/insert_edit_delete.php",
                     method:"POST",
                     data:{del_company_id:del_company_id},
                     success:function(data){
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
                          location.reload();
                        }); 
                     }
                });
           } }
      });

         $(document).on('click', '.edit_data', function(){

        var find_company_id = $(this).attr("id");
            $('#submitType').val("update"); 
            $('#action').val("update"); 
            // $('#add_company_data_Modal').show();
        
          $('.modal-title').text("Update Company");

           $.ajax({
                     url:"controller/company/insert_edit_delete.php",
                     method:"POST",
                     data:{find_company_id:find_company_id},
                      dataType:"json",  
                     success:function(data){
                     // alert(data.comp_name);
                     $('#hidden_company_id').val(data.comp_id);
                     $('#actionValue').val("update");
                     $('#companyName').val(data.comp_name);
                     $('#add_company_data_Modal').modal('show');  
                     }
                })
      
          
          
      });

   });
    

</script>
  
<!-- Scripts for this page onlyt  -->

</body>


</html>
