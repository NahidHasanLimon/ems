 
<?php

   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Department.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Designation.php');
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/JobRole.php');  
  $usr= new User();
  $dep= new Department();
  $des= new Designation();
  $jobRole= new JobRole();
  ?>

 <?php  

  if (!empty($_POST['selectedEmployeeID']) && !isset($_POST["actionValue"])) {
      $selectedEmployeeID = $_POST["selectedEmployeeID"];  
     $result=$usr->an_employees_assigned_jobs_details_based_on_designation_endDate_isNull($selectedEmployeeID);
   
     if ($result) {
       $output = '';  
       $output .='<table class="table responsive table-striped table-dark table table-borderless text-center myCustomTable" id="assignedJobTable"> 
          <thead>
            <th>Designation</th>
            <th>Department</th>
            <th>Company</th>
            <th>Salary</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Action</th>
          </thead> 
          <tbody id="assignedJobTableBody">';
  
      // $row = mysqli_fetch_array($result);  
       while($row = mysqli_fetch_array($result))
         {
           // $users_data[] = $row;
          $output .= '

                     <tr>  <td>' . $row["des_name"] . '</td>
                          <td>' . $row["dep_name"] . '</td> 
                          <td>' . $row["comp_name"] . '</td>  
                          <td>' . $row["salary"] . '</td>  
                          <td>' . $row["start_date"] . '</td>  
                          <td>' . $row["end_date"] . '</td>  
                          <td><input type="button" name="endrole" value="EndRole" id="' . $row["jobRoleID"] . '" class="btn btn-danger btn-xs endJobRole" /></td>  
                     </tr>  
                '; 
         }
          $output.='</tbody>
        </table>';
        echo $output;

     }

     else{
      echo '<span style="color:red;"">No JobRole for End</span>';
     
     
     }
    
  } 

  if (isset($_POST["endJobRoleID"])) {
      $endJobRoleID = $_POST["endJobRoleID"];  
     $result=$jobRole->end_job_role($endJobRoleID);
   
     if ($result) {
      // $row = mysqli_fetch_array($result);  
      // echo json_encode($row);
      // // echo $row;
      echo $result;

     }
     else{
      echo "Failed";
     
     }
    
    
  }

 ?>
