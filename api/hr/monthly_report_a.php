<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
		 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/api/config/database.php'); 
		  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/api/objects/monthly_report_o.php'); 
// database connection will be here
// include database and object files

 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$monthlyReport = new monthlyReport($db);
 
// read products will be here
// query products
$stmt = $monthlyReport->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $monthly_report_arr=array();
    $monthlyReport_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $monthlyReport_item=array(
            "id" => $id,
            "emp_id" => $emp_id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "image_url" => $photo,
            "present" => $t_present,
            "absent" => $t_absent,
            "half_day" => $t_half_day,
            "late" => $t_late,
            "meeting_late" => $t_meeting_late,
            "casual_leave" => $t_casual_leave,
            "sick_leave" => $t_sick_leave,
            "date" => $month
        );
 
        array_push($monthlyReport_arr["records"], $monthlyReport_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($monthlyReport_arr);
}
 
// no products found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No Records found.")
    );
}
?>