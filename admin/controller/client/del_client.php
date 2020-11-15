<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Client.php');
$cln= new Client();
?>
 <?php  
 if(!empty($_POST['del_client_id']))
 {  
    $del_client_id = $_POST["del_client_id"];   
    $result=$cln->delete_client($del_client_id);
     if($result){ 
      echo "success";
    }
    else{
        echo 'error';
    }
    }
  ?>
