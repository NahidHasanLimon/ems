<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/header.php'); 

//the SQL query to be executed
$query="SELECT fetch_at.emp_id , emp.first_name,emp.last_name,fetch_at.Total_Attendance_Days,fetch_at.Total_working_Days FROM 
employee as emp
INNER JOIN (
select 
emp_id, count(distinct at_date) as Total_Attendance_Days, 
    FORMAT( ( (sum(case when status = 'hd' then 1 else 0 end)/2) +
    (sum(case when status = 'l' then 1 else 0 end))+
    (sum(case when status = 'ml' then 1 else 0 end))+
     ( sum(case when status= 'p' then 1 else 0 end) ) ),1)
     Total_working_Days
 
  from emp_attendance tea
   WHERE tea.at_date >= '2019-11-01' + INTERVAL 0 MONTH AND tea.at_date < '2019-11-01' + INTERVAL 1 MONTH
    
    group by emp_id 
)  as fetch_at

ON fetch_at.emp_id= emp.emp_id
 WHERE emp.status='1' ";

//storing the result of the executed query
// $result = $conn->query($query);
// $result = $conn->query($query);
$result = $db->select($query);

//initialize the array to store the processed data
$jsonArray = array();

//check if there is any data returned by the SQL Query
if ($result->num_rows > 0) {
  //Converting the results into an associative array
  while($row = $result->fetch_assoc()) {
    $jsonArrayItem = array();
    $jsonArrayItem['label'] = $row['first_name'];
    $jsonArrayItem['value'] = $row['Total_working_Days'];
    //append the above created object into the main array.
    array_push($jsonArray, $jsonArrayItem);
  }
}
//set the response content type as JSON
header('Content-type: application/json');
//output the return value of json encode using the echo function. 
echo json_encode($jsonArray);
?>
