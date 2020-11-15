 
<?php 

  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Department.php'); 
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Designation.php'); 
 

 
   // include_once ($filepath.'/../../classes/Company.php');
  // $comp= new Company();
  $dep= new Department();
  $des= new Designation();
  ?>
 <?php  
 
 if(!empty($_POST) && empty($_POST['del_designation_id']) && empty($_POST['find_designation_id']) && empty($_POST['SelectedCompanyID']) && empty($_POST['companyIdFromModalSelect']) )  
 
 {  
  // print_r($_POST);
  
      
      $desName = $_POST["designationName"];  
      $dep_id = $_POST["selectDepartmentFromModal"];  
      $comp_id = $_POST["selectCompanyFromModal"];  
     

     
      if($_POST['actionValue']=="update")
      {

         $hidden_designation_id = $_POST['hidden_designation_id'];  
          
      $result=$des->update_designation($hidden_designation_id,$desName,$dep_id);
      
           if($result){ 
            echo $result;
              exit();
        
          }
          else{
          
              echo 'Failed to update';
              exit();
          }
    } else {

          $result=$des-> add_designation($desName,$dep_id);
           if(!$result){ 
            // echo 'Successfully Inserted';
            echo $result;
        
          }
          else{
          
              echo 'Failed to Insert';
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
   if (!empty($_POST['find_designation_id']) ) {
      $find_designation_id = $_POST["find_designation_id"];  
     $result=$des-> find_designation_details($find_designation_id);
   
     if ($result) {
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);
        exit();

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
         exit();
     

     
     }
     else{
     echo json_encode($result);
       exit();
     }
    
  }
  //  Find Department for Selected Company 


  if(isset($_POST["companyIdFromModalSelect"]) && !empty($_POST["companyIdFromModalSelect"])){
    $SelectedCompanyID=$_POST['companyIdFromModalSelect'];
    //Get all state data
     $result=$dep->find_SelectedCompanies_department_details($SelectedCompanyID);
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
   
 ?>
 