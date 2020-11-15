<?php
$filepath = realpath(dirname(__FILE__));
	
// 	include_once ($filepath.'/../../classes/User.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php');  
	$usr= new User();

if(isset($_POST["department_id"]) && !empty($_POST["department_id"])){
   
    $department_id=$_POST["department_id"];
   //Display Designation list
     $designation_List=$usr->designation_list_for_department($department_id);
        if($designation_List){
        // echo '<option value="">Select Designation</option>';
        while($row = $designation_List->fetch_assoc()){ 
            echo '<option value="'.$row['des_id'].'">'.$row['des_name'].'</option>';
        }
    }else{
        echo '<option value="">Designation  Not  available</option>';
    }
}


?>