<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php'); 
$db = new Database();
Session::init();
// AND tsk.assigned_to='.$emp_id.' AND tsk.approved_status=1 
$emp_id=Session::get("emp_id");
$columns = array('name', 'description');

$query = "SELECT tsk.*,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,pro.name as project_name,cl.name as client_name,tcategory.name as task_category_name,tstatus.status as task_status
       FROM `tasks` as tsk 
       LEFT JOIN employee emp1 ON emp1.emp_id=tsk.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=tsk.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=tsk.assigned_to
       LEFT JOIN projects pro ON pro.id=tsk.project_id
       LEFT JOIN task_categories tcategory ON tcategory.id=tsk.category_id
       LEFT JOIN clients cl ON cl.id=tsk.client_id
       LEFT JOIN task_status tstatus  ON tstatus.id=tsk.task_status
       ";

// if(isset($_POST['filter_client']) && $_POST['filter_client'] != '')
// {
// 	$cl_id=$_POST['filter_client'];
// 	 $query .= 'WHERE cl.id='.$cl_id.' 
//  ';
// }

// Start Data Filtering
if(isset($_POST['filterFormData']) && $_POST['filterFormData'] != '')
{
	$get = explode('&', $_POST['filterFormData'] ); // explode with and
	foreach ( $get as $key => $value) {
	  $filteredData[substr( $value, 0 , strpos( $value, '=' ) ) ] =  substr( $value, strpos( $value, '=' ) + 1 ) ;
	}
	// var_dump("ok");

	// only for filter by client
	if (isset($filteredData['filter_client']) && !isset($filteredData['filter_project']) && !isset($filteredData['filter_categories'])  && !isset($filteredData['filter_status']) ) {
		// $f_client_id=$filteredData['filter_client'];
		 $query .= 'WHERE cl.id='.$filteredData['filter_client'].' ';
	}
	// only for filter by person
	else if (isset($filteredData['filter_project']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories'])  && !isset($filteredData['filter_status']) ) {
		// $f_person_id=$filteredData['filter_project'];
		 $query .= 'WHERE tsk.project_id='.$filteredData['filter_project'].' ';
	}
	// only for filter by categories
	 else if (isset($filteredData['filter_categories']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_project'])  && !isset($filteredData['filter_status']) ) {
		// $f_t_category_id=$filteredData['filter_categories'];
		 $query .= 'WHERE tsk.category_id='.$filteredData['filter_categories'].' ';
	}
  // only for filter by status
	else if (isset($filteredData['filter_status']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_project'])  && !isset($filteredData['filter_categories']) ) {
		// $f_status_id=$filteredData['filter_status'];
		 $query .= 'WHERE tsk.task_status='.$filteredData['filter_status'].' ';
	}

   //  filter by client and person
	else if (isset($filteredData['filter_client']) && isset($filteredData['filter_project']) && !isset($filteredData['filter_categories'])  && !isset($filteredData['filter_status']) ) {
	$query .= 'WHERE cl.id='.$filteredData['filter_client'].' AND tsk.project_id='.$filteredData['filter_project'].' ';
	}
   //  filter by client and categories
	else if (isset($filteredData['filter_client']) && !isset($filteredData['filter_project']) && isset($filteredData['filter_categories'])  && !isset($filteredData['filter_status']) ) {
     $query .= 'WHERE cl.id='.$filteredData['filter_client'].' AND tsk.category_id='.$filteredData['filter_categories'].' ';
	}
   //  filter by client and status
	else if (isset($filteredData['filter_client']) && !isset($filteredData['filter_project']) && !isset($filteredData['filter_categories'])  && isset($filteredData['filter_status']) ) {
     $query .= 'WHERE cl.id='.$filteredData['filter_client'].' AND tsk.task_status='.$filteredData['filter_status'].' ';
	}
    //  filter by categories and status
	else if (!isset($filteredData['filter_client']) && !isset($filteredData['filter_project']) && isset($filteredData['filter_categories'])  && isset($filteredData['filter_status']) ) {
     $query .= 'WHERE tsk.category_id='.$filteredData['filter_categories'].' AND tsk.task_status='.$filteredData['filter_status'].' ';
	}
	 //  filter by person and status
	else if (!isset($filteredData['filter_client']) && isset($filteredData['filter_project']) && !isset($filteredData['filter_categories'])  && isset($filteredData['filter_status']) ) {
     $query .= ' WHERE tsk.project_id='.$filteredData['filter_project'].'  AND tsk.task_status='.$filteredData['filter_status'].' ';
	} 
	//  filter by person and categories
	else if (!isset($filteredData['filter_client']) && isset($filteredData['filter_project']) && isset($filteredData['filter_categories'])  && !isset($filteredData['filter_status']) ) {
     $query .= ' WHERE tsk.project_id='.$filteredData['filter_project'].' AND tsk.category_id='.$filteredData['filter_categories'].' ';

	}

   //  filter by client , person and categories
	else if (isset($filteredData['filter_client']) && isset($filteredData['filter_project']) && isset($filteredData['filter_categories'])  && !isset($filteredData['filter_status']) ) {
     $query .= ' WHERE cl.id='.$filteredData['filter_client'].' AND tsk.project_id='.$filteredData['filter_project'].' AND tsk.category_id='.$filteredData['filter_categories'].' ';

	}
	//  filter by client , person and status
	else if (isset($filteredData['filter_client']) && isset($filteredData['filter_project']) && !isset($filteredData['filter_categories'])  && isset($filteredData['filter_status']) ) {
     $query .= ' WHERE cl.id='.$filteredData['filter_client'].' AND tsk.project_id='.$filteredData['filter_project'].' AND tsk.task_status='.$filteredData['filter_status'].' ';

	}
   
   //  filter by client ,categories,and status

	else if (isset($filteredData['filter_client']) && !isset($filteredData['filter_project']) && isset($filteredData['filter_categories'])  && isset($filteredData['filter_status']) ) {
     $query .= ' WHERE cl.id='.$filteredData['filter_client'].' AND tsk.category_id='.$filteredData['filter_categories'].' AND tsk.task_status='.$filteredData['filter_status'].' ';

	}
   
     
   //  filter by  categories,and status,person

	else if (!isset($filteredData['filter_client']) && isset($filteredData['filter_project']) && isset($filteredData['filter_categories'])  && isset($filteredData['filter_status']) ) {
     $query .= ' WHERE tsk.project_id='.$filteredData['filter_project'].' AND tsk.category_id='.$filteredData['filter_categories'].' AND tsk.task_status='.$filteredData['filter_status'].' ';

	}
	  //  filter by  all
	else if (isset($filteredData['filter_client']) && isset($filteredData['filter_project']) && isset($filteredData['filter_categories'])  && isset($filteredData['filter_status']) ) {
     $query .= ' WHERE cl.id= '.$filteredData['filter_client'].' AND tsk.project_id='.$filteredData['filter_project'].' AND tsk.category_id='.$filteredData['filter_categories'].' AND tsk.task_status='.$filteredData['filter_status'].' ';

	}
 $query.='AND tsk.assigned_to='.$emp_id.' AND tsk.approved_status="1"';

}else{
	$query.='WHERE tsk.assigned_to='.$emp_id.' AND tsk.approved_status="1" ';
}
// 	else{
// // 	$query .= ' AND  tsk.assigned_to='.$emp_id.' AND tsk.approved_status=1 
// //  ';
// }
 // $query .= ' WHERE  tsk.assigned_to='.$emp_id.' AND tsk.approved_status=1 
 // ';
 // var_dump($query);
//End Data Filtering
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
// else
// {
//  $query .= 'ORDER BY id ASC ';
// }

$query1 = '';
if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
if ($number_filter=$db->select($query) ) {
	$number_filter_row = mysqli_num_rows($number_filter);
}else{
	$number_filter_row=0;
}


$result = $db->select($query . $query1);
$data = array();
$i=0;

if ($result) {
	while($row = mysqli_fetch_array($result))
	{
		$i++;
		$sub_array = array();

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

	$sub_array[] = '<td>'. $row["name"] . '</td>';
	$sub_array[] = '<td>' . $row["client_name"] . '</td>';
	$sub_array[] = '<td>' . $row["task_category_name"] . '</td>';
	$sub_array[] = '<td>' . $row["project_name"] . '</td>';
		$sub_array[] = '<td>' . $row["created_by_name"] . '</td>';
	$sub_array[] = '<td><span class="label label-'.$tClass.'">'.$tStatus.'</span></td>';
	$sub_array[] = '<td> <button type="button" class="btn btn-rounded btn-info viewTask" id="'.$row["id"].'"><i class="fa fa-eye" aria-hidden="true"></i></button></td>';
	$data[] = $sub_array;
	}
}


function get_all_data($db,$emp_id)
{
 $query = "SELECT tsk.*,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,pro.name as project_name,cl.name as client_name,tcategory.name as task_category_name,tstatus.status as task_status
       FROM `tasks` as tsk 
       LEFT JOIN employee emp1 ON emp1.emp_id=tsk.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=tsk.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=tsk.assigned_to
       LEFT JOIN projects pro ON pro.id=tsk.project_id
       LEFT JOIN task_categories tcategory ON tcategory.id=tsk.category_id
       LEFT JOIN clients cl ON cl.id=tsk.client_id
       LEFT JOIN task_status tstatus  ON tstatus.id=tsk.task_status
       WHERE tsk.assigned_to='.$emp_id.' AND tsk.approved_status='1' ";
 if ($result = $db->select($query) ) {
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
