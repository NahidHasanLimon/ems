<?php
 $filepath = realpath(dirname(__FILE__));
// 	include_once ($filepath.'/../lib/Session.php');
		include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 
	// include_once ($filepath.'/../lib/Database.php');
	// include_once ($filepath.'/../helpers/Format.php');


class GrantChart
{

 private $db;
 private $fm;

public function __construct()
   {
 $this->db = new Database();
 $this->fm = new Format();



   }
    public function task_name()
   {
   $query= "SELECT * FROM tasks LIMIT 10";
     $result=$this->db->select($query);
     return $result;

   }
    public function an_employee_task_name_in_a_month($emp_id,$startDate)
   {
    $date = new DateTime($startDate);
   $start_date=$date->modify('first day of this month')->format('Y-m-d');
   $end_date=$date->modify('last day of this month')->format('Y-m-d');
   $query= "SELECT * FROM tasks as tsk WHERE tsk.assigned_to='$emp_id' AND tsk.start_date >= '$start_date' + INTERVAL 0 MONTH AND tsk.start_date < '$start_date' + INTERVAL 1 MONTH
   ";
   // $query= "SELECT * FROM tasks WHERE tasks.assigned_to='$emp_id' ";
     $result=$this->db->select($query);
     return $result;
   } 
    
  

    public function find_employee_name($emp_id)
   {
   $query= "SELECT first_name,last_name FROM employee  WHERE emp_id='$emp_id' ";
     $result=$this->db->select($query);
     return $result;

   } 
    





}



?>
