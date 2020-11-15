 
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
  // echo "You Selected Company,Department,Designation";
  $selectedCompanyID=$_POST["selectCompany"];
  $selectedDepartmentID=$_POST["selectDepartment"];
  $selectedDesignationID=$_POST["selectDesignation"];
  // echo "selected only Company";
  if ( $selectedCompanyID!="" && $selectedDepartmentID!="" ) {
    $find_employee_by_company_department_designation=$usr-> find_an_employee_By_Company_department_designation($selectedCompanyID,$selectedDepartmentID,$selectedDesignationID);
    if ($find_employee_by_company_department_designation) {
    // $eData=array();
    while($row =$find_employee_by_company_department_designation->fetch_assoc()){ 
       // $eData[] = $row;
      $output= '

              <tr> 
                     <td>' . $row["first_name"] .' '.$row['last_name'].'</td>  
                          <td>
                          <button name="View" id="' . $row["emp_id"] .'" class="btn btn-rounded btn-info viewEmployeesData">
                          <i class="fa fa-eye" aria-hidden="true"></i> 
                          </button>
                          </td>  
                          <td><a href="v_edit_employee.php?emp_id='.$row['emp_id'].'" type="button" name="View" id="' . $row["emp_id"] . '" class="btn btn-rounded btn-primary rounded editEmployeesData" role="button"><i class="far fa-edit"></i></a></td>  
                     </tr>    
                ';  
                 echo $output; 
     

    }
      // echo json_encode($eData);
      die();

    }
    else{
      echo "No Employee Available";
      die();
    }

  }
}

 else if( !empty($_POST["selectCompany"]) && !empty($_POST["selectDepartment"])  )
{
  // echo "You Selected Company,Department";
  $selectedCompanyID=$_POST["selectCompany"];
  $selectedDepartmentID=$_POST["selectDepartment"];
  // echo "selected only Company";
  if ( $selectedCompanyID!="" && $selectedDepartmentID!="" ) {
    $find_employee_by_company_department=$usr-> find_an_employee_By_Company_and_department($selectedCompanyID,$selectedDepartmentID);
    if ($find_employee_by_company_department) {
    $eData=array();
    while($row =$find_employee_by_company_department->fetch_assoc()){ 
       // $eData[] = $row;
       $output= '

                    <tr> 
                     <td>' . $row["first_name"] .' '.$row['last_name'].'</td>  
                          <td>
                          <button name="View" id="' . $row["emp_id"] .'" class="btn btn-rounded btn-info viewEmployeesData">
                          <i class="fa fa-eye" aria-hidden="true"></i> 
                          </button>
                          </td>  
                          <td><a href="v_edit_employee.php?emp_id='.$row['emp_id'].'" type="button" name="View" id="' . $row["emp_id"] . '" class="btn btn-rounded btn-primary rounded editEmployeesData" role="button"><i class="far fa-edit"></i></a></td>  
                     </tr>  
                ';  
                 echo $output; 
     

    }
      // echo json_encode($eData);
      die();

    }
    else{
      echo "No Employee Available";
      die();
    }

  }
}
 else if(!empty($_POST["selectCompany"])  )  
{
    $selectedCompanyID=$_POST["selectCompany"];
  // echo "selected only Company";
  if ( $selectedCompanyID!="" ) {
    $find_employee_by_company_id=$usr-> find_an_employee_By_Company($selectedCompanyID);
    if ($find_employee_by_company_id) {
    $eData=array();

    while($row =$find_employee_by_company_id->fetch_assoc()){ 
       // $eData[] = $row;
      $output= '


                    <tr> 
                     <td>' . $row["first_name"] .' '.$row['last_name'].'</td>  
                          <td>
                          <button name="View" id="' . $row["emp_id"] .'" class="btn btn-rounded btn-info viewEmployeesData">
                          <i class="fa fa-eye" aria-hidden="true"></i> 
                          </button>
                          </td>  
                          <td><a href="v_edit_employee.php?emp_id='.$row['emp_id'].'" type="button" name="View" id="' . $row["emp_id"] . '" class="btn btn-rounded btn-primary rounded editEmployeesData" role="button"><i class="far fa-edit"></i></a></td>  
                     </tr>   
                ';  
                 echo $output; 

    }
      // echo json_encode($eData);
      die();

    }
    else{
      echo "No Employee Available";
      die();
    }

  }


} 

else if(isset($_POST["searchByMobileNo"]) && empty($_POST["searchByName"]))  
{

  $searchByMobileNo=$_POST["searchByMobileNo"];

  if ( $searchByMobileNo!="" ) {
    $find_employee_by_mobileNo=$usr-> find_employee_info_by_mobileNo($searchByMobileNo);
    if ($find_employee_by_mobileNo) {
    $eData=array();
    while($row =$find_employee_by_mobileNo->fetch_assoc()){ 
       // $eData[] = $row;
       $output = '

                     <tr> 
                     <td>' . $row["first_name"] .' '.$row['last_name'].'</td>  
                          <td>
                          <button type="button" name="View" id="' . $row["emp_id"] . '" 
                          class="btn btn-rounded btn-info viewEmployeesData">
                          <i class="fa fa-eye" aria-hidden="true"></i> 
                          </button>
                          </td>  
                          <td><a href="v_edit_employee.php?emp_id='.$row['emp_id'].'" type="button" name="View" id="' . $row["emp_id"] . '" class="btn btn-rounded btn-primary rounded editEmployeesData" role="button"><i class="far fa-edit"></i></a></td>  
                     </tr>  
                ';  
                 echo $output; 
     

    }
      // echo json_encode($eData);
      die();

    }
    else{
      echo "No Employee Available";
      die();
    }

  }

  

  
}

else if(isset($_POST["searchByName"]) && empty($_POST["searchByMobileNo"]) )  
{
  $searchByName=$_POST["searchByName"];

  if ( $searchByName!="" ) {
    $find_employee_by_name=$usr-> search_employee_by_name($searchByName);
    if ($find_employee_by_name) {
      // $eData=array();

    while($row =$find_employee_by_name->fetch_assoc()){ 

 $output= '

                   <tr> 
                     <td>' . $row["first_name"] .' '.$row['last_name'].'</td>  
                          <td>
                          <button type="button" name="View" id="' . $row["emp_id"] . '" 
                          class="btn btn-rounded btn-info viewEmployeesData">
                          <i class="fa fa-eye" aria-hidden="true"></i> 
                          </button>
                          </td>  
                          <td><a href="v_edit_employee.php?emp_id='.$row['emp_id'].'" type="button" name="View" id="' . $row["emp_id"] . '" class="btn btn-rounded btn-primary rounded editEmployeesData" role="button"><i class="far fa-edit"></i></a></td>  
                     </tr>  
                ';  
                 echo $output; 

     // $eData[] = $row;

    
    }
  
    // echo json_encode($eData);
    die();
  

    }
    else{
      echo "No Employee Available";
      die();
    }

  }


 }

else {
  echo "Field Must not be Empty ";
}


 ?>
