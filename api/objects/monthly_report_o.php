<?php
class MonthlyReport{
 
    // database connection and table name
    private $conn;
    private $table_name = "monthly_summary";
 
    // object properties
    public $id;
    public $emp_id;
    public $first_name;
    public $last_name;
    public $image_url;
    public $present;
    public $absent;
    public $half_day;
    public $late;
    public $meeting_late;
    public $casual_date;
    public $sick_leave;
    public $date;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read monthly_summary
function read(){
 
    // select all query
    $query = "select * from 
monthly_summary as mr 
inner join ( 
select emp.emp_id as n_emp_id,
emp.first_name, 
emp.last_name,
emp.photo 
from employee as emp 
) as e 
on e.n_emp_id = mr.emp_id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
	}
}
?>