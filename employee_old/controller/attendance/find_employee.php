 
<?php

   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Department.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Designation.php'); 
  $usr= new User();
  $dep= new Department();
  $des= new Designation();
  ?>

 <?php  

 if(!empty($_POST["selectCompany"]) && !empty($_POST["selectDepartment"]) && !empty($_POST["selectDesignation"]) )
{
  echo "You Selected Company,Department,Designation";
}

 else if( !empty($_POST["selectCompany"]) && !empty($_POST["selectDepartment"])  )
{
  echo "You Selected Company,Department";
}
 else if(!empty($_POST["selectCompany"])  )  
{
  echo "selected only Company";
} 

else if(isset($_POST["searchByID"]) && empty($_POST["searchByName"]))  
{

  $searchByID=$_POST["searchByID"];

  if ( $searchByID!="" ) {
    $find_employee_by_id=$usr-> find_employee_info($searchByID);
    if ($find_employee_by_id) {
    $eData=array();
    while($row =$find_employee_by_id->fetch_assoc()){ 
       // echo '<option value="'.$row['emp_id'].'">'.$row['first_name'].' '.$row['last_name'].'</option>';
    
   
       // echo '<button class="list-group-item  d-flex justify-content-between align-items-center viewEmployeeData" id="'.$row['emp_id'].'"> '.$row['first_name'].' '.$row['last_name'].'</button>';
       $eData[] = $row;
     

    }
      echo json_encode($eData);

    }
    else{
      echo "No Employee Available";
    }

  }

  

  
}

else if(isset($_POST["searchByName"]) && empty($_POST["searchByID"]) )  
{
  $searchByName=$_POST["searchByName"];

  if ( $searchByName!="" ) {
    $find_employee_by_name=$usr-> search_employee_by_name($searchByName);
    if ($find_employee_by_name) {
      $eData=array();

    while($row =$find_employee_by_name->fetch_assoc()){ 

       // echo '<button class="list-group-item  d-flex justify-content-between align-items-center viewEmployeeData "id="'.$row['emp_id'].'"
       //  > '.$row['first_name'].' '.$row['last_name'].'</button>';

     // $eData= $row;
     $eData[] = $row;
      // print_r($eData);
    
    }
    // var_dump($eData);
    echo json_encode($eData);
     // echo $eData;
      // echo '<button class="list-group-item  d-flex justify-content-between align-items-center viewEmployeeData" id="'.$row['emp_id'].'" data-toggle="modal" data-target="#modal_view_employee"> '.$row['first_name'].' '.$row['last_name'].'</button>';
    // die();
    
  

    }
    else{
      echo "No Employee Available";
      // die();
    }

  }


 }

else {
  echo "Field Must not be Empty ";
}


 ?>
