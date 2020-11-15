<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php
$pageSlug="company";
$filepath = realpath(dirname(__FILE__));
?>
<?php include_once('inc/header.php'); ?>
<?php $result=$comp->all_company_details();?>
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
                <!-- My Code -->
          <div class="container">
                           <div align="center">
                          <button type="button" class="btn-success btn-sm mb-2" name="addCompanyBtn" id="addCompanyBtn" data-toggle="modal" data-target="#add_company_data_Modal" class="btn btn-primary"><i class="fas fa-plus fa-lg"></i>Add Company</button>  <br />
                     </div>
        <div id="companyTableDiv">
                <table class="table responsive table-striped table-dark table table-borderless text-center myCustomTable" style="width:100%" id="companyTable" cellspacing="0">
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
                  <tbody id="userDataBody" class="align-middle">
                   <?php
                   $adv_payments_data=array();

                         if($result){

                               while($row = mysqli_fetch_array($result))
                               {
                                  $adv_payments_data[] = $row;


                               ?>
                               <tr>
                                    <td class="align-middle"><?php echo $row["comp_id"]; ?></td>
                                    <td class="align-middle"><?php echo $row["comp_name"]; ?></td>
                                    
                                      <td class="align-middle">
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
          
        
         <!-- My Code -->
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/modal/modal_company.php');   ?>
    <!-- Scripts -->
<?php include_once('inc/scripts.php') ?>
    <!-- Page Level Scripts -->
    <script type="text/javascript">
  $(document).ready(function(){
$('#companyTable').DataTable();
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

</body>
</html>
