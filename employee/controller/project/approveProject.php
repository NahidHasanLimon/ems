<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Project.php');
$pro= new Project();
?>
 <?php  
 if( isset($_POST['approve_project_id']) && !empty($_POST['approve_project_id']))
 {  
    $approve_project_id = $_POST["approve_project_id"];   
    $result=$pro->approve_project($approve_project_id);
     if($result){ 
      echo "success";
    }
    else{
        echo 'error';
    }
    } 
    if( isset($_POST['approve_all_project_ids']) && !empty($_POST['approve_all_project_ids']) )
 {  
    $approve_all_project_ids = $_POST["approve_all_project_ids"];   
    // var_dump($approve_all_project_ids);
    $result=$pro->approve_all_project($approve_all_project_ids);
     if($result){ 
      echo "success";
    }
    else{
        echo 'error';
    }
    }
  ?>
