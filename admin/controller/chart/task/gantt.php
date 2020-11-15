<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/inc/header.php'); 
$list_date=array();
$queryEmp="SELECT emp.emp_id,CONCAT(emp.first_name,' ',emp.last_name) as name FROM employee as emp
WHERE emp.status=1";
$e_list_result=$db->select($queryEmp);
if ($e_list_result) {
    while ($row_e=$e_list_result->fetch_assoc() ) {
       $process_n[] = array(
    'label' => $row_e['name'],
    'id' => $row_e['emp_id']
    );
  }
}
$process_j=array(
         "fontsize"=> "12",
        "isbold"=> "1",
        "align"=> "left",
        "style"=> array (
               "text"=> "txt-red txt-big"
            ),
        "headertext"=> "Employee",
        "headerfontsize"=> "14",
        "headervalign"=> "middle",
        "headeralign"=> "left",
        "process"=>$process_n
        );
$query="SELECT tsk.*,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,pro.name as project_name,cl.name as client_name,tcategory.name as task_category_name,tstatus.status as task_status
       FROM `tasks` as tsk 
       LEFT JOIN employee emp1 ON emp1.emp_id=tsk.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=tsk.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=tsk.assigned_to
       LEFT JOIN projects pro ON pro.id=tsk.project_id
       LEFT JOIN task_categories tcategory ON tcategory.id=tsk.category_id
       LEFT JOIN clients cl ON cl.id=tsk.client_id
       LEFT JOIN task_status tstatus ON tstatus.id=tsk.task_status";
       $sub_query="";
if (isset($_GET["month"]) &&!empty($_GET["month"]) ) {
    $start_date=$_GET["month"].'-01';
    $motnh_year_name =date("F,Y",strtotime($start_date));
  $month =date("m",strtotime($start_date));
  $year = date("Y",strtotime($start_date));
    $sub_query=" WHERE tsk.start_date >= '$start_date' + INTERVAL 0 MONTH AND tsk.start_date < '$start_date' + INTERVAL 1 MONTH"; 
}
    else{
    	$month = date('m');
    	$year = date('Y');
      $motnh_year_name=date('F, Y');
}
// end of else
for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month)       
     $list_date[] = array(
            'start'=> str_replace('-', '/', date('m-d-Y', $time)).' '.'00:00:00',
            'end'=> str_replace('-', '/', date('m-d-Y', $time)).' '.'23:59:59',
            'label'=> date('d', $time)
    );
}
  $query .=$sub_query;
  // var_dump($query);
   if ($task_list=$db->select($query)) {
         while ($row_task_list=$task_list->fetch_assoc() ) {
$date_s=$row_task_list['start_date'];
$assigned_start_date = str_replace('-', '/', $date_s);
$date_e=$row_task_list['end_date'];
$assigned_end_date = str_replace('-', '/', $date_e);
             $task_n[] = array(
          'processid'=> $row_task_list['assigned_to'],
            'start'=> date('m/d/Y', strtotime($assigned_start_date)).' '.'00:00:00',
            'end'=> date('m/d/Y', strtotime($assigned_end_date)).' '.'23:59:59',
            'label'=> $row_task_list['name']
    );
         }
       }
  $task_j=array(
        "showlabels"=> "0",
        "task"=>$task_n
        );
  $list_date_k=array(
        "category"=>$list_date
        );

header('Content-type: application/json');
 $chartData = array("list_date" =>$list_date_k,
                  "task_n" =>$task_j,
                  "process_j" =>$process_j,
                  "motnh_year_name" =>$motnh_year_name
            );
echo json_encode($chartData);
?>
