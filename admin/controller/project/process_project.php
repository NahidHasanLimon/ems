<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Project.php');
$pro= new Project();
?>
 <?php  
if( isset($_POST['start_project_id']) && !empty($_POST['start_project_id']))
 {  
    $start_project_id = $_POST["start_project_id"];   
    $result=$pro->start_project($start_project_id);
     if($result){ 
      echo "success";
    }
        else{
            echo "error";
        }
    } 
    else if( isset($_POST['end_project_id']) && !empty($_POST['end_project_id']) )
   {  
    $end_project_id = $_POST["end_project_id"];   ;   
    $result=$pro->end_project($end_project_id);
     if($result){ 
      echo "success";
      } 
    else{
        echo 'error';
      }
    }
    else if( isset($_POST['statusChangeProject_id']) && !empty($_POST['statusChangeProject_id']) && isset($_POST['selectProjectStatus']) && !empty($_POST['selectProjectStatus'])  )
   {  
    $statusChangeProject_id = $_POST["statusChangeProject_id"];   
    $selectProjectStatus = $_POST["selectProjectStatus"];   
    $result=$pro->update_project_status($statusChangeProject_id,$selectProjectStatus);
     if($result){ 
      echo "success";
      } 
    else{
        echo 'error';
      }
    }
  ?>
