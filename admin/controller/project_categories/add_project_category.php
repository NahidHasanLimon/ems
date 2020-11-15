<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Project.php');
$pro= new Project();
?>
 <?php  
 if(!empty($_POST))
 {  
    $project_cat_name = $_POST["project_cat_name"];  
    $project_cat_description = $_POST["project_cat_description"];  
    $result=$pro-> add_project_category($project_cat_name,$project_cat_description);
     if($result){ 
      echo "Inserted SuccessFully";
    }
    else{
        echo 'Failed to Insert';
    }
    }
  ?>

  