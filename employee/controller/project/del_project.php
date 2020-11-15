<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Project.php');
$pro= new Project();
?>
 <?php  
 if(!empty($_POST['del_project_id']))
 {  
    $del_project_id = $_POST["del_project_id"];   
    $result=$pro->delete_project($del_project_id);
     if($result){ 
      echo "success";
    }
    else{
        echo 'error';
    }
    }
  ?>
