 
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

 
 if(!empty($_POST) && empty($_POST['del_designation_id']) && empty($_POST['find_employee_id']) && empty($_POST['selectedCompanyID']) && empty($_POST['selectedDepartmentID']) )  
 
 {  
  
      
      $desName = $_POST["designationName"];  
      $dep_id = $_POST["selectDepartmentFromModal"];  
      $comp_id = $_POST["selectCompanyFromModal"];  
     

     
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

          $result=$des-> add_designation($desName,$dep_id);
           if(!$result){ 
            // echo 'Successfully Inserted';
            echo $result;
        
          }
          else{
          
              echo 'Failed to Insert';
          }
    }
  }

  if (!empty($_POST['del_designation_id']) ) {
      $del_designation_id = $_POST["del_designation_id"];  

     $result=$des-> delete_designation($del_designation_id);
     if ($result) {
       echo "Successfully Deleted";
     }
     else{
      echo $result;
     }
    
  } 
   if (!empty($_POST['find_employee_id']) ) {
      $find_employee_id = $_POST["find_employee_id"];  
     $result=$usr-> find_employee_info($find_employee_id);
   
     if ($result) {
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);
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
 