// view modal project
   $(document).on('click', '.viewProject', function(){
        var project_id = $(this).attr("id");
        $('#projectDetailsModal').modal('show'); 
          $.ajax({
                     url:"../controller/project/project_info.php",
                     method:"POST",
                     data:{project_id:project_id},
                      // dataType:"json",  
                     success:function(data){
                    $('#modal_title').html('Project Details'); 
                    $('#projectDetailsDiv').html(data); 
                     $('#projectDetailsModal').modal('show');  
                     }
                });
      }); 
    $(document).on('click', '.endBtnProject', function(){
        var end_project_id = $(this).attr("id");
        if (confirm("want to end this project?")){
          $.ajax({
                     url:"../controller/project/process_project.php",
                     method:"POST",
                     data:{end_project_id:end_project_id},
                     success:function(data){
                       if($.trim(data) == "success") {
                        $("#responseMessageDiv").html('<span class="label label-success" id="responseMessage">Project End Successfully</span>');
                        $('#responseMessage').fadeIn().delay(10000).fadeOut();
                         $('#all_projects_table').DataTable().destroy();
                            fetch_data();
                      }else{
                         $("#responseMessage").html('<span class="label label-warning" id="responseMessage">Failed to End Project</span>');
                        $('#responseMessage').fadeIn().delay(10000).fadeOut();
                      }
                      
                     }
                })
        }
          
      });
      // end of view project modal
    // Start project History
    $(document).on('click', '#projectHistoryBtn', function(){
   $(this).text(function(i, text){
          return text === "Hide Project Status History" ? "Show Project Status History" : "Hide Project Status History";
      });
  $('#projectHistoryDiv').toggle();
  // alert("ok");

});
    // End of Project History