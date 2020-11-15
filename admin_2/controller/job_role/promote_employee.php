 
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

  if (!empty($_POST['selectedEmployeeID']) && !isset($_POST["actionValue"]) && !isset($_POST['actionValue'])) {
      $selectedEmployeeID = $_POST["selectedEmployeeID"];  
     $result=$usr->an_employees_assigned_jobs_details_based_on_designation($selectedEmployeeID);
   
     if ($result) {
      $users_data = array();
      // $row = mysqli_fetch_array($result);  
       while($row = mysqli_fetch_array($result))
         {
        
          if ($row['end_date']!='') {
             $output= '

                     <tr>  <td>' . $row["des_name"] . '</td>
                          <td>' . $row["dep_name"] . '</td> 
                          <td>' . $row["comp_name"] . '</td>  
                          <td>' . $row["salary"] . '</td>  
                          <td>' . $row["start_date"] . '</td>  
                          <td>' . $row["end_date"] . '</td>   
                           <td><a href="v_edit_jobRole.php?jobRoleID='.$row['jobRoleID'].'" type="button" name="View" id="' . $row["jobRoleID"] . '" class="btn btn-primary btn-xs editEmployeesData" role="button">Edit</a></form></td>  
                     </tr>  
                ';  
          }
           else{
          $output= '

                     <tr>  <td>' . $row["des_name"] . '</td>
                          <td>' . $row["dep_name"] . '</td> 
                          <td>' . $row["comp_name"] . '</td>  
                          <td>' . $row["salary"] . '</td>  
                          <td>' . $row["start_date"] . '</td>  
                          <td>' . $row["end_date"] . '</td>  
                           <td><a href="v_edit_jobRole.php?jobRoleID='.$row['jobRoleID'].'" type="button" name="View" id="' . $row["jobRoleID"] . '" class="btn btn-primary btn-xs editEmployeesData" role="button">Edit</a></form></td> 
                          <td> <input type="button" name="promote" value="Promote" id="' . $row["jobRoleID"] . '" class=" bg-gradient-primary text-gray-100 btn  btn-xs promoteJobRole" /></td>  
                         
                     </tr>  
                ';  
                 
               }

                 echo $output; 

         }
            exit();
      

     }
      else{
      echo '<span style="color:red;"">No JobRole for Promote</span>';
     
     }

   
    
  } 
  if (isset($_POST["actionValue"])) {
      $employee_id = $_POST["employee_id"];  
      $job_role_id = $_POST["job_role_id"];  
      $designation_id = $_POST["selectDesignationFromModal"];  
      $salary = $_POST["salary"];  
      $notes = $_POST["notes"];  
      $start_date = $_POST["date_pickerModal"];  
      $job_nature = $_POST["job_nature"];  
      // print_r($_POST);
      $result=$jobRole->promoteEmployee($employee_id,$job_role_id,$designation_id,$salary,$notes,$start_date,$job_nature);
      if ($result) {
        echo  $result;
      }
     

    
    
    
  }

 ?>
