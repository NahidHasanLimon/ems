<?php include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');Session::checkEmployeeSession(); ?>
  <?php 
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php');
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php');
  $filepath = realpath(dirname(__FILE__));
  spl_autoload_register(function($class){
  include_once "classes/".$class.".php";

  });
  $db = new Database();
  $fm = new Format();
  $usr = new User();

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: pre-check=0, post-check=0, max-age=0");
header("Pragma: no-cache");
header("Expires: Mon, 6 Dec 1977 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

?>
<?php 
$baseUrl="http://localhost/ems/"; 
?>
<?php if(isset($_GET['action']) && $_GET['action']=='logout'){
Session::unsetUser();
Session::destroy();
exit;
}
  ?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>7Teen-EMS</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $baseUrl.'employee/vendor/fontawesome-free/css/all.min.css'; ?>" rel="stylesheet"type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href="<?php echo $baseUrl.'employee/vendor/datatables/dataTables.bootstrap4.min.css'; ?>" rel="stylesheet"type="text/css">
  <link href="<?php echo $baseUrl.'employee/css/empployee_profile.css'; ?>" rel="stylesheet"type="text/css">
   <style>
     .ui-datepicker-calendar {

    display: none;

}

   </style>
</head>
<body>
<?php include_once ('nav-bar.php'); ?>
<?php include_once ('logoutModal.php'); ?>
<?php include_once ('partials/scripts.php'); ?>

