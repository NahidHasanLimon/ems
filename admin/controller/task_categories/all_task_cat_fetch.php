<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
$db = new Database();
$columns = array('name', 'description');

$query = "SELECT * FROM task_categories ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE name LIKE "%'.$_POST["search"]["value"].'%" 
 OR description LIKE "%'.$_POST["search"]["value"].'%" 
 ';
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

if ($number_filter=$db->select($query) ) {
	$number_filter_row = mysqli_num_rows($number_filter);
}else{
	$number_filter_row=0;
}
$result = $db->select($query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<td class="task_cat_name" data-column="name">'. $row["name"] . '</td>';
 $sub_array[] = '<td class="task_cat_description" data-column="description">'. $row["description"] . '</td>';
 $sub_array[] = '<td> <button type="button" class="btn btn-rounded btn-danger deleteTaskCat" id="'.$row["id"].'"><i class="fa fa-trash" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-rounded btn-info editTaskCat" id="'.$row["id"].'"><i class="far fa-edit" aria-hidden="true"></i></button>

 </td>';
 $data[] = $sub_array;
}

function get_all_data($db)
{
 $query = "SELECT * FROM task_categories";
 // $result = mysqli_query($db, $query);
   if ($result = $db->select($query) ) {
 return mysqli_num_rows($result);
 }
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($db),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
