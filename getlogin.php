<?php
$filepath = realpath(dirname(__FILE__));
	include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php');
	$usr= new User();
if($_SERVER['REQUEST_METHOD']=='POST'){
     $email=$_POST['email'];
    $password=$_POST['password'];
    $user_login=$usr->user_login($email,$password);

}

?>
