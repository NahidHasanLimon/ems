<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="find-employee"; ?>
<?php include_once('inc/header.php'); ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    $resultCompany=$comp->all_company_details();
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
 <input class="btn btn-info bg-gradient-success text-gray-100"type="submit" value="search" name="search" id="search" style="width: 10rem;">
 </div>
           
        
       </form>
 </div>
         <!-- for Employee List -->
   <div class="card mb-4 mt-4 ml-4 bg-dark" >
                <div class="card-header">
                 <h4>Search Result</h4>
                </div>
                <div class="card-body">
        
                  <div id="employeeListContainer" class="justify-content-center pull-right">  
               <div class="table-responsive text-right" id="listOfEmployee">
                <table class="table responsive table-striped table-dark table table-borderless text-center myCustomTable">
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
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/modal/modal_view_employee.php');  ?>
    <!-- Scripts -->
<?php include_once('inc/scripts.php') ?>
<script src="inc/js/employee_details_in_modal.js"></script>
    <!-- Page Level Scripts -->
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
$(".loader").fadeOut("slow");

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
  $(".loader").show();
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
            $(".loader").hide();
            $('#displayEmployeeTableBody').html(data);
            $('#displayEmployeeTableBody').focus();
 
          }
          });
                 // Ajax Request
               }
               else{
                  alert("Field Can not be Empty ");

               }       

     }));


    
               // Edit Employee List



   
});
 
</script>
  
</body>
</html>
