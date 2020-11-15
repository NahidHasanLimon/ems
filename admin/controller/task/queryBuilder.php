<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
$db = new Database();
$index_list = ['client_id', 'assigned_to', 'category_id','approved_status','project_id'];
$myFields = ['filter_client','filter_person','filter_categories','filter_status','filter_projects'];

$query="SELECT tsk.*,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,pro.name as project_name,cl.name as client_name,tcategory.name as task_category_name,tstatus.status as task_status
       FROM `tasks` as tsk 
       LEFT JOIN employee emp1 ON emp1.emp_id=tsk.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=tsk.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=tsk.assigned_to
       LEFT JOIN projects pro ON pro.id=tsk.project_id
       LEFT JOIN task_categories tcategory ON tcategory.id=tsk.category_id
       LEFT JOIN clients cl ON cl.id=tsk.client_id
       LEFT JOIN task_status tstatus  ON tstatus.id=tsk.task_status 
       ";

if(isset($_POST['filterFormData']) && $_POST['filterFormData'] != '')
{
	$query.=' WHERE ';
	$get = explode('&', $_POST['filterFormData'] ); // explode with and
	foreach ( $get as $key => $value) {
	  $filteredData[substr( $value, 0 , strpos( $value, '=' ) ) ] =  substr( $value, strpos( $value, '=' ) + 1 ) ;
	}
	// if (isset($filteredData['filter_month_picker']) ) {
	// 	 $startDate=$filteredData['filter_month_picker'].'-01';
	// }

		$queryList = ["","","","",""];
		if (isset($filteredData['filter_client'])) {
			$queryList[0]=' cl.id='.$filteredData['filter_client'];
		}if (isset($filteredData['filter_person'])) {
				$queryList[1]=' tsk.assigned_to='.$filteredData['filter_person'] ;
		}if (isset($filteredData['filter_categories'])) {
			$queryList[2]=' tsk.category_id='.$filteredData['filter_categories'] ;
		}if (isset($filteredData['filter_status'])) {
			$queryList[3]=' tsk.approved_status='.$filteredData['filter_status'] ;
		}if (isset($filteredData['filter_projects'])) {
			$queryList[4]=' tsk.project_id='.$filteredData['filter_projects'] ;
		}
		$count = 0;
		$index = 0;
	
	foreach($myFields as $myField)
	{
		if(isset($filteredData[$myField]) && !empty($queryList[$index]))
		{
			
			if($count>0)
				$query.=' AND ';
			$query.= $queryList[$index];
			$count++;
			
		}
		$index++;
	}
	// print_r('<br>'.$query.'<br>');
}

// $query = $query . ';'
// new code
$query1 = '';
if($_POST["length"] != -1)
{
 $query1 = ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
if ($number_filter=$db->select($query) ) {
	$number_filter_row = mysqli_num_rows($number_filter);
}else{
	$number_filter_row=0;
}
// end of query
// var_dump($query . $query1);
if ($result = $db->select($query . $query1)) {
	$data = array();
$i=0;
	
if ($result) {

	while($row = mysqli_fetch_array($result))
	{
		$sub_array = array();
		$i++;
	
		if ($row['approved_status']!=0) {
			$aStatus="Aprroved";
			$sIconClass="check";
			$sIconColor="#2bb3c0";
		}else{$aStatus="Un Appr.";$sIconClass="exclamation-triangle";$sIconColor="#ff4747";}
		if (!is_null($row['actual_start_date'])&& !is_null($row['actual_end_date'])) {
			$tStatus="Completed";
			$tClass="info bg-green";
		}else if (!is_null($row['actual_start_date'])&& is_null($row['actual_end_date'])) {
			$tStatus="Working";
			$tClass="primary";
		}else if(!is_null($row['actual_start_date'])&& is_null($row['actual_end_date'])) {
			$tStatus="Pending";
			$tClass="danger";
		}else{
			$tStatus="Pending";
			$tClass="danger";
		}
	
	$sub_array[] = '<td>'.$i. '</td>';
	$sub_array[] = '<td><i class="fas fa-'.$sIconClass.'"style="color:'.$sIconColor.';"></i></td>';
	// $sub_array[] = '<td><span class="label label-'.$sIconClass.'">'.$aStatus.'</span></td>';
	$sub_array[] = '<td>'. $row["name"] . '</td>';
	$sub_array[] = '<td>' . $row["client_name"] . '</td>';
	$sub_array[] = '<td>' . $row["assigned_to_name"] . '</td>';
	$sub_array[] = '<td>' . $row["task_category_name"] . '</td>';
	$sub_array[] = '<td>' . $row["project_name"] . '</td>';
	// $sub_array[] = '<td>' . $row["created_by_name"] . '</td>';
	$sub_array[] = '<td><span class="label label-'.$tClass.'">'.$tStatus.'</span></td>';
	$sub_array[] = '<td> <button type="button" class="btn btn-rounded btn-info viewTask" id="'.$row["id"].'"><i class="fa fa-eye" aria-hidden="true"></i></button></td>
	<td> <button type="button" class="btn btn-rounded btn-danger deleteTask" id="'.$row["id"].'"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
	$data[] = $sub_array;
	}
	// if no data found

}
}
else{
	$data=[];
}
function get_all_data($db)
{
 $query = "SELECT tsk.*,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,pro.name as project_name,cl.name as client_name,tcategory.name as task_category_name,tstatus.status as task_status
       FROM `tasks` as tsk 
       LEFT JOIN employee emp1 ON emp1.emp_id=tsk.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=tsk.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=tsk.assigned_to
       LEFT JOIN projects pro ON pro.id=tsk.project_id
       LEFT JOIN task_categories tcategory ON tcategory.id=tsk.category_id
       LEFT JOIN clients cl ON cl.id=tsk.client_id
       LEFT JOIN task_status tstatus  ON tstatus.id=tsk.task_status";

 if ($result = $db->select($query) ) {
 return mysqli_num_rows($result);
 }
 

}
// if (is_null($data) || empty($data)) {
// 	$data=[];
// }
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($db),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);


?>
