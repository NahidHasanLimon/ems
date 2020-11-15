<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php $pageSlug="clients"; ?>
<?php include_once('../inc/header.php'); ?>

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
               <a href="#add_client_modal" id="modalOpenBtn" class="btn btn-rounded  btn-success" data-toggle="modal">ADD Client</a>
               <!-- fetch all client -->
               <div class="table-responsive">
                            <table class="table responsive table-striped table-dark table table-borderless text-center" id="client_table">
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
                   <!-- end fetch all client -->
                 <!-- Modal Start -->
                        <div id="add_client_modal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Client</h5>

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body pt-4">
                                    <form action="" method="post" id="add_client_form">           
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Name</span>
                                                <input type="client_name" name="client_name" id="client_name" placeholder="Enter Client Name..." class="form-control" required=""/>
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Client Description</span>
                                                <input type="client_description" name="client_description" id="client_description" 
                                    placeholder="Enter Your Client Description..." class="form-control" required=""/>
                                            </label>
                                        </div>
                                        <input type="hidden" name="hidden_update_client_id" id="hidden_update_client_id" >
                                        <input type="submit" id="client_submit" name="client_submit" value="Add" class="btn btn-sm btn-rounded btn-success"/> 
                                        <input type="submit" id="client_update_submit" name="client_update_submit" value="update" class="btn btn-sm btn-rounded btn-success" style="display: none;" />
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
    // $('#client_table').DataTable();
  fetch_data();


  function fetch_data()
  {
   var dataTable = $('#client_table').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"../controller/client/all_client_fetch.php",
     type:"POST"
    }
   });
  }
    $(".loader").fadeOut("slow");
 $('#client_update_submit').on("click", function(event){
           event.preventDefault();

                $.ajax({
                     url:"../controller/client/update_client.php",
                     method:"POST",
                     data:$('#add_client_form').serialize(),
                     beforeSend:function(){
                          // $('#client_submit').val("insert");
                     },
                     success:function(data){
                       if($.trim(data) == "success") {
                        $('#add_client_modal').modal('hide'); 
                          swal({
                      title: "Success!",
                      text: data,icon: "success",closeOnClickOutside: false,closeModal: true,
                      closeOnEsc: false,allowOutsideClick: false,dangerMode: false,
                        }).then(function(){
                          $('#add_client_form')[0].reset(); 
                          $('#client_table').DataTable().destroy();
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
           $('.modal-title').text("Add Client");    
            $('#client_submit').show();
            $('#client_update_submit').hide();
      });
 // for add

  $('#client_submit').on("click", function(event){
           event.preventDefault();
           $('#client_update_submit').hide();
                $.ajax({
                     url:"../controller/client/add_client.php",
                     method:"POST",
                     data:$('#add_client_form').serialize(),
                     beforeSend:function(){
                          // $('#client_submit').val("insert");
                     },
                     success:function(data){
                       if($.trim(data) == "success") {
                        $('#add_client_modal').modal('hide'); 
                         swal({
                      title: "Success!",
                      text: data,icon: "success",closeOnClickOutside: false,closeModal: true,
                      closeOnEsc: false,allowOutsideClick: false,dangerMode: false,
                        }).then(function(){
                          $('#add_client_form')[0].reset();
                          $('#client_table').DataTable().destroy();
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

     $(document).on('click', '.deleteClient', function(){
        var del_client_id = $(this).attr("id");
       swal({
            title: "Are you sure to delete ??",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
           if(del_client_id != '')
           {
                $.ajax({
                     url:"../controller/client/del_client.php",
                     method:"POST",
                     data:{del_client_id:del_client_id},
                     success:function(data){
                       $('#client_table').DataTable().destroy();
                          fetch_data();
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
                          // location.reload();
                          $('#client_table').DataTable().destroy();
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

         $(document).on('click', '.editClient', function(){
          var update_client_id = $(this).attr("id");
           var name=$(this).parents("tr").find("td:eq(0)").text();
          var description=$(this).parents("tr").find("td:eq(1)").text();
           $('#client_description').val(description);
           $('#client_name').val(name);
           $('#hidden_update_client_id').val(update_client_id);
          $('.modal-title').text("Update Client");
            $('#client_submit').hide();
            $('#client_update_submit').show();
            $('#add_client_modal').modal('show');  
         
    
          
          
      });

   });
    

</script>
 

</script>

</body>
</html>
