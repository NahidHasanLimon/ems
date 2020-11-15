<?php
 $filepath = realpath(dirname(__FILE__));
 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 
//  spl_autoload_register(function($class){
// include_once "classes/".$class.".php";
//   });
 spl_autoload_register('myAutoloader');
 // for hide report
ini_set('error_reporting', 0);
ini_set('display_errors', 0);
// for hide report
 // ini_set('display_errors', 'On');
function myAutoloader($className)
{
    // $path = 'classes/';
    $path = $_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/';

    include $path.$className.'.php';

}

  $db = new Database();
  $fm = new Format();
  $usr = new User();
  $comp = new Company();
  $dep = new Department();
  $des = new Designation();
  $jobRole = new JobRole();
  $atn = new Attendance();
  $pro = new Project();
  $tsk = new Task();
  $cln = new Client();
  $gc = new GrantChart();
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
  ?>


 