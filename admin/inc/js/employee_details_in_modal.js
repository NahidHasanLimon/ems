
$(document).ready(function(){

 $(document).on('click', '.view_emp_modal, .display_emp_modal, .viewEmployeesData ', function (e){
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
                      $('#modalHeading').html(data[0].first_name+data[0].last_name);
                      $('.profilePhoto_Class' ).attr("src","/ems/photo/"+data[0].photo);
                       console.log(data[0].first_name);
                       $('#email').html(data[0].email);
                       $('#nid').html(data[0].nid);
                       $('#dob').html(data[0].dob);
                       $('#address').html(data[0].address);
                       $('#mobileNo').html(data[0].mobileNo);
                       $('#created_at').html(data[0].created_at);
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
                    
                       // $('#gender').html(data[0].gender+'1' ? 'Male' : 'Female');
                       // $('#status').html(data[0].status+'1' ? 'Active' : 'Inactive');
                         $("#noJobMessage").empty();
                       if (data[0].jobRoleID!=undefined) {
                         
                           $("#jobDetailsDiv").show();

                            $.each(data, function (i, selectedEmpDetail) {
                        $('#jobDetailsTableBody').append("<tr style= 'line-height:45px;'><td>" + selectedEmpDetail.des_name + "</td><td>" + selectedEmpDetail.dep_name + "</td><td>"+selectedEmpDetail.comp_name+"</td><td>"+humanizeDate(selectedEmpDetail.start_date)+"</td><td>"+humanizeDate(selectedEmpDetail.end_date)+"</td><td>"+
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

   
// });

// </script>

  //View Employee From List  
                 $(document).on('click', '#SeeAllJobsBtn', function (e){
          
             
                  $('#SeeAllJobsBtn').html('<strong>Hide Jobs </strong');

                 });
               // all Jobs btn
               $(document).on('click', '.SeeAllJobsBtn', function (e){
                e.preventDefault();
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
                        $('#jobDetailsTable >tbody:last').append("<tr class='table-danger'><td></td><td></td><td class='text-danger'>OLD JOBS</td></td><td></td><td></td><td></td><td></tr>");

                            $.each(data, function (i,allJobsDetails) {   
                        $('#jobDetailsTable >tbody:last').append("<tr><td>" + allJobsDetails.des_name + "</td><td>" + allJobsDetails.dep_name + "</td><td>"+allJobsDetails.comp_name+"</td><td>"+humanizeDate(allJobsDetails.start_date)+"</td><td>"+humanizeDate(allJobsDetails.end_date)+"</td><td>"+
                          allJobsDetails.salary+"</td><td>"+allJobsDetails.notes+"</td</tr>");
                        // $("#EmployeeJobDetails").show();
                         $("#jobDetailsDiv").show();
                        $('#modal_view_employee').modal('show');
                    });
                       }
                       else{
                        
                       
                         $('#noJobMessage').append("<h2> No Others Job Available");

                        $('#jobDetailsTable >tbody:last').append("<tr style='color:red'><td></td><td></td><td>No Others Job Available</td><td></td><td></td><td></td><td></td></tr>");

                      

                       }
                     

                      }
                      else {
                        $('#jobDetailsTable >tbody:last').append("<tr style='color:red'><td style='color:red'> No Others Job Available</td><td></td><td></td><td></td><td></td></tr>");
                      }
                                              
                     }  
                });  
           }      
               }); 
               //start  human readable date
      function humanizeDate(date_str) {
  month = ['January', 'Feburary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  
   if (date_str!=null) {
    date_arr = date_str.split('-');
  
  return month[Number(date_arr[1]) - 1] + " " + Number(date_arr[2]) + ", " + date_arr[0];

   }
   else{
    return null;
   }
  
}


 // end of human readable date
               }); 
