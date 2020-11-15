<?php
 $filepath = realpath(dirname(__FILE__));
	 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 
class Attendance
{

 private $db;
 private $fm;

public function __construct()
   {
 $this->db = new Database();
 $this->fm = new Format();
   }
public function find_single_attendance($employee_id,$at_date)
   {
   $query= "SELECT * FROM emp_attendance  WHERE emp_id='$employee_id' AND at_date='$at_date' ";
     $result=$this->db->select($query);
     return $result;
   }
  public function check_attendance_exist_in($employee_id,$at_date)
   {
   $query= "SELECT * FROM emp_attendance  WHERE emp_id='$employee_id' AND at_date='$at_date' ";
     $result=$this->db->select($query);
     return $result;
   } 
   public function check_meeting_attendance_exist_in($employee_id,$at_date)
   {
   $query= "SELECT * FROM meeting_attendance  WHERE emp_id='$employee_id' AND meeting_date='$at_date' ";
     $result=$this->db->select($query);
     return $result;
   }
    public function find_meeting_placeholder()
   {
   $query= "SELECT * FROM employee WHERE meeting_status='1'";
     $result=$this->db->select($query);
     return $result;
   }

    public function add_daily_meeting_attendance($post,$atDate)
  {
    $count_exist=0;
    $insert_success=0;
    // Find meeting Placeholder
    $meeting_placeholder= $this->find_meeting_placeholder();
    if ($meeting_placeholder) {
     while ($row=mysqli_fetch_array($meeting_placeholder)) {
       $placeholder_ids[]=$row['emp_id'];
     }
    }
     
     //end of  Find meeting Placeholder
     $countEmployee=count($post['employeeID']);
    for ($j=0; $j<$countEmployee; $j++) {
      if (in_array($post['employeeID'][$j], $placeholder_ids)) {
     $employeeID = $post['employeeID'][$j];
     $check_meeting_attendance_exist_in= $this->check_meeting_attendance_exist_in($employeeID,$atDate);
    if ($check_meeting_attendance_exist_in) {
      $count_exist++;
    }
        }
     }
     // end of for j loop
     if ($count_exist<=0){
      for ($i=0; $i<$countEmployee; $i++) {
         if (in_array($post['employeeID'][$i], $placeholder_ids)) {
         $employeeID = $post['employeeID'][$i];
         $meetingStatusTypeSelect = $post['meetingStatusTypeSelect'][$i];
         $meetingNotes = $post['meetingNotes'][$i];
         $insert_query="INSERT INTO meeting_attendance (emp_id,status,meeting_date,notes) VALUES ('$employeeID','$meetingStatusTypeSelect','$atDate','$meetingNotes')";
        $result=$this->db->insert($insert_query);
        $insert_success++;
      }
      // end of in array
      }
      // end of i loop
     }
     // end of if count_exist<=0 conditon

     if($count_exist>0){
        echo "exist";
    }
    if ($insert_success>0) {
      echo "success";
    }
    
  }
 public function add_daily_attendance($post,$atDate)
  { 
    
    $count_exist=0;
    $count_insert_result=0;
    $checkQueryAttendance="SELECT * FROM temp_emp_attendance WHERE at_date='$atDate'";
    $checkResultAttendance=$this->db->select($checkQueryAttendance);
     if($checkResultAttendance!=false)
     {
      echo "exist";
      exit();
     }
     else {
    $countEmployee=count($post['employeeID']);
    for ($j=0; $j <$countEmployee ; $j++) { 
    $employeeID = $post['employeeID'][$j];
    $check_attendance_exist_in= $this->check_attendance_exist_in($employeeID,$atDate);
    if ($check_attendance_exist_in) {
      $count_exist++;
    }

    }
    // end of j loop(Exist Check) 
    
    if ($count_exist<=0){
for ($i=0; $i< $countEmployee; $i++) {
    $employeeID = $post['employeeID'][$i];    
    $statusTypeSelect = $post['statusTypeSelect'][$i];
    $notes = $post['notes'][$i];
    if ($post['timePickerIn'][$i]=='' && $post['timePickerOut'][$i]=='') {
      $insert_query="INSERT INTO temp_emp_attendance (emp_id,status,at_date,notes) VALUES ('$employeeID','$statusTypeSelect','$atDate','$notes')";
    }
    else{
      // print_r("NOt Null");
      $insert_query="INSERT INTO temp_emp_attendance (emp_id,c_in,c_out,status,at_date,notes) VALUES ('$employeeID', '{$post['timePickerIn'][$i]}','{$post['timePickerOut'][$i]}','$statusTypeSelect','$atDate','$notes')";
    }
    if ($this->db->insert($insert_query)) {
      $count_insert_result++;
    }
      
  }
  // end of i loop (insert )
}
// end existCheck if

// else{
  if($count_exist>0) {
  echo "exist";

}else if ($count_insert_result>0) {
  echo "success";
}
    else{
      echo "error";
    }
} 
// }

   } 
    public function add_daily_both_attendance($post,$atDate)
  { 
    $add_daily_meeting_attendance= $this->add_daily_meeting_attendance($post,$atDate);
    $add_daily_attendance= $this->add_daily_attendance($post,$atDate);

  }

   public function add_single_attendance($post,$atDate)
  {
    $employeeID = $post['selectEmployee'];
    $statusTypeSelect= $post['statusTypeSelect'];
    $timePickerIn = $post['timePickerIn'];
    $timePickerOut = $post['timePickerOut'];
    $notes = $post['notes'];
    $checkQueryAttendance="SELECT * FROM temp_emp_attendance WHERE at_date='$atDate' and emp_id='$employeeID'";
    $checkResultAttendance=$this->db->select($checkQueryAttendance);
     if($checkResultAttendance!=false)
     {
      echo "exist";
      exit();
     }
     else {  
       //  $insert_query="INSERT INTO temp_emp_attendance (emp_id,status,at_date,notes)
       // SELECT '$employeeID','$statusTypeSelect','$atDate','$notes'
       // FROM emp_attendance
       // WHERE NOT EXISTS (
       //  SELECT at_date,emp_id FROM emp_attendance 
       //  WHERE at_date = '$atDate' AND emp_id='$employeeID') ";
    if ($timePickerIn=='' && $timePickerOut=='') {
      $insert_query="INSERT INTO temp_emp_attendance (emp_id,status,at_date,notes)
       values('$employeeID','$statusTypeSelect','$atDate','$notes')";
          }
    else{
      // print_r("NOt Null");
      $insert_query="INSERT INTO temp_emp_attendance (emp_id,c_in,c_out,status,at_date,notes) VALUES ('$employeeID','$timePickerIn','$timePickerOut','$statusTypeSelect','$atDate','$notes')";
    }
    $results=$this->db->insert($insert_query);
   if ($results) {
     echo "success";
    }
    else{
      echo "error";
    }
}
   } 
    public function update_single_attendance($post)
  {
    // var_dump($post);

    $at_date=$post['datepicker'];
    $timePickerIn=$post['timePickerIn'];
    $timePickerOut=$post['timePickerOut'];
    $statusTypeSelect=$post['statusTypeSelect'];
    $notes=$post['notes'];
    $employee_id=$post['selectEmployee'];
    if (empty($post['timePickerIn'])|| $post['timePickerIn']=='00:00:00') {
      $timePickerIn=NULL;
      $update_query="UPDATE emp_attendance 
     SET c_out='$timePickerOut',status='$statusTypeSelect',notes='$notes'
    WHERE at_date='$at_date' AND emp_id= '$employee_id' ";
     $results=$this->db->update($update_query);
    }
    elseif (empty($post['timePickerOut'])|| $post['timePickerOut']=='00:00:00') {
      $timePickerOut=NULL;
      $update_query="UPDATE emp_attendance 
     SET 
    c_in='$timePickerIn'status='$statusTypeSelect',notes='$notes'
    WHERE at_date='$at_date' AND emp_id= '$employee_id' ";
     $results=$this->db->update($update_query);
    }else{
      $update_query="UPDATE emp_attendance 
     SET 
    c_in='$timePickerIn',c_out='$timePickerOut',status='$statusTypeSelect',notes='$notes'
    WHERE at_date='$at_date' AND emp_id= '$employee_id' ";
     $results=$this->db->update($update_query);
    }
    // var_dump($timePickerOut);

  
    
     if ($results) {
       echo "success";
     }else{
      echo "error";
     }


}
   public function updateAttendanceBy_3($post)
  {

$countEmployee=count($post['employeeID']);


for ($i=0; $i< $countEmployee; $i++) {
    $employeeID = $post['employeeID'][$i];
    $timePickerIn = $post['timePickerIn'][$i];
    $timePickerOut = $post['timePickerOut'][$i];
    $statusTypeSelect = $post['statusTypeSelect'][$i];
    $notes = $post['notes'][$i];
    $at_date  = $post['attendanceDate'][$i];

  if ($post['timePickerIn'][$i]=='' && $post['timePickerOut'][$i]=='') {
     $update_query="UPDATE temp_emp_attendance 
    SET 
     c_in= Null,
     c_out= Null,
       status='$statusTypeSelect',notes='$notes'
    WHERE at_date='$at_date' AND emp_id= '$employeeID' ";
    }
    else{
      $update_query="UPDATE temp_emp_attendance 
    SET 
    c_in='{$post['timePickerIn'][$i]}',c_out='{$post['timePickerOut'][$i]}',status='$statusTypeSelect',notes='$notes'
    WHERE at_date='$at_date' AND emp_id= '$employeeID' ";
    }
    $results=$this->db->update($update_query);
  } 
  return $results;
  exit();
   }
   public function updateMeetingAttendanceBy_3($post)
  {

$countEmployee=count($post['employeeID']);

for ($i=0; $i< $countEmployee; $i++) {
    $employeeID = $post['employeeID'][$i];
    $statusTypeSelect = $post['meetingStatusTypeSelect'][$i];
    $notes = $post['meetingNotes'][$i];
    $at_date  = $post['attendanceDate'][$i];
    $tempMeetingID  = $post['tempMeetingID'][$i];
    if (!empty($tempMeetingID)){
    $update_query="UPDATE meeting_attendance 
    SET 
    status='$statusTypeSelect',notes='$notes'
    WHERE id='$tempMeetingID'";
    $results=$this->db->update($update_query);
    }
    
  } 
  return $results;
  exit();
   }
    public function approveMeetingAttendanceBy_3($post)
  {

$countEmployee=count($post['employeeID']);
for ($i=0; $i< $countEmployee; $i++) {
    $employeeID = $post['employeeID'][$i];
    $statusTypeSelect = $post['meetingStatusTypeSelect'][$i];
    $notes = $post['meetingNotes'][$i];
    $at_date  = $post['attendanceDate'][$i];
    $tempMeetingID  = $post['tempMeetingID'][$i];
    if (!empty($tempMeetingID)){
    $update_query="UPDATE meeting_attendance 
    SET 
    approved='1'
    WHERE id='$tempMeetingID'";
    $results=$this->db->update($update_query);
    }
    
  } 
  return $results;
  exit();
   }

    public function approvedAttendanceBy_3($post)
  {

$countEmployee=count($post['employeeID']);

$singleAtDate=$post['attendanceDate'][0];

for ($i=0; $i< $countEmployee; $i++) {
    $employeeID = $post['employeeID'][$i];
    $statusTypeSelect = $post['statusTypeSelect'][$i];
    $notes = $post['notes'][$i];
    $at_date  = $post['attendanceDate'][$i];
    $tempID  = $post['tempID'][$i];

if ($post['timePickerIn'][$i]=='' && $post['timePickerOut'][$i]=='') {
     $update_query="UPDATE temp_emp_attendance 
    SET 
     c_in= Null,
     c_out= Null,
     status='$statusTypeSelect',notes='$notes',approved_3='1'
    WHERE id='$tempID' ";
     $insert_query="INSERT INTO emp_attendance (emp_id,status,at_date,notes,approved) VALUES ('$employeeID','$statusTypeSelect','$at_date','$notes','1')";
    }
    else{
   $update_query="UPDATE temp_emp_attendance 
    SET 
    c_in='{$post['timePickerIn'][$i]}',c_out='{$post['timePickerOut'][$i]}',status='$statusTypeSelect',notes='$notes',approved_3='1'
    WHERE id='$tempID' ";
     // $insert_query="
     // INSERT INTO emp_attendance (emp_id,c_in,c_out,status,at_date) VALUES 
     // ('$employeeID','{$post['timePickerIn'][$i]}','{$post['timePickerOut'][$i]}',$statusTypeSelect','$at_date')";
       $insert_query="INSERT INTO emp_attendance (emp_id,c_in,c_out,status,at_date,notes,approved) VALUES ('$employeeID','{$post['timePickerIn'][$i]}','{$post['timePickerOut'][$i]}','$statusTypeSelect','$at_date','$notes','1')";
    }

    $results=$this->db->update($update_query);
    $results2=$this->db->insert($insert_query);

  } 


  return true;
  exit();



   }
 

   // }
 
   // Start or approval Role 2
 public function approvedAttendanceBy_2($post)
  {

$countEmployee=count($post['employeeID']);

$singleAtDate=$post['attendanceDate'][0];
for ($i=0; $i< $countEmployee; $i++) {
    $employeeID = $post['employeeID'][$i];
    // $timePickerIn = $post['timePickerIn'][$i];
    // $timePickerOut = $post['timePickerOut'][$i];
    $statusTypeSelect = $post['statusTypeSelect'][$i];
    $notes = $post['notes'][$i];
    $at_date  = $post['attendanceDate'][$i];
        $tempID  = $post['tempID'][$i];

    if ($post['timePickerIn'][$i]=='' && $post['timePickerOut'][$i]=='') {
     $update_query="
   UPDATE temp_emp_attendance 
    SET 
     c_in= Null,
     c_out= Null,
    status='$statusTypeSelect',notes='$notes',approved_2='1'
    WHERE id='$tempID' ";
    }
    else{
      // print_r("NOt Null");
   $update_query="
   UPDATE temp_emp_attendance 
    SET 
    c_in='{$post['timePickerIn'][$i]}',c_out='{$post['timePickerOut'][$i]}',status='$statusTypeSelect',notes='$notes',approved_2='1'
    WHERE id='$tempID' ";
    }
    $results=$this->db->update($update_query);
    
  } 
  if ($results) {
      echo "success";
    }
    else{
      echo "error";
    }
    
   }
   // End of Approval 2 Only Admin

   public function employe_monthWise_attendance_Report($startDate)
  {
     $date = new DateTime($startDate);
   $start_date=$date->modify('first day of this month')->format('Y-m-d');
   $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
   $query="SELECT fetch_at.emp_id , emp.first_name,emp.last_name ,emp.photo, fetch_at.Presents,fetch_at.Absents,fetch_at.CasualLeave,fetch_at.MeetingLate,fetch_at.SickLeave,fetch_at.Late,fetch_at.HalfDay,fetch_at.Total_Attendance_Days,fetch_at.Total_working_Days FROM 
employee as emp
INNER JOIN (
select 
emp_id, count(distinct at_date) as Total_Attendance_Days, 
    sum(case when status= 'p' then 1 else 0 end) Presents,
    sum(case when status = 'a' then 1 else 0 end) Absents, 
    sum(case when status = 'cl' then 1 else 0 end) CasualLeave, 
    sum(case when status = 'ml' then 1 else 0 end) MeetingLate,
     sum(case when status = 'l' then 1 else 0 end) Late,
     sum(case when status = 'hd' then 1 else 0 end) HalfDay,
     sum(case when status = 'sl' then 1 else 0 end) SickLeave,

    FORMAT( ( (sum(case when status = 'hd' then 1 else 0 end)/2) +
    (sum(case when status = 'l' then 1 else 0 end))+
    (sum(case when status = 'ml' then 1 else 0 end))+
     ( sum(case when status= 'p' then 1 else 0 end) ) ),1)
     Total_working_Days

  from emp_attendance tea
   WHERE tea.at_date >= '$start_date' + INTERVAL 0 MONTH AND tea.at_date < '$start_date' + INTERVAL 1 MONTH
    
    group by emp_id 
)  as fetch_at

ON fetch_at.emp_id= emp.emp_id
 WHERE emp.status='1'";
$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
    else {
      echo "Data Not Available";
    }



   }
   public function meeting_monthWise_attendance_Report($startDate)
  {
     $date = new DateTime($startDate);
   $start_date=$date->modify('first day of this month')->format('Y-m-d');
   $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
   $query="SELECT fetch_at.emp_id , emp.first_name,emp.last_name ,emp.photo, fetch_at.Presents,fetch_at.Absents,fetch_at.CasualLeave,fetch_at.MeetingLate,fetch_at.SickLeave,fetch_at.Late,fetch_at.Total_Attendance_Days,fetch_at.Total_Meeting_Days FROM 
employee as emp
INNER JOIN (
select 
emp_id, count(distinct meeting_date) as Total_Attendance_Days, 
    sum(case when status= 'p' then 1 else 0 end) Presents,
    sum(case when status = 'a' then 1 else 0 end) Absents, 
    sum(case when status = 'cl' then 1 else 0 end) CasualLeave, 
    sum(case when status = 'ml' then 1 else 0 end) MeetingLate,
     sum(case when status = 'l' then 1 else 0 end) Late,
     sum(case when status = 'sl' then 1 else 0 end) SickLeave,
    FORMAT( ( 
    (sum(case when status = 'l' then 1 else 0 end))+
    (sum(case when status = 'ml' then 1 else 0 end))+
     ( sum(case when status= 'p' then 1 else 0 end) ) ),1)
     Total_Meeting_Days

  from meeting_attendance ma
   WHERE ma.meeting_date >= '$start_date' + INTERVAL 0 MONTH AND ma.meeting_date < '$start_date' + INTERVAL 1 MONTH
    
    group by emp_id 
)  as fetch_at

ON fetch_at.emp_id= emp.emp_id
 WHERE emp.status='1' AND emp.meeting_status='1'";
$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
    else {
      echo "Data Not Available";
    }



   }
 public function monthly_emp_details_with_total_Salary($startDate)
  {
     $date = new DateTime($startDate);
   $start_date=$date->modify('first day of this month')->format('Y-m-d');
   $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
   $query="SELECT 
fetch_at.emp_id , emp.first_name,emp.last_name ,emp.photo, fetch_at.Presents,fetch_at.Absents,fetch_at.CasualLeave,fetch_at.MeetingLate,fetch_at.SickLeave,fetch_at.Late,fetch_at.HalfDay,fetch_at.Total_Attendance_Days,fetch_at.Total_working_Days 
,jobrole.totalSalary
FROM 
employee as emp
INNER JOIN (
select 
emp_id, count(distinct at_date) as Total_Attendance_Days, 
    sum(case when status= 'p' then 1 else 0 end) Presents,
    sum(case when status = 'a' then 1 else 0 end) Absents, 
    sum(case when status = 'cl' then 1 else 0 end) CasualLeave, 
    sum(case when status = 'ml' then 1 else 0 end) MeetingLate,
     sum(case when status = 'l' then 1 else 0 end) Late,
     sum(case when status = 'hd' then 1 else 0 end) HalfDay,
     sum(case when status = 'sl' then 1 else 0 end) SickLeave,

    FORMAT( ( (sum(case when status = 'hd' then 1 else 0 end)/2) +
    (sum(case when status = 'l' then 1 else 0 end))+
    (sum(case when status = 'ml' then 1 else 0 end))+
     ( sum(case when status= 'p' then 1 else 0 end) ) ),1)
     Total_working_Days

  from emp_attendance tea
   WHERE tea.at_date >= '$start_date' + INTERVAL 0 MONTH AND tea.at_date < '$start_date' + INTERVAL 1 MONTH
    
    group by emp_id 
)  as fetch_at

ON fetch_at.emp_id= emp.emp_id
INNER JOIN 
(
    SELECT 
COUNT(ejr.id) as totalJob ,
SUM(ejr.salary) as totalSalary , 
ejr.emp_id
FROM `emp_job_role` as ejr
WHERE ejr.end_date IS NULL
GROUP BY ejr.emp_id
) as jobrole 
ON jobrole.emp_id = fetch_at.emp_id

 ";
$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
    else {
      echo "Data Not Available";
    }



   }
    public function employe_monthly_attendance_sheet($startDate)
  {
$date = new DateTime($startDate);
   $start_date=$date->modify('first day of this month')->format('Y-m-d');
   $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
   $query="SELECT emp.emp_id, result.*,emp.first_name,emp.last_name,emp.photo
FROM
(
SELECT emp_id,
  GROUP_CONCAT(if(DAY(`at_date`) = 1, `status`, NULL)) AS 'day1',
  GROUP_CONCAT(if(DAY(`at_date`) = 2, `status`, NULL)) AS 'day2',
  GROUP_CONCAT(if(DAY(`at_date`) = 3, `status`, NULL)) AS 'day3', 
  GROUP_CONCAT(if(DAY(`at_date`) = 4, `status`, NULL)) AS 'day4', 
  GROUP_CONCAT(if(DAY(`at_date`) = 5, `status`, NULL)) AS 'day5', 
  GROUP_CONCAT(if(DAY(`at_date`) = 6, `status`, NULL)) AS 'day6', 
  GROUP_CONCAT(if(DAY(`at_date`) = 7, `status`, NULL)) AS 'day7', 
  GROUP_CONCAT(if(DAY(`at_date`) = 8, `status`, NULL)) AS 'day8', 
  GROUP_CONCAT(if(DAY(`at_date`) = 9, `status`, NULL)) AS 'day9', 
  GROUP_CONCAT(if(DAY(`at_date`) = 10, `status`, NULL)) AS 'day10',
  GROUP_CONCAT(if(DAY(`at_date`) = 11, `status`, NULL)) AS 'day11', 
  GROUP_CONCAT(if(DAY(`at_date`) = 12, `status`, NULL)) AS 'day12', 
  GROUP_CONCAT(if(DAY(`at_date`) = 13, `status`, NULL)) AS 'day13', 
  GROUP_CONCAT(if(DAY(`at_date`) = 14, `status`, NULL)) AS 'day14', 
  GROUP_CONCAT(if(DAY(`at_date`) = 15, `status`, NULL)) AS 'day15', 
  GROUP_CONCAT(if(DAY(`at_date`) = 16, `status`, NULL)) AS 'day16', 
  GROUP_CONCAT(if(DAY(`at_date`) = 17, `status`, NULL)) AS 'day17', 
  GROUP_CONCAT(if(DAY(`at_date`) = 18, `status`, NULL)) AS 'day18', 
  GROUP_CONCAT(if(DAY(`at_date`) = 19, `status`, NULL)) AS 'day19', 
  GROUP_CONCAT(if(DAY(`at_date`) = 20, `status`, NULL)) AS 'day20', 
  GROUP_CONCAT(if(DAY(`at_date`) = 21, `status`, NULL)) AS 'day21', 
  GROUP_CONCAT(if(DAY(`at_date`) = 22, `status`, NULL)) AS 'day22', 
  GROUP_CONCAT(if(DAY(`at_date`) = 23, `status`, NULL)) AS 'day23', 
  GROUP_CONCAT(if(DAY(`at_date`) = 24, `status`, NULL)) AS 'day24', 
  GROUP_CONCAT(if(DAY(`at_date`) = 25, `status`, NULL)) AS 'day25', 
  GROUP_CONCAT(if(DAY(`at_date`) = 26, `status`, NULL)) AS 'day26', 
  GROUP_CONCAT(if(DAY(`at_date`) = 27, `status`, NULL)) AS 'day27', 
  GROUP_CONCAT(if(DAY(`at_date`) = 28, `status`, NULL)) AS 'day28', 
  GROUP_CONCAT(if(DAY(`at_date`) = 29, `status`, NULL)) AS 'day29', 
  GROUP_CONCAT(if(DAY(`at_date`) = 30, `status`, NULL)) AS 'day30',  
  GROUP_CONCAT(if(DAY(`at_date`) = 31, `status`, NULL)) AS 'day31', 
  COUNT(if(`status`='P', `status`, NULL)) AS 'totalPresent',
  COUNT(if(`status`='a', `status`, NULL)) AS 'totalAbsent',
  COUNT(if(`status`='hd', `status`, NULL)) AS 'totalHalfDay',
  COUNT(if(`status`='l', `status`, NULL)) AS 'totalLate',
  COUNT(if(`status`='ml', `status`, NULL)) AS 'totalMeetingLate',
  COUNT(if(`status`='cl', `status`, NULL)) AS 'totalCasualLeave',
  COUNT(if(`status`='sl', `status`, NULL)) AS 'totalSickLeave'
FROM `emp_attendance`

WHERE  `at_date` BETWEEN '$start_date' AND '$end_date'
GROUP BY emp_id) result 
LEFT JOIN employee as emp ON result.emp_id=emp.emp_id";

$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
    else {
      echo "Data Not Available";
    }



   } 

   public function employe_weekly_attendance_sheet($startDate)
  {
$date = new DateTime($startDate);
   $start_date=$date->modify('first day of this month')->format('Y-m-d');
   $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
   $query="SELECT fetch_at.emp_id , emp.first_name,emp.last_name ,emp.photo, fetch_at.Presents,fetch_at.Absents,fetch_at.CasualLeave,fetch_at.MeetingLate,fetch_at.SickLeave,fetch_at.Late,fetch_at.HalfDay,fetch_at.Total_Attendance_Days FROM 
employee as emp
INNER JOIN (
select 
emp_id, count(distinct at_date) as Total_Attendance_Days, 
   sum(case when status= 'p' then 1 else 0 end) Presents,
    sum(case when status = 'a' then 1 else 0 end) Absents, 
    sum(case when status = 'hd' then 1 else 0 end) HalfDay,
    sum(case when status = 'l' then 1 else 0 end) Late,
    sum(case when status = 'ml' then 1 else 0 end) MeetingLate,
    sum(case when status = 'sl' then 1 else 0 end) SickLeave,
    sum(case when status = 'cl' then 1 else 0 end) CasualLeave
  from emp_attendance tea
   WHERE tea.at_date >= '$startDate' + INTERVAL 0 DAY AND tea.at_date < '$startDate' + INTERVAL 7 DAY
    
    group by emp_id 
)  as fetch_at

ON fetch_at.emp_id= emp.emp_id
 WHERE emp.status='1'";

$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
    else {
      echo "Data Not Available";
    }



   } 
   
   public function employee_dateRange_attendance_Report($startDate,$endDate)
  {
// $date = new DateTime($startDate);
//    $start_date=$date->modify('first day of this month')->format('Y-m-d');
//    $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
   $query="SELECT fetch_at.emp_id , emp.first_name,emp.last_name ,emp.photo, fetch_at.Presents,fetch_at.Absents,fetch_at.CasualLeave,fetch_at.MeetingLate,fetch_at.SickLeave,fetch_at.Late,fetch_at.HalfDay,fetch_at.Total_Attendance_Days FROM 
employee as emp
INNER JOIN (
select 
emp_id, count(distinct at_date) as Total_Attendance_Days, 
    sum(case when status= 'p' then 1 else 0 end) Presents,
    sum(case when status = 'a' then 1 else 0 end) Absents, 
    sum(case when status = 'hd' then 1 else 0 end) HalfDay,
    sum(case when status = 'l' then 1 else 0 end) Late,
    sum(case when status = 'ml' then 1 else 0 end) MeetingLate,
    sum(case when status = 'sl' then 1 else 0 end) SickLeave,
    sum(case when status = 'cl' then 1 else 0 end) CasualLeave
  from emp_attendance tea
   WHERE tea.at_date  >=  '$startDate'  and  tea.at_date <= '$endDate'
    
    group by emp_id 
)  as fetch_at

ON fetch_at.emp_id= emp.emp_id
 WHERE emp.status='1'";
$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
    // else {
    //   echo "Data Not Available";
    // }



   }
   public function employee_lastThirtyDays_attendance_Report($CurrentDate)
  {
// $date = new DateTime($startDate);
//    $start_date=$date->modify('first day of this month')->format('Y-m-d');
//    $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
   $query="SELECT emp.emp_id,emp.first_name,emp.last_name ,emp.photo,fetch_at.SickLeave,fetch_at.Presents,fetch_at.Absents,fetch_at.CasualLeave,fetch_at.MeetingLate,fetch_at.Late,fetch_at.HalfDay,fetch_at.Total_Attendance_Days FROM 
employee as emp
INNER JOIN (
select 
emp_id, count(distinct at_date) as Total_Attendance_Days, 
    sum(case when status= 'p' then 1 else 0 end) Presents,
    sum(case when status = 'a' then 1 else 0 end) Absents, 
    sum(case when status = 'hd' then 1 else 0 end) HalfDay,
    sum(case when status = 'l' then 1 else 0 end) Late,
    sum(case when status = 'ml' then 1 else 0 end) MeetingLate,
    sum(case when status = 'sl' then 1 else 0 end) SickLeave,
    sum(case when status = 'cl' then 1 else 0 end) CasualLeave
  from emp_attendance where at_date BETWEEN SUBDATE(CURDATE(), INTERVAL 1 MONTH) AND NOW()
    group by emp_id )  as fetch_at

ON fetch_at.emp_id= emp.emp_id";
$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
    // else {
    //   echo "Data Not Available";
    // }
   }

   public function employe_dailyWise_attendance_Report($startDate)
  {

   $query="SELECT TIMEDIFF(atn.c_out, atn.c_in) as workedHours, atn.notes,atn.emp_id,atn.status,atn.c_in,atn.c_out,atn.approved, emp.first_name,emp.last_name,emp.photo
        FROM emp_attendance atn 
        INNER JOIN employee emp 
        ON atn.emp_id = emp.emp_id
        WHERE at_date='$startDate'
        AND emp.status='1' ";
      $results=$this->db->select($query);
    if ($results) {
     return $results;
    }
    // else {
    //   echo "Data Not Available";
    // }



   }  
    public function unApproved_attendanceDate_role_3()
  {
   
   $query="SELECT DISTINCT at_date FROM `temp_emp_attendance` WHERE
        approved_3 = 0 ";
      $results=$this->db->select($query);
    if ($results) {
     return $results;
    }

   } 
    public function Count_unApproved_attendanceDate_role_3()
  {
   
   $query="SELECT COUNT( DISTINCT at_date) as count FROM `temp_emp_attendance` WHERE
        approved_3 = 0";
      $results=$this->db->select($query);
    if ($results) {
     return $results;
    }

   }  
   public function unApproved_attendanceDate_role_2()
  {
   
   $query="SELECT DISTINCT at_date FROM `temp_emp_attendance` WHERE
        approved_3 = 0 AND approved_2=0 ";
      $results=$this->db->select($query);
    if ($results) {
     return $results;
    }

   }

 public function role3_approval_data($startDate)
  {
    // $date = new DateTime($startDate);
   // $start_date=$date->modify('first day of this month')->format('Y-m-d');
   // $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
//   $query="SELECT tea.id as tempID,tea.at_date,tea.status,tea.notes,tea.approved_2,emp.emp_id,emp.first_name,emp.last_name,emp.photo,
//    tea.emp_id, tea.c_in,tea.c_out,emp.meeting_status
// FROM temp_emp_attendance as tea 
// INNER JOIN employee as emp ON emp.emp_id=tea.emp_id WHERE at_date = '$startDate' and approved_3=0";
  $query="SELECT tea.id as tempID,tea.at_date,tea.status,tea.notes,tea.approved_2,emp.emp_id,emp.first_name,emp.last_name,emp.photo,
   tea.emp_id, tea.c_in,tea.c_out,emp.meeting_status,ma.meeting_date,ma.status as meeting_at_status,ma.id as tempMeetingID
FROM temp_emp_attendance as tea
LEFT JOIN meeting_attendance as ma ON ma.emp_id=tea.emp_id AND ma.approved=0 AND ma.meeting_date='$startDate'
INNER JOIN employee as emp ON emp.emp_id=tea.emp_id WHERE tea.at_date = '$startDate' and tea.approved_3=0
ORDER BY CASE tea.status
    WHEN 'l' THEN 5
    WHEN 'ml' THEN 4
    WHEN 'a' THEN 3
    WHEN 'cl' THEN 2
    WHEN 'sl' THEN 1
    ELSE 0
END DESC, emp.emp_id ASC";

$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
    // else {
    //   echo "Data Not Available";
    // }



   }
   public function role2_approval_data($startDate)
  {
    // $date = new DateTime($startDate);
   // $start_date=$date->modify('first day of this month')->format('Y-m-d');
   // $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
  $query="SELECT tea.id as tempID ,tea.at_date,tea.status,tea.notes,tea.approved_2,emp.emp_id,emp.first_name,emp.last_name,emp.photo,
   tea.emp_id, tea.c_in,tea.c_out
FROM temp_emp_attendance as tea 
INNER JOIN employee as emp ON emp.emp_id=tea.emp_id WHERE at_date = '$startDate' and approved_2=0 AND approved_3 !=1";
$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
    // else {
    //   echo "Data Not Available";
    // }



   }  
   public function meeting_approval_data($startDate)
  {
  $query="SELECT * FROM meeting_attendance WHERE meeting_date='$startDate' AND approved=0";
 $results=$this->db->select($query);
    if ($results) {
     return $results;
    }
   }
    public function an_employee_everyDate_attendance($startDate,$employeeID)
  {
     $date = new DateTime($startDate);
    $start_date=$date->modify('first day of this month')->format('Y-m-d');
    $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
  $query="SELECT *
    FROM
  (
    SELECT a.Date AS mydate
    FROM (
           SELECT date(NOW()) - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS Date
           FROM (SELECT 0 AS a
                 UNION ALL SELECT 1
                 UNION ALL SELECT 2
                 UNION ALL SELECT 3
                 UNION ALL SELECT 4
                 UNION ALL SELECT 5
                 UNION ALL SELECT 6
                 UNION ALL SELECT 7
                 UNION ALL SELECT 8
                 UNION ALL SELECT 9) AS a
             CROSS JOIN (SELECT 0 AS a
                         UNION ALL SELECT 1
                         UNION ALL SELECT 2
                         UNION ALL SELECT 3
                         UNION ALL SELECT 4
                         UNION ALL SELECT 5
                         UNION ALL SELECT 6
                         UNION ALL SELECT 7
                         UNION ALL SELECT 8
                         UNION ALL SELECT 9) AS b
             CROSS JOIN (SELECT 0 AS a
                         UNION ALL SELECT 1
                         UNION ALL SELECT 2
                         UNION ALL SELECT 3
                         UNION ALL SELECT 4
                         UNION ALL SELECT 5
                         UNION ALL SELECT 6
                         UNION ALL SELECT 7
                         UNION ALL SELECT 8
                         UNION ALL SELECT 9) AS c
         ) a
    WHERE a.Date BETWEEN '$start_date' AND '$end_date'
  ) dates
  LEFT JOIN
  (
    SELECT status as status ,at_date,c_in,c_out
    FROM
      emp_attendance
    where emp_id='$employeeID'
  ) data
    ON DATE_FORMAT(dates.mydate, '%Y%m%d') = DATE_FORMAT(data.at_date, '%Y%m%d')
    ORDER BY myDate DESC";
$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
   }
 public function everyDate_meeting_attendance($startDate,$employeeID)
  {
     $date = new DateTime($startDate);
    $start_date=$date->modify('first day of this month')->format('Y-m-d');
    $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
  $query="SELECT *
    FROM
  (
    SELECT a.Date AS mydate
    FROM (
           SELECT date(NOW()) - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS Date
           FROM (SELECT 0 AS a
                 UNION ALL SELECT 1
                 UNION ALL SELECT 2
                 UNION ALL SELECT 3
                 UNION ALL SELECT 4
                 UNION ALL SELECT 5
                 UNION ALL SELECT 6
                 UNION ALL SELECT 7v
                 UNION ALL SELECT 8
                 UNION ALL SELECT 9) AS a
             CROSS JOIN (SELECT 0 AS a
                         UNION ALL SELECT 1
                         UNION ALL SELECT 2
                         UNION ALL SELECT 3
                         UNION ALL SELECT 4
                         UNION ALL SELECT 5
                         UNION ALL SELECT 6
                         UNION ALL SELECT 7
                         UNION ALL SELECT 8
                         UNION ALL SELECT 9) AS b
             CROSS JOIN (SELECT 0 AS a
                         UNION ALL SELECT 1
                         UNION ALL SELECT 2
                         UNION ALL SELECT 3
                         UNION ALL SELECT 4
                         UNION ALL SELECT 5
                         UNION ALL SELECT 6
                         UNION ALL SELECT 7
                         UNION ALL SELECT 8
                         UNION ALL SELECT 9) AS c
         ) a
    WHERE a.Date BETWEEN '$start_date' AND '$end_date'
  ) dates
  LEFT JOIN
  (
    SELECT status as status ,meeting_date
    FROM
      meeting_attendance
    where emp_id='$employeeID'
  ) data
    ON DATE_FORMAT(dates.mydate, '%Y%m%d') = DATE_FORMAT(data.meeting_date, '%Y%m%d')
    ORDER BY myDate DESC";
$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
   }


}



?>
