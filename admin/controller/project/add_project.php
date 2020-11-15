<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Project.php');
$pro= new Project();
?>
 <?php  
 if(!empty($_POST))
 {
  if (empty($_POST['p_name']) || empty($_POST['p_start_date']) || empty($_POST['p_end_date']) ) {
    echo "field can not be empty";
  }else{
     $result=$pro->add_project();
     if($result){ 
      echo 'success';
    }
    else{
        echo 'error';
    }
  
  }
}
  ?>

  