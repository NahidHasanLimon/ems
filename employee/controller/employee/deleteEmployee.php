 
<?php

   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 

  $usr= new User();
  ?>

 <?php  

 if(!empty($_POST["del_employee_id"]) && isset($_POST['del_employee_id']) ) 
{
  // echo "You Selected Company,Department,Designation";
  $del_employee_id=$_POST["del_employee_id"];
  $deleteEmployee=$usr-> delete_employee($del_employee_id);
  if ($deleteEmployee) {
    // echo $deleteEmployee;
     echo "Successfully deleted";
  }
  else{
    echo "failed to delete";
  }


}

 
else {
  echo "Field Must not be Empty ";
}


 ?>
