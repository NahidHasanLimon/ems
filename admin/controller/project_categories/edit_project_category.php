<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Project.php');
$pro= new Project();
?>
 <?php  
 if(!empty($_POST['hidden_project_cat_id']) && !empty($_POST['project_cat_name']))
 {  
    $update_project_cat_id = $_POST["hidden_project_cat_id"];    
    $project_cat_name = $_POST["project_cat_name"];    
    $project_cat_description = $_POST["project_cat_description"];    
    $project_cat_description = $_POST["project_cat_description"];    
    $result=$pro->update_project_category($update_project_cat_id,$project_cat_name,$project_cat_description);
     if($result){ 
      echo "success";
    }
    else{
        echo 'error';
    }
    }
  ?>
