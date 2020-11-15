<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php
$pageSlug="designation";
?>
<?php include_once('inc/header.php') ?>
<?php 
$filepath = realpath(dirname(__FILE__));
$resultDep=$dep->all_department_details();
$result=$des->all_designation_details();
// For Select Company
$resultCompany=$comp->all_company_details(); ?>
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
      <div class="loader" ></div>
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
                <!-- My Code -->
          <div class="container">
              <div class="table-responsive" id="try">
                           <div align="center">
                          <button type="button" class="btn-success btn-sm mb-2" name="addDesignationBtn" id="addDesignationBtn" data-toggle="modal" data-target="#add_designation_data_Modal" class="btn btn-primary"><i class="fas fa-plus fa-lg"></i>Add Designation</button>  <br />
                     </div>
        <div id="companyTable">
                <table class="table responsive table-striped table-dark table table-borderless text-center myCustomTable" style="width:100%" id="designationTable" cellspacing="0">
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
        
         <!-- My Code -->
        
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->
<?php  
include_once ($filepath.'/inc/modal/modal_designation.php'); 
?>
    <!-- Scripts -->
<?php include_once('inc/scripts.php') ?>
    <!-- Page Level Scripts -->
    <script type="text/javascript">
  $(document).ready(function(){
    $('#designationTable').DataTable();
 $(".loader").fadeOut("slow");
      $('#addDesignationBtn').click(function(){
           $('#submitType').val("Insert");
          $('#actionValue').val("insert");
           $('#designationForm')[0].reset();
      });

      
      $('#designationForm').on("submit", function(event){
           event.preventDefault();
           // alert("okkk");
                 $(".loader").show();
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
                         $(".loader").hide();   
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

</body>
</html>
