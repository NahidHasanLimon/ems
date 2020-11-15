<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php
$pageSlug="department";
$filepath = realpath(dirname(__FILE__));
include_once('inc/header.php');
?>
<?php 
$resultCompany=$comp->all_company_details();
// For Select Company
if (empty($_POST['SelectCompany']) ) {
$result=$dep->all_department_details();
 }
  else{
    $SelectedCompanyID=$_POST['SelectCompany'];
    $result=$dep->find_SelectedCompanies_department_details($SelectedCompanyID);
  }
   ?>
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
          <div class="container" >
               <!-- for Select Company -->
             <div class="row">  
               <div class="col-sm-10">
    <form class="form-inline my-2 my-lg-0 mt-4" action="" method="post" autocomplete="off">
        <select class="form-control" name="SelectCompany" id="SelectCompany">
          <option value="">Select Company: </option>
          <?php 
           if($resultCompany){

                       while($rowCompany = mysqli_fetch_array($resultCompany))
                       {
           ?>
           <option value="<?php echo $rowCompany['comp_id']; ?>"> <?php echo $rowCompany['comp_name']; ?> </option>
         <?php } } ?>
        </select>
        <button value="Search" name="search" id="search" class="btn btn-rounded btn-info ml-2" type="submit" onClick="return document.getElementById('SelectCompany').value !='' "><i class="fas fa-search"></i></button>                
                </form>
              <!-- for Select Company -->     
     <span>Displayed Company: <?php
    if (!isset($SelectedCompanyID)) {
        echo "Select a Company";
    }else{
    $result2=$dep->find_SelectedCompanies_department_details($SelectedCompanyID);
    if ($result2) {
     $row2 = $result2->fetch_array(MYSQLI_ASSOC);
     echo $row2['comp_name'];
    }
    else {
      echo "No Department available";
    }
     
}?></span>
    </div>
           <div class="justify-content-end">
          <button type="button" class="btn-success btn-sm mb-2 allign-right" name="addDepartmentBtn" id="addDepartmentBtn" data-toggle="modal" data-target="#add_department_data_Modal" class="btn btn-primary"><i class="fas fa-plus fa-lg"></i>Add Department</button>  <br />
            </div>
       </div> 
       <!-- end of row  -->
        <table class="table responsive table-striped table-dark table table-borderless text-center myCustomTable" style="width:100%" id="departmentTable" cellspacing="0">
          <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Company</th>
                      <th>Actions </th>
                    </tr>
        </thead>
                  <tfoot>
                    <tr>
                     <th>ID</th>
                      <th>Name</th>
                      <th>Company</th>
                      <th>Actions </th>
                    </tr>
                  </tfoot>
                  <tbody id="userDataBody">
                   <?php
                   $adv_payments_data=array();
                         if($result){
                                $i=0;
                               while($row = mysqli_fetch_array($result))
                               { $i++; ?>
                               <tr id="DepDatatableBody">
                                    <th scope="row" class="align-middle" ><?php echo $i; ?></th scope="row" >
                                    <th scope="row" class="align-middle"><?php echo $row['dep_name']; ?></th>
                                    <th scope="row" class="align-middle"><?php echo $row['comp_name']; ?></th>
                                      <th  scope="row" class="align-middle">
                                      <button name="edit" value="Edit" id="<?php echo $row["dep_id"]; ?>" class="btn btn-rounded btn-info edit_data"><i class="far fa-edit"></i> </button> ||
                                   <button class="btn btn-rounded btn-danger delete_data" name="delete" value="" id="<?php echo $row["dep_id"]; ?>"><i class="fa fa-trash" aria-hidden="true" style="font-size:18px;"></i></button>
                                    </th>
                               </tr>
                               <?php } }else{
                                echo"No Data available";
                               }
                             ?>
                  </tbody>
                </table>
            </div>
        
         <!-- My Code -->
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/modal/modal_department.php');   ?>
    <!-- Scripts -->
<?php include_once('inc/scripts.php') ?>
    <!-- Page Level Scripts -->
<script type="text/javascript">
  $(document).ready(function(){
$('#departmentTable').DataTable();
 $(".loader").fadeOut("slow");
      $('#addDepartmentBtn').click(function(){
           $('#submitType').val("Insert");
           $('#departmentForm')[0].reset();
      });

      
      $('#departmentForm').on("submit", function(event){
           event.preventDefault();
           // alert("okkk");

          if($('#departmentName').val() == "")
           {
                alert("Department name is required");
           }
          else if($('#selectCompanyModal').val() == "")
           {
                alert("Company selection is required");
           }

           else
           {
                $.ajax({
                     url:"controller/department/insert_edit_delete.php",
                     method:"POST",
                     data:$('#departmentForm').serialize(),
                     beforeSend:function(){
                          $('#submitType').val("Inserting");
                     },
                     success:function(data){
                              swal({
                      title: "Success!",
                      text: data,
                      icon: "success",
                      closeOnClickOutside: true,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: true,
                      dangerMode: false,
                        }).then(function(){
                            $('#departmentForm')[0].reset();
                            $('#dataTable tbody').html(data);
                            location.reload();
                        });

                     }
                });
           }
      });

     $(document).on('click', '.delete_data', function(){
      if (confirm('Are you sure to Delete?')) {
           var del_department_id = $(this).attr("id");
          
           if(del_department_id != '')
           {
                $.ajax({
                     url:"controller/department/insert_edit_delete.php",
                     method:"POST",
                     data:{del_department_id:del_department_id},
                     success:function(data){
                           swal({
                      title: "Success!",
                      text: "Deleted Successfully",
                      icon: "success",
                      closeOnClickOutside: true,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: true,
                      dangerMode: false,
                        }).then(function(){
                            location.reload();
                        });

                     }
                });
           } }
      });

         $(document).on('click', '.edit_data', function(){

        var find_department_id = $(this).attr("id");
            $('#submitType').val("update"); 
            $('#action').val("update"); 
            // $('#add_company_data_Modal').show();
        
          $('.modal-title').text("Update Company");

           $.ajax({
                     url:"controller/department/insert_edit_delete.php",
                     method:"POST",
                     data:{find_department_id:find_department_id},
                      dataType:"json",  
                     success:function(data){
                     // alert(data.comp_name);
                     $('#hidden_department_id').val(data.dep_id);
                     $('#actionValue').val("update");
                       $('#selectCompanyFromModal option[value="' + data.comp_id + '"]').prop('selected', true);
                     $('#departmentName').val(data.dep_name);
                     $('#add_department_data_Modal').modal('show');  
                     }
                })
      
          
          
      });

         $('#SelectCompany').on('change',function(){
          // alert("Company Changed");

                var SelectedCompanyID = $(this).val();
                

                if(SelectedCompanyID!=''){
                  $.ajax({
                     url:"controller/department/insert_edit_delete.php",
                     method:"POST",
                       dataType:"json",
                    data:{SelectedCompanyID:SelectedCompanyID},
      
                     success:function(data){

    

                      
                      }
                      // end of ajax Success Function

                });

          

                }
               // End of Ajax
            });
         // Select Change From Modal 
         $('#selectCompanyFromModal').on('change',function(){
          // alert("Company Changed From Modal");

                var CompanyIDFromModalSelect = $(this).val();
                // var date=datepicker;
                // var user_id = $('#user_id').val();

                if(CompanyIDFromModalSelect!=''){
                  $.ajax({
                     url:"controller/department/insert_edit_delete.php",
                     method:"POST",
                       // dataType:"json",
                    data:{CompanyIDFromModalSelect:CompanyIDFromModalSelect},
      
                     success:function(data){
                     // alert(data[0].dep_id);
                      for (var i =data.length-1; i >= 0; i--) {
                        // alert(data[i].comp_id);
                       
                        // alert(data[i]["comp_id"]);
                        // alert("lion");
                        // alert(data.length);
                      }
                            
                     //        // (data.dep_id);
                     //        // alert(data.dep_name);
                     //        // alert(data.comp_name);
                     //        //    alert(data.length);


 
   $('#existingDepartent').html(data); 

                      
                      
                      }
                      // end of ajax Success Function

                });

          

                }
               // End of Ajax
            });

         // Select Change From Modal 





   });
    

</script>
</body>
</html>
