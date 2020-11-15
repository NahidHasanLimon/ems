 
<?php 

  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Department.php'); 
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Designation.php'); 
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Company.php'); 
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/JobRole.php'); 
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
 

 
   // include_once ($filepath.'/../../classes/Company.php');
  // $comp= new Company();
  $dep= new Department();
  $des= new Designation();
  $usr= new User();
  $jobRole= new JobRole();
  $comp= new Company();
  ?>
 <?php  

 
 
  if(!empty($_POST) &&  isset($_POST["actionValue"]) )  
 
 {  
  
      
     
      $employee_id = $_POST["selectEmployee"];  
      $department_id = $_POST["selectDepartment"];  
      $company_id = $_POST["selectCompany"]; 
      $designation_id = $_POST["selectDesignation"];  
      $start_date = $_POST["datepicker"];  
      $salary = $_POST["salary"];  
      $notes = $_POST["notes"];  
      $job_nature = $_POST["job_nature"];  



     

     
      if($_POST['actionValue']=="update")
      {

         $hidden_designation_id = $_POST['hidden_designation_id'];  
          
      $result=$des->update_designation($hidden_designation_id,$desName,$dep_id);
      
           if(!$result){ 
            echo $result;
        
          }
          else{
          
              echo 'Failed to update';
          }
    } else {

          $result=$jobRole-> add_employee_job_role($employee_id,$company_id,$department_id,$designation_id,$job_nature,$start_date,$salary,$notes);
           if($result){ 
            // echo 'Successfully Inserted';
            echo 'success';
            exit();
        
          }
          else{
          
              echo 'error';
              exit();
          }
    }
  }

  if (!empty($_POST['del_designation_id']) ) {
      $del_designation_id = $_POST["del_designation_id"];  

     $result=$des-> delete_designation($del_designation_id);
     if ($result) {
       echo "Successfully Deleted";
       exit();
     }
     else{
      echo $result;
      exit();
     }
    
  } 
   if (!empty($_POST['selectedEmployeeID']) && !isset($_POST["actionValue"])) {
      $selectedEmployeeID = $_POST["selectedEmployeeID"];  
     $result=$usr-> find_employee_info($selectedEmployeeID);
   
     if ($result) {
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);
      exit();
      // echo $row;

     }
     else{
     
     }
    
  }
  // For Add Departent
  if (!empty($_POST['SelectDepartmentModal']) ) {
      $SelectedDepartmentID = $_POST["SelectDepartmentModal"];  
     $result=$dep-> find_SelectedCompanies_department_details($SelectedDepartmentID);
     // var_dump($result);
     // print_r($result)
      $department_data=array();
    
     if ($result) {
       while($row = mysqli_fetch_array($result))
                               {
                                 $department_data[] = $row;
                                 
                               }
    
       echo json_encode($department_data);
     

     
     }
     else{
     echo json_encode($result);
     }
    
  }
  //  Find Department for Selected Company 


  if(isset($_POST["selectedCompanyID"]) && !empty($_POST["selectedCompanyID"])){
    $selectedCompanyID=$_POST['selectedCompanyID'];
    //Get all state data
    
     $result=$dep->find_SelectedCompanies_department_details($selectedCompanyID);
     // print_r($result);
     if ($result) {

        echo '<option value="">Select Department</option>';
        while($row =$result->fetch_assoc()){ 
            echo '<option value="'.$row['dep_id'].'">'.$row['dep_name'].'</option>';
        }
    }else{
        echo '<option value="">Department not available</option>';
    }


   }

   if(isset($_POST["selectedDepartmentID"]) && !empty($_POST["selectedDepartmentID"])){
    $selectedDepartmentID=$_POST['selectedDepartmentID'];
    //Get all state data
     $result=$des->find_SelectedDepartment_designation_details($selectedDepartmentID);
     // print_r($result);
     if ($result) {

        echo '<option value="">Select Department</option>';
        while($row =$result->fetch_assoc()){ 
            echo '<option value="'.$row['des_id'].'">'.$row['des_name'].'</option>';
        }
    }else{
        echo '<option value="">Designation not available</option>';
    }


   }
   
 ?>
 