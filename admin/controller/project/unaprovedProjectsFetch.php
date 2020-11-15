<?php
//fetch.php
// $result=$this->db->select($query);
// $connect = mysqli_connect("localhost", "root", "", "7teen_employee");
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
$db = new Database();

$columns = array('name', 'description');

$query = "SELECT * FROM projects  WHERE approved_status='0'";

if(isset($_POST["search"]["value"]))
{
 $query .= '
  AND (name LIKE "%'.$_POST["search"]["value"].'%" 
 OR description LIKE "%'.$_POST["search"]["value"].'%" 
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
	$sub_array = array();
	// $sub_array[] = '<td>'.$i. '</td>';
	$sub_array[] = '<td>' . $row["name"] . '</td>';
	$sub_array[] = '<td>' . $row["description"] . '</td>';
	$sub_array[] = '<td> <button type="button" class="btn btn-rounded btn-info viewProject" id="'.$row["id"].'"><i class="fa fa-eye" aria-hidden="true"></i>View</button>
	 <button type="button" class="btn btn-rounded btn-primary approveProject" id="'.$row["id"].'"><i class="fa fa-paper-plane" aria-hidden="true"></i>Approve</button></td>';
	$data[] = $sub_array;
	}
}


function get_all_data($db)
{
 $query = "SELECT * FROM projects WHERE approved_status='0'";
 $result = $db->select($query);
 if ($result) {
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
