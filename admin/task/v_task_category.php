<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="add-task-category"; ?>
<?php include_once('../inc/header.php'); ?>
<?php 
    $task_categories= $tsk->all_task_categories();
 ?>
 <!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    
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
    <?php include_once('../inc/stylesheets.php'); ?>

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
               <a href="#add_task_category_modal" id="modalOpenBtn" class="btn btn-rounded  btn-success" data-toggle="modal">ADD Task Category</a>
               <!-- fetch all task_categories -->
               <div class="table-responsive">
                            <table class="table responsive table-striped table-dark table table-borderless text-center" id="task_categories_table">
                                <thead class="text-white">
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                
                            </tbody>
                            </table> 
                        </div>
                   <!-- end fetch all task_categories -->
                 <!-- Modal Start -->
                        <div id="add_task_category_modal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Task Category</h5>

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body pt-4">
                                    <form action="" method="post" id="add_task_cat_form">           
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Name</span>
                                                <input type="task_cat_name" name="task_cat_name" id="task_cat_name" placeholder="Enter Category Name..." class="form-control" required=""/>
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Category Description</span>
                                                <input type="task_cat_description" name="task_cat_description" id="task_cat_description" 
                                    placeholder="Enter Your Category Description..." class="form-control" required=""/>
                                            </label>
                                        </div>
                                        <input type="hidden" name="hidden_update_task_cat_id" id="hidden_update_task_cat_id" >
                                        <input type="submit" id="task_cat_submit" name="task_cat_submit" value="Add" class="btn btn-sm btn-rounded btn-success"/> 
                                        <input type="submit" id="task_cat_update_submit" name="task_cat_update_submit" value="update" class="btn btn-sm btn-rounded btn-success" style="display: none;" />
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
    // $('#task_categories_table').DataTable();
  fetch_data();


  function fetch_data()
  {
   var dataTable = $('#task_categories_table').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"../controller/task_categories/all_task_cat_fetch.php",
     type:"POST"
    }
   });
  }
    $(".loader").fadeOut("slow");
 $('#task_cat_update_submit').on("click", function(event){
           event.preventDefault();

                $.ajax({
                     url:"../controller/task_categories/update_task_cat.php",
                     method:"POST",
                     data:$('#add_task_cat_form').serialize(),
                     beforeSend:function(){
                          // $('#task_cat_submit').val("insert");
                     },
                     success:function(data){
                       if($.trim(data) == "success") {
                        $('#add_task_category_modal').modal('hide'); 
                          swal({
                      title: "Success!",
                      text: data,icon: "success",closeOnClickOutside: false,closeModal: true,
                      closeOnEsc: false,allowOutsideClick: false,dangerMode: false,
                        }).then(function(){
                          $('#add_task_cat_form')[0].reset(); 
                          $('#task_categories_table').DataTable().destroy();
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
 $('#modalOpenBtn').on("click", function(event){
           // event.preventDefault();     
            $('#task_cat_submit').show();
            $('#task_cat_update_submit').hide();
      });
  $('#task_cat_submit').on("click", function(event){
           event.preventDefault();
           $('#task_cat_update_submit').hide();
                $.ajax({
                     url:"../controller/task_categories/add_task_category.php",
                     method:"POST",
                     data:$('#add_task_cat_form').serialize(),
                     beforeSend:function(){
                          // $('#task_cat_submit').val("insert");
                     },
                     success:function(data){
                       if($.trim(data) == "success") {
                         swal({
                      title: "Success!",
                      text: data,icon: "success",closeOnClickOutside: false,closeModal: true,
                      closeOnEsc: false,allowOutsideClick: false,dangerMode: false,
                        }).then(function(){
                          $('#add_task_cat_form')[0].reset();
                          $('#task_categories_table').DataTable().destroy();
                             fetch_data();
                        }); 
                      }else{

                        swal({
                      title: "Error!",
                      text: data,icon: "error",closeOnClickOutside: false,closeModal: true,
                      closeOnEsc: false,allowOutsideClick: false,dangerMode: false,
                        });

                     }
                      }
                });
           
      });

     $(document).on('click', '.deleteTaskCat', function(){
        var del_task_cat_id = $(this).attr("id");
       swal({
            title: "Are you sure to delete ??",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
           if(del_task_cat_id != '')
           {
                $.ajax({
                     url:"../controller/task_categories/del_task_cat.php",
                     method:"POST",
                     data:{del_task_cat_id:del_task_cat_id},
                     success:function(data){
                       $('#task_categories_table').DataTable().destroy();
                          fetch_data();
                        if (data=='success') {
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
                          // location.reload();
                          $('#task_categories_table').DataTable().destroy();
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
                        }).then(function(){
                          // location.reload();
                        });
                           
                     }
                        }
                });
           }
          } 
        });
           
          
            
      });

         $(document).on('click', '.editTaskCat', function(){
          var update_task_id = $(this).attr("id");
           var name=$(this).parents("tr").find("td:eq(0)").text();
          var description=$(this).parents("tr").find("td:eq(1)").text();
           $('#task_cat_description').val(description);
           $('#task_cat_name').val(name);
           $('#hidden_update_task_cat_id').val(update_task_id);
          $('.modal-title').text("Update Task Category");
            $('#task_cat_submit').hide();
            $('#task_cat_update_submit').show();
            $('#add_task_category_modal').modal('show');  
         
    
          
          
      });

   });
    

</script>
 

</script>

</body>
</html>
