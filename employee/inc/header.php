<?php
 $filepath = realpath(dirname(__FILE__));
 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 
 spl_autoload_register('myAutoloader');

function myAutoloader($className)
{
    // $path = 'classes/';
    $path = $_SERVER['DOCUMENT_ROOT'].'/ems/employee/classes/';

    include $path.$className.'.php';

}

  $db = new Database();
  $fm = new Format();
  $usr = new User();
  // $comp = new Company();
  // $dep = new Department();
  // $des = new Designation();
  // $jobRole = new JobRole();
  $atn = new Attendance();
  $pro = new Project();
  $tsk = new Task();
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
   if(isset($_SERVER['HTTPS'])){
        $baseUrl2 = 'https';
    }
    else{
        $baseUrl2 = 'http';
    }
// $baseUrl=$_SERVER['DOCUMENT_ROOT'].'/ems/employee/classes/';
// $baseUrl="http://localhost/ems/";
$baseUrl="http://localhost/ems/";
// $baseUrl="'.$baseUrl2.'://localhost/ems/";
// $baseUrl="'.$baseUrl2.'://localhost/ems/";

  ?>
