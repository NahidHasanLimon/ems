<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkAdminSession();?>
<?php
 $filepath = realpath(dirname(__FILE__));
 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 
 spl_autoload_register(function($class){
include_once "classes/".$class.".php";
  });
  $db = new Database();
  $fm = new Format();
  $usr = new User();
  $comp = new Company();
  $dep = new Department();
  $des = new Designation();
  $jobRole = new JobRole();
  $atn = new Attendance();
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: pre-check=0, post-check=0, max-age=0");
header("Pragma: no-cache");
header("Expires: Mon, 6 Dec 1977 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?><?php
if (isset($_GET['action']) && $_GET['action']=='logout') {
 Session::unsetUser();
 Session::destroy();
 exit;}
   ?><?php
$baseUrl="http://localhost/ems/";
// $baseUrl="http://7teen.com.bd/ems/";
$pageSlug="common";
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>7TEEN EMS- <?php echo $pageSlug; ?> </title>
  <link href="<?php echo $baseUrl.'admin/vendor/fontawesome-free/css/all.min.css'; ?>" rel="stylesheet"type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
 
  <link href="<?php echo $baseUrl.'admin/css/sb-admin-2.min.css'; ?>" rel="stylesheet">
  <!-- Custom by Me -->

   <link href="<?php echo $baseUrl.'admin/css/myCustom.css'; ?>" rel="stylesheet"type="text/css">

   <link href="<?php echo $baseUrl.'admin/vendor/datatables/dataTables.bootstrap4.min.css'; ?>" rel="stylesheet"type="text/css">

    <!-- Datepicker Jquery Bootstrap -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  
   <script src="<?php echo $baseUrl.'admin/vendor/jquery/jquery.min.js'; ?>"></script>

   <!-- bootstrap print css -->
   <!-- <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
   <link href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" rel="stylesheet"> -->
   <!-- bootstrap print css -->
</head>

