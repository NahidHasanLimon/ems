 
<?php 
$filepath = realpath(dirname(__FILE__));
//   include_once ($filepath.'/../../classes/Company.php');
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Company.php');
  $comp= new Company();
  ?>
 <?php  
 // $connect = mysqli_connect("localhost", "root", "", "examination_system");  
 if(!empty($_POST) && empty($_POST['del_company_id']) && empty($_POST['find_company_id']))  
 
 {  
      
      // $companyID = $_POST["companyID"];  
      $companyName = $_POST["companyName"];  

     
      if($_POST['actionValue']=="update")
      {
         $HiddencompID = $_POST['hidden_company_id'];  
      $result=$comp->update_company($HiddencompID,$companyName);
      
           if(!$result){ 
            echo $result;
        
          }
          else{
          
              echo 'Failed to update';
          }
    } else {

          $result=$comp-> add_company($companyName);
           if(!$result){ 
            // echo 'Successfully Inserted';
            echo $result;
        
          }
          else{
          
              echo 'Failed to Insert';
          }
    }
  }
  if (!empty($_POST['del_company_id']) ) {
      $companyDelID = $_POST["del_company_id"];  
     $result=$comp-> delete_company($companyDelID);
     if ($result) {
       echo "Successfully Deleted";
     }
     else{
      echo $result;
     }
    
  } 
   if (!empty($_POST['find_company_id']) ) {
      $find_company_id = $_POST["find_company_id"];  
     $result=$comp-> find_company_details($find_company_id);
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
   
 ?>
 