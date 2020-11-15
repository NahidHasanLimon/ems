<?php include_once'inc/header.php';?>
<?php $filepath = realpath(dirname(__FILE__));?>
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
            
               <!-- for Select Company -->
              <form class="form-inline my-2 my-lg-0 mt-4" action="" method="post" autocomplete="off">
                  
                   <!--  <input type="text" class="form-control mr-sm-2" name="date_picker"id="date_picker" placeholder="Select your month..." style="width:60%;">
                  
                        <input value="Search" name="search" id="search" class="btn btn-info btn-sm" type="submit" onClick="return document.getElementById('date_picker').value !='' "></button> -->
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
                <button value="Search" name="search" id="search" class="form-control btn btn-info btn-xs ml-2" type="submit" onClick="return document.getElementById('SelectCompany').value !='' " style="width: 5%;"><i class="fas fa-search"></i></button>
                    </span>
                
                </form>
              <!-- for Select Company -->
            
    <p> Displayed Company: <?php
    $result2=$dep->find_SelectedCompanies_department_details($SelectedCompanyID);
    if ($result2) {
     $row2 = $result2->fetch_array(MYSQLI_ASSOC);
     echo $row2['comp_name'];
    }
    else {
      echo "No Department available";

    }
     

     ?> <h4 class="text-left" id="cName"> </h4>    </p>
           
              <div class="table-responsive " id="try">
                           <div align="center">
                          <button type="button" class="btn-success btn-sm mb-2" name="addDepartmentBtn" id="addDepartmentBtn" data-toggle="modal" data-target="#add_department_data_Modal" class="btn btn-primary"><i class="fas fa-plus fa-lg"></i>Add Department</button>  <br />
                     </div>
        <div id="companyTable">
                <table class="table responsive table-striped table-dark table table-borderless text-center" style="width:100%" id="dataTable" cellspacing="0">
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

                               while($row = mysqli_fetch_array($result))
                               {
                               ?>
                               <tr id="DepDatatableBody" class="align-middle">
                                    <td ><?php echo $row["dep_id"]; ?></td>
                                    <td><?php echo $row['dep_name']; ?></td>
                                    <td><?php echo $row['comp_name']; ?></td>
                                    
                                      <td>
                                      <button name="edit" value="Edit" id="<?php echo $row["dep_id"]; ?>" class="btn btn-info btn-xs edit_data"><i class="far fa-edit"></i> </button> ||
                                   <button class="btn btn-danger btn-xs delete_data" name="delete" value="" id="<?php echo $row["dep_id"]; ?>"><i class="fa fa-trash" aria-hidden="true" style="font-size:18px;"></i></button>
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
include_once ($filepath.'/inc/modal/modal_department.php'); 
?>
<!-- Scripts for this page onlyt  -->

 <script type="text/javascript">
  $(document).ready(function(){

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

     

 


                   

                      // Datatble Populating
                        console.log("populating data table...");
    // // clear the table before populating it with more data
    //             // $("#dataTable").DataTable().clear();
    //             $('#dataTable').dataTable().fnClearTable();
             
    //             var length = Object.keys(data).length;
    //             alert(length);
    //             for(var i = 1; i < length+1; i++) {
    //               var depDetails = data[i];
    //               alert(data[0]['comp_id']);

    //               // You could also use an ajax property on the data table initialization
    //               $('#dataTable').dataTable().fnAddData( [
    //               //   depDetails:'1'
    //               //   depDetails.dep_name,
    //               //   depDetails.comp_name
    //               "limon",
    //               "tamim",
    //               "mishu",
    //           {
    //                 "render": function (data, type, row) {
    //                 return '<a class="btn btn-danger" data-id="' + row[1] + '">' +
    //                     '<span class="glyphicon glyphicon-trash"> </span>' +
    //                     '</a>'
    //                 +
    //                     '<a class="btn btn-primary" data-id="' + row[1] + '">' +
    //                     '<span class="glyphicon glyphicon-pencil"> </span>' +
    //                     '</a>'
    //             } }
        
                  
    //               ]);
    //             }
    //                   // Datatble Populating

                      
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
  
<!-- Scripts for this page onlyt  -->

</body>

</html>
