<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php'); 
$db = new Database();
 Session::init();
 $emp_id=Session::get("emp_id");
 $loggedRole=Session::get("loggedRole");

$columns = array('name', 'description');

$query = "SELECT tsk.*,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,pro.name as project_name
       FROM `tasks` as tsk 
       LEFT JOIN employee emp1 ON emp1.emp_id=tsk.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=tsk.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=tsk.assigned_to
       LEFT JOIN projects pro ON pro.id=tsk.project_id  
       WHERE tsk.approved_status='1' AND tsk.actual_start_date IS NULL AND tsk.assigned_to='$emp_id'  ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
  AND (tsk.name LIKE "%'.$_POST["search"]["value"].'%" 
 OR tsk. description LIKE "%'.$_POST["search"]["value"].'%" 
 )';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
if ($number_filter_row=$db->select($query) ) {
	$number_filter_row = mysqli_num_rows($number_filter_row);
}else{
	$number_filter_row=0;
}


$result = $db->select($query . $query1);

$data = array();
$i=0;

if ($result) {
	while($row = mysqli_fetch_array($result))
	{
		if (is_null($row['start_date'])) {
			
		}
	$sub_array = array();
	// $sub_array[] = '<td>'.$i. '</td>';
	$sub_array[] = '<td>' . $row["name"] . '</td>';
	$sub_array[] = '<td>' . $row["created_by_name"] . '</td>';

	$sub_array[] = '<td>' . ($row['start_date'] ? date('d M,Y ', strtotime($row['start_date'])) : '') . '</td>';
	$sub_array[] = '<td>' . ($row['end_date'] ? date('d M,Y ', strtotime($row['end_date'])) : '') . '</td>';
	$sub_array[] = '<td> 
	<button type="button" class="btn btn-rounded btn-primary startBtnTask"  id="'.$row["id"].'" ><i class="fa fa-paper-plane" aria-hidden="true"></i>Start</button> 

	<button type="button" class="btn btn-rounded btn-info viewTask" id="'.$row["id"].'"><i class="fa fa-eye" aria-hidden="true"></i></button>
	';

	$sub_array[] = '<td> <button type="button" class="btn btn-rounded btn-info viewTask" id="'.$row["id"].'"><i class="fa fa-eye" aria-hidden="true"></i></button>'
	 ;
	$data[] = $sub_array;
	}
}


function get_all_data($db,$emp_id)
{
 $query = "SELECT tsk.*,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,pro.name as project_name
       FROM `tasks` as tsk 
       LEFT JOIN employee emp1 ON emp1.emp_id=tsk.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=tsk.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=tsk.assigned_to
       LEFT JOIN projects pro ON pro.id=tsk.project_id  
       WHERE tsk.approved_status='1' AND tsk.assigned_to='$emp_id'";
 $result = $db->select($query);
 if ($result) {
 	 return mysqli_num_rows($result);
 }

}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($db,$emp_id),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
