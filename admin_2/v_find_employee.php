<?php include_once'inc/header.php';  ?>
      <!-- End of Header -->
      <?php 
       $filepath = realpath(dirname(__FILE__));
       $resultCompany=$comp->all_company_details();
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
        <?php 
        include_once 'inc/partials/nav-bar.php';
          ?>
      <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h6 class="h4 mb-4 text-gray-800">Find Employee</h6>

     
          <!-- My Code -->
         <div class="card-body">
          <form action="" class="inline" id="searchEmployeeForm" name="searchEmployeeForm" method="post" autocomplete="off"> 
          
           <div class="col-sm-12 form-inline">
            <label for="company" class="mr-sm-2"> Company</label>
            <select name="selectCompany" id="selectCompany"  class="form-control mr-2">
             <option value="">Select a Company</option>
             <?php 
             if($resultCompany){

                               while($rowCompany = mysqli_fetch_array($resultCompany))
                               {
              ?>
              <option value="<?php echo $rowCompany['comp_id']; ?>"> <?php echo $rowCompany['comp_name']; ?></option>
            <?php } }?>

           </select>
           <label for="department" class="mr-sm-1"> Department</label>

           <select name="selectDepartment" id="selectDepartment" class="form-control mr-2">
             <option value="">Select a Department</option>
           </select>
           <label for="designation" class="mr-1 sm-2"> Designation</label>

           <select name="selectDesignation" id="selectDesignation" class="form-control">
             <option value="">Select a Designation</option>
           </select>
             
           </div>
           <div class="col-sm-6 mt-1">
            <span class="text-danger"> OR </span>
           </div>
           <div class="col-sm-12 mt-3">
          <!--   <label for="searchByID"> Search by ID </label>
          <input type="number" placeholder="Enter an Employee ID" name="searchByID" id="searchByID" class="form-control" style="width: 50%"> 
            <span class="text-danger"> OR </span> <br> -->
             <label for="searchByMobileNo"> Search by Mobile No </label>
          <input type="number" placeholder="Type your mobile No" name="searchByMobileNo" id="searchByMobileNo" class="form-control" style="width: 50%"> 
            <span class="text-danger"> OR </span> <br>

            <label for="searchByName"> Search by Name </label>
            <input type="text" placeholder="Enter Employee Name" name="searchByName" id="searchByName" class="form-control" style="width: 50%">
           </div>
           <div class="col-xs-offset-3 col-xs-6 col-md-offset-4 col-md-4 mr-2 mt-3 ml-2 pull-right">
 <input class="form-control bg-gradient-primary text-gray-100"type="submit" value="search" name="search" id="search" style="width: 10rem;">
 </div>
           
        
       </form>
 </div>
         <!-- for Employee List -->
   <div class="card mb-4 mt-4 ml-4 ">
                <div class="card-header">
                 Employee List
                </div>
                <div class="card-body">
                 
                 
                  <div id="employeeListContainer" class="justify-content-center pull-right">  
               <div class="table-responsive text-right" id="listOfEmployee">
                <table class="table-responsive table table-bordered">
                  <thead> 
                <th>Employee </th> 
                <th>View</th> 
                <th>Edit</th> 
                </thead>
                <tbody class="table-body" id="displayEmployeeTableBody"> 
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
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/modal/modal_view_employee.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/modal/modal_edit_employee.php'); 
 ?> 
  <?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/partials/logoutModal.php'); 
 ?> 
<!-- Scripts -->
<?php 
include_once ($filepath.'/inc/partials/scripts.php'); 
 ?> 
<!-- Scripts -->
 <script type="text/javascript">      
   $(document).on('click', '#searchByMobileNo', function(){
   $('#searchByName').val("");
   $('#selectCompany').val("");
   $('#selectDepartment').val("");
   $('#selectDesignation').val("");
        });
    $(document).on('click', '#searchByName', function(){
   $('#searchByMobileNo').val("");
   $('#selectCompany').val("");
   $('#selectDepartment').val("");
   $('#selectDesignation').val("");
        }); 
    $(document).on('click', '#selectCompany', function(){
   $('#searchByMobileNo').val("");
     $('#searchByName').val("");
        });



$(document).ready(function(){
//   $('a[href="<?php echo basename($_SERVER['PHP_SELF']);?>"]').parents("ul.sub-menu").parent().addClass("active open");

// $('a[href="<?php echo basename($_SERVER['PHP_SELF']);?>"]').parent("li").addClass('active open');

  $("searchEmployeeForm").attr('autocomplete', 'off');


   $('#selectCompany').on('change',function(){
        var selectedCompanyID = $(this).val();
        // alert(selectedCompanyID);
        if(selectedCompanyID){
            $.ajax({
                type:'POST',
                 url:'controller/job_role/insert_edit_delete.php',
                data:'selectedCompanyID='+selectedCompanyID,
                success:function(html){
                    $('#selectDepartment').html(html);
                    $('#selectDesignation').html('<option value="">Select Department first</option>'); 
                }
            }); 
        }else{
            $('#selectDepartment').html('<option value="">Select  Company First</option>');
            $('#selectDesignation').html('<option value="">Select Department first</option>'); 
        }
    });
    
    $('#selectDepartment').on('change',function(){
        var selectedDepartmentID = $(this).val();
        if(selectedDepartmentID){
            $.ajax({
                type:'POST',
                url:'controller/job_role/insert_edit_delete.php',
                data:'selectedDepartmentID='+selectedDepartmentID,
                success:function(html){
                    $('#selectDesignation').html(html);
                }
            }); 
        }else{
            $('#selectDesignation').html('<option value="">Select Department first</option>'); 
        }
    });
  
  

  $("#searchEmployeeForm").on('submit',(function(e) {
  e.preventDefault();
   // $('#listOfEmployee').empty(); 
          if ( $("#selectCompany").val()!="" || $("#selectDepartment").val()!="" || $("#selectDesignation").val()!="" || $("#searchByName").val()!="" || $("#searchByID").val()!=""){

       
                 $.ajax({
          url: "controller/employee/find_employee.php", // Url to which the request is send
          type: "POST",  
                 // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,  
            // dataType: 'json',     // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,        // To send DOMDocument or non processed data file it is set to false
          success: function(data)   // A function to be called if request succeeds
          {
            // console.log(data);
            $('#displayEmployeeTableBody').html(data); 
 
          }
          });
                 // Ajax Request
               }
               else{
                  alert("Field Can not be Empty ");

               }       

     }));


        $(document).on('click', '.viewEmployeesData', function (e){
      
          e.preventDefault();
           $("#EmployeeJobDetails").empty();
           $("#jobDetailsTableBody").empty();
          $("#jobShowingTitle").html('<strong>Current Job </strong>');
           $(".SeeAllJobsBtn").show();

      var employee_id = $(this).attr("id");  
   
     
           if(employee_id)  
           {  
                $.ajax({  
                     url:"controller/employee/employee_info.php",  
                     method:"POST",  
                    dataType: 'json',
                     data:{employee_id:employee_id},  
                     success:function(data){  
                      if (data!='' || data !=undefined) {
                       $('.SeeAllJobsBtn').attr('id', data[0].emp_id);
                      $('#myModalTitle').html(data[0].first_name);
                      $('#modalHeading').html(data[0].first_name + data[0].last_name);
                      $('.profilePhoto_Class' ).attr("src","/ems/photo/"+data[0].photo);
                       console.log(data[0].first_name);
                       $('#email').html(data[0].email);
                       $('#nid').html(data[0].nid);
                       $('#dob').html(data[0].dob);
                       var dob = data[0].dob;
                       console.log(data[0].dob);
                       dob = new Date(dob);
                       var today = new Date();
                   var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                   if (age>0) {
                       $('#age').html(age+' years old');
                   }
                    else{
                         $('#age').html('0');

                    }

                       $('#address').html(data[0].address);
                       $('#mobileNo').html(data[0].mobileNo);
                       $('#created_at').html(data[0].created_at);
                       // $('#gender').html(data[0].gender+'1' ? 'Male' : 'Female');
                       // $('#status').html(data[0].status+'1' ? 'Active' : 'Inactive');
                         $("#noJobMessage").empty();
                       if (data[0].jobRoleID!=undefined) {
                         
                           $("#jobDetailsDiv").show();

                            $.each(data, function (i, selectedEmpDetail) {
                        $('#jobDetailsTableBody').append("<tr><td>" + selectedEmpDetail.des_name + "</td><td>" + selectedEmpDetail.dep_name + "</td><td>"+selectedEmpDetail.comp_name+"</td><td>"+selectedEmpDetail.start_date+"</td><td>"+selectedEmpDetail.end_date+"</td><td>"+
                          selectedEmpDetail.salary+"</td><td>"+selectedEmpDetail.notes+"</td</tr>");
                        // $("#EmployeeJobDetails").show();
                         $("#jobDetailsDiv").show();
                        $('#modal_view_employee').modal('show');
                    });
                       }
                       else{
                        
                       
                         $('#noJobMessage').append("<h2> No Current Job");
                         $("#jobDetailsDiv").hide();
                         // $("#EmployeeJobDetails").hide();
                         $("#noJobMessage").show();

                          $('#modal_view_employee').modal('show');

                       }
                    
                      }
                      else {
                        alert('No emloyee Available');
                      }
                                              
                     }  
                });  
           }      
}); 
               //View Employee From List  
               // all Jobs btn
               $(document).on('click', '.SeeAllJobsBtn', function (e){
                 $('#jobShowingTitle').html('<strong>All Jobs </strong');
               var allJobsEmployee_id = $(this).attr("id");  
                 $(this).hide();
                if(allJobsEmployee_id)  
           {  
                $.ajax({  
                     url:"controller/employee/employee_info.php",  
                     method:"POST",  
                    dataType: 'json',
                     data:{allJobsEmployee_id:allJobsEmployee_id},  
                     success:function(data){  
                      if (data!='' || data !=undefined) {
    
                       if (data[0].jobRoleID!=undefined) {
                       

                            $.each(data, function (i,allJobsDetails) {   
                        $('#jobDetailsTable >tbody:last').append("<tr><td>" + allJobsDetails.des_name + "</td><td>" + allJobsDetails.dep_name + "</td><td>"+allJobsDetails.comp_name+"</td><td>"+allJobsDetails.start_date+"</td><td>"+allJobsDetails.end_date+"</td><td>"+
                          allJobsDetails.salary+"</td><td>"+allJobsDetails.notes+"</td</tr>");
                        // $("#EmployeeJobDetails").show();
                         $("#jobDetailsDiv").show();
                        $('#modal_view_employee').modal('show');
                    });
                       }
                       else{
                        
                       
                         $('#noJobMessage').append("<h2> No Others Job Available");

                        $('#jobDetailsTable >tbody:last').append("<tr><td></td><td>No Others Job Available</td></tr>");

                      

                       }
                     

                      }
                      else {
                        $('#jobDetailsTable >tbody:last').append("<tr><td> No Others Job Available</td</tr>");
                      }
                                              
                     }  
                });  
           }      
               });

               // Edit Employee List



   
});
 
</script>
  

</body>

</html>
