 
<?php 
// $filepath = realpath(dirname(__FILE__));
  // include_once ($filepath.'/../../classes/Department.php');
   // include_once ($filepath.'/../../classes/Company.php');
  // $comp= new Company();
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Department.php'); 

  $dep= new Department();
  ?>
 <?php  
 
 if(!empty($_POST) && empty($_POST['del_department_id']) && empty($_POST['find_department_id']) && empty($_POST['SelectedCompanyID']) && empty($_POST['CompanyIDFromModalSelect']) )  
 
 {  
  
      
      $depName = $_POST["departmentName"];  
      $comp_id = $_POST["selectCompanyFromModal"];  
      // $comp_id = $_POST["CompanyIDFromModalSelect"];  

     
      if($_POST['actionValue']=="update")
      {
         $HiddenDepID = $_POST['hidden_department_id'];  
      $result=$dep->update_department($HiddenDepID,$depName,$comp_id);
      
           if(!$result){ 
            echo $result;
        
          }
          else{
          
              echo 'Failed to update';
          }
    } else {

          $result=$dep-> add_department($depName,$comp_id);
           if(!$result){ 
            // echo 'Successfully Inserted';
            echo $result;
        
          }
          else{
          
              echo 'Failed to Insert';
          }
    }
  }
  if (!empty($_POST['del_department_id']) ) {
      $DepartmentDelID = $_POST["del_department_id"];  

     $result=$dep-> delete_department($DepartmentDelID);
     if ($result) {
       echo "Successfully Deleted";
     }
     else{
      echo $result;
     }
    
  } 
   if (!empty($_POST['find_department_id']) ) {
      $find_department_id = $_POST["find_department_id"];  
     $result=$dep-> find_department_details($find_department_id);
     // var_dump($result);
     // print_r($result);
     if ($result) {
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);

      // print_r($result[0]);
      // print_r(json_encode($result));
      //  echo $result;
      // echo json_encode($result);  
     }
     else{
     // echo json_encode($result);
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
     

      // print_r($result[0]);
      // print_r(json_encode($result));
      //  echo $result;
      // echo json_encode($result);  
     }
     else{
     echo json_encode($result);
     }
    
  }
  // For Add Departent


  if (!empty($_POST['SelectedCompanyID']) && isset($_POST['SelectedCompanyID']) ) {

      $selectedCompanyID = $_POST["SelectedCompanyID"];  
     $result=$dep-> find_SelectedCompanies_department_details($selectedCompanyID);
      $department_data=array();
    
     if ($result) {

       while($row = mysqli_fetch_array($result))
                               {
                                 $department_data[] = $row;

                                 echo json_encode($row);
                //                  $output= '

                //      <tr>  <td>' . $row["dep_id"] . '</td>
                //           <td>' . $row["dep_name"] . '</td> 
                //           <td>' . $row["comp_name"] . '</td> 
                         
                //           <td><input type="button" name="edit" value="Edit" id="'.$row["dep_id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                //           <td><input type="button" name="view" value="view" id="' . $row["dep_id"] . '" class="btn btn-info btn-xs view_data" /></td> 
                //           <td><input type="button" name="delete" value="delete" id="' . $row["dep_id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                //      </tr>  
                // ';  
     }
   }
     // echo $output;

     // else{
     // // echo json_encode($result);
     //  echo "Failed top search";
     // }
    
  }
   if (!empty($_POST['CompanyIDFromModalSelect']) && isset($_POST['CompanyIDFromModalSelect']) ) {
      $selectedCompanyID = $_POST["CompanyIDFromModalSelect"];  
     $result=$dep-> find_SelectedCompanies_department_details($selectedCompanyID);
    
    
     if ($result) {

       while($row = mysqli_fetch_array($result))
                               {
                                 $department_data[] = $row;

                                 // echo json_encode($row);
                                 $output= '

                     <tr>  
                          <td>' . $row["dep_name"] . '</td> 
                         
                          
                     </tr>  
                ';  
     }
   }
     echo $output;

     // else{
     // // echo json_encode($result);
     //  echo "Failed top search";
     // }
    
  }
   
   
 ?>
 