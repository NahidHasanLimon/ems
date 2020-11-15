<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Project.php');
$pro= new Project();
?>
 <?php  
 if(!empty($_POST['del_project_cat_id']))
 {  
    $del_project_cat_id = $_POST["del_project_cat_id"];   
    $result=$pro->delete_project_category($del_project_cat_id);
     if($result){ 
      echo "success";
    }
    else{
        echo 'error';
    }
    }
  ?>
