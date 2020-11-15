<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkEmployeeSession();?>
<?php $pageSlug="project-category"; ?>
<?php include_once('../inc/header.php'); ?>
<?php 
    $project_categories= $pro->all_project_category_details();
 ?>
 <!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- ==== Document Title ==== -->
    <title><?php echo $pageSlug; ?></title>
    
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
<?php include_once('../inc/stylesheets.php'); ?>
    
    <!-- Page Level Stylesheets -->

</head>
<body>
     <div class="loader" ></div>
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Navbar Start -->
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/nav.php') ?>
        <!-- Navbar End -->

        <!-- Sidebar Start -->
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/sidebar.php') ?>
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
               <a href="#add_project_category_modal" class="btn btn-rounded  btn-success" data-toggle="modal" id="modalOpenBtn">Add Project Category</a>
               <!-- fetch all project_categories -->
               <div class="table-responsive">
                            <table class="table responsive table-striped table-dark table table-borderless text-center" id="project_categories_table">
                                <thead class="text-white">
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                            </tbody>
                            </table> 
                        </div>
                   <!-- end fetch all project_categories -->
                 <!-- Modal Start -->
                        <div id="add_project_category_modal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Project Category</h5>

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body pt-4">
                                    <form action="" method="post" id="add_project_cat_form">           
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Name</span>
                                                <input type="project_cat_name" name="project_cat_name" id="project_cat_name" placeholder="Enter Category Name..." class="form-control" required=""/>
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Category Description</span>
                                                <input type="project_cat_description" name="project_cat_description" id="project_cat_description" 
                                    placeholder="Enter Your Category Description..." class="form-control" required=""/>
                                            </label>
                                        </div>
                                         <input type="hidden" name="hidden_project_cat_id" id="hidden_project_cat_id" >
                                         <input type="submit" id="project_cat_update_submit" name="project_cat_update_submit" value="update" class="btn btn-sm btn-rounded btn-success" style="display: none;" />

                                        <input type="submit" id="project_cat_submit" name="project_cat_submit" value="Add" class="btn btn-sm btn-rounded btn-success"/>
                                        <button type="button" class="btn btn-sm btn-rounded btn-danger" data-dismiss="modal">Cancel</button>
                                          </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal End -->
                        </div>
                <!-- mycode -->
            </section>
            <!-- Main Content End -->

        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
// <?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/scripts.php') ?>
    <!-- Page Level Scripts -->
    <script type="text/javascript">    
  $(document).ready(function(){
    fetch_data();

  function fetch_data()
  {
   var dataTable = $('#project_categories_table').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "columnDefs": [
    { "orderable": false, "targets": [2] }
  ],
    "ajax" : {
     url:"../controller/project_categories/all_project_categories_fetch.php",
     type:"POST"
    }
   });
  }
    $(".loader").fadeOut("slow");
    $('#modalOpenBtn').on("click", function(event){
           // event.preventDefault();  
            $('.modal-title').text("Add Project Category");   
            $('#project_cat_submit').show();
            $('#project_cat_update_submit').hide();
      });
 $('#project_cat_submit').on("click", function(event){
           event.preventDefault();
             $('#project_cat_update_submit').hide();
                $.ajax({
                     url:"../controller/project_categories/add_project_category.php",
                     method:"POST",
                     data:$('#add_project_cat_form').serialize(),
                     beforeSend:function(){
                          // $('#submitType').val("Inserting");
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
                          $('#add_project_category_modal').modal('hide'); 
                          $('#add_project_cat_form')[0].reset();
                          $('#project_categories_table').DataTable().destroy();
                             fetch_data();
                        }); 


                     }
                });
           
      });
 // add proejct Category
 $('#project_cat_update_submit').on("click", function(event){
           event.preventDefault();

                $.ajax({
                     url:"../controller/project_categories/edit_project_category.php",
                     method:"POST",
                     data:$('#add_project_cat_form').serialize(),
                     beforeSend:function(){
                          // $('#bazar_item_submit').val("insert");
                     },
                     success:function(data){
                       if($.trim(data) == "success") {
                        $('#add_project_category_modal').modal('hide'); 
                          swal({
                      title: "Success!",
                      text: "Updated Successfully",icon: "success",closeOnClickOutside: false,closeModal: true,
                      closeOnEsc: false,allowOutsideClick: false,dangerMode: false,
                        }).then(function(){
                            $('#add_project_category_modal').modal('hide'); 
                          $('#add_project_cat_form')[0].reset(); 
                          $('#project_categories_table').DataTable().destroy();
                             fetch_data();
                        }); 
                          }else{ 
                            swal({
                      title: "Error!",
                      text: data,icon: "error",closeOnClickOutside: false,closeModal: true,
                      closeOnEsc: false,allowOutsideClick: false,dangerMode: false,
                        });}

                     }
                });
           
      }); 
 // update project category submit

     $(document).on('click', '.deleteProjectCat', function(){
        var del_project_cat_id = $(this).attr("id");
       swal({
            title: "Are you sure to delete ??",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
           if(del_project_cat_id != '')
           {
                $.ajax({
                     url:"../controller/project_categories/del_project_category.php",
                     method:"POST",
                     data:{del_project_cat_id:del_project_cat_id},
                     success:function(data){
                        if($.trim(data) == "success") {
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
                        $('#project_categories_table').DataTable().destroy();
                             fetch_data();
                        });

                        }else{
                            swal({
                      title: "Error!",
                      text: data,
                      icon: "error",
                      closeOnClickOutside: false,
                      closeModal: true,
                      closeOnEsc: false,
                      allowOutsideClick: false,
                      dangerMode: false,
                        });
                           
                     }
                        }
                });
           }
          } 
        });
            
      });

        
         $(document).on('click', '.editProjectCat', function(){
          var update_project_cat_id = $(this).attr("id");
           var name=$(this).parents("tr").find("td:eq(0)").text();
          var description=$(this).parents("tr").find("td:eq(1)").text();

           $('#project_cat_description').val(description);
           $('#project_cat_name').val(name);
           $('#hidden_project_cat_id').val(update_project_cat_id);
          $('.modal-title').text("Update Project Category");
            $('#project_cat_submit').hide();
            $('#project_cat_update_submit').show();
            $('#add_project_category_modal').modal('show');  
         
      });

   });
    

</script>
 

</script>

</body>
</html>
