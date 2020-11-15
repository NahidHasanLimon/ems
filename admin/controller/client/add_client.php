<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Client.php');
$cln= new Client();
?>
 <?php  
 if(!empty($_POST))
 {  
    $client_name = $_POST["client_name"];  
    $client_description = $_POST["client_description"];  
    $result=$cln->add_client($client_name,$client_description);
     if($result){ 
      echo "success";
    }
    else{
        echo 'error';
    }
    
    }
  ?>

  