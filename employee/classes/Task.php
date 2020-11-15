<?php
 $filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');
Session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 
class Task
{

 private $db;
 private $fm;

public function __construct()
   {

 $this->db = new Database();
 $this->fm = new Format();
   }
function all_task_details()  
  {
     $query= "SELECT tsk.*,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,pro.name as project_name,cl.name as client_name
       FROM `tasks` as tsk 
       LEFT JOIN employee emp1 ON emp1.emp_id=tsk.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=tsk.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=tsk.assigned_to
       LEFT JOIN projects pro ON pro.id=tsk.project_id
       LEFT JOIN clients cl ON cl.id=tsk.client_id
     ";
     $result=$this->db->select($query);
     return $result;
  }
  function all_up_coming_task_for_logged_employee()  
  {
  Session::init();
    $emp_id=Session::get("emp_id");
     $query= "SELECT tsk.*,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,pro.name as project_name,cl.name as client_name,tcategory.name as category_name
       FROM `tasks` as tsk 
       LEFT JOIN employee emp1 ON emp1.emp_id=tsk.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=tsk.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=tsk.assigned_to
       LEFT JOIN projects pro ON  pro.id=tsk.project_id  
       LEFT JOIN clients cl   ON  cl.id=tsk.client_id  
       LEFT JOIN task_categories tcategory   ON  tcategory.id=tsk.category_id  
       WHERE tsk.approved_status='0' AND tsk.assigned_to='$emp_id'
     ";
     $result=$this->db->select($query);
     return $result;
  }
  function all_task_list()  
  {
     $query= "SELECT * FROM projects ORDER BY id ";
     $result=$this->db->select($query);
     return $result;
  }
  function all_task_categories()  
  {
     $query= "SELECT * FROM task_categories ORDER BY id ";
     $result=$this->db->select($query);
     return $result;
  }
 function find_project_name($project_id)
  {
    $query= "SELECT name FROM projects pro  WHERE pro.id='$project_id'";
     $result=$this->db->select($query);
     return $result;
  }

   function find_task_details($task_id)
    
  {
    $query= "
       SELECT tsk.*,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,pro.name as project_name,cl.name as client_name,tcategory.name as task_category_name
       FROM `tasks` as tsk 
       LEFT JOIN employee emp1 ON emp1.emp_id=tsk.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=tsk.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=tsk.assigned_to
       LEFT JOIN projects pro ON pro.id=tsk.project_id
       LEFT JOIN clients cl ON cl.id=tsk.client_id
      LEFT JOIN task_categories tcategory ON tcategory.id=tsk.category_id
       WHERE tsk.id='$task_id' ";
  
     $result=$this->db->select($query);
     return $result;
  }  
  function find_task_history_details($task_id)  
  {
    $query= "
       SELECT * FROM `task_status_updated_history` WHERE task_id='$task_id'";
       $result=$this->db->select($query);
      return $result;
  }
 public function add_task()
  {
     Session::init();
    $emp_id=Session::get("emp_id");
    $loggedRole=Session::get("loggedRole");
    $t_name= $_POST['t_name'];
    $t_description= $this->fm->validation($_POST['t_description']);  
    $t_description=mysqli_real_escape_string($this->db->link,$t_description);

    $t_start_date= $this->fm->validation($_POST['t_start_date']);  
    $t_start_date=mysqli_real_escape_string($this->db->link,$t_start_date);
    $t_end_date= $this->fm->validation($_POST['t_end_date']);  
    $t_end_date=mysqli_real_escape_string($this->db->link,$t_end_date);

    $t_assigned_to= $this->fm->validation($_POST['t_assigned_to']);  
    $t_assigned_to=mysqli_real_escape_string($this->db->link,$t_assigned_to); 

    $t_category= $this->fm->validation($_POST['t_category']);  
    $t_category=mysqli_real_escape_string($this->db->link,$t_category);


    if (isset($_POST['tagProjectorNot']) ) {
      $t_selectProject= $this->fm->validation($_POST['t_selectProject']);  
      $t_selectProject=mysqli_real_escape_string($this->db->link,$t_selectProject);

      $project_name=$this->find_project_name($t_selectProject);
      $project_name=$project_name->fetch_assoc()['name'];

      $t_name= $t_name."-".$project_name; 

    }else{
      $t_selectProject=null;

    $t_concate_month_picker = $_POST['t_concate_month_picker'];
    $t_name= $t_name."-".$t_concate_month_picker; 
    }
    // tag client or not
     if ( isset($_POST['tagClientorNot']) ) {
      $t_selectClient= $this->fm->validation($_POST['t_selectClient']);  
      $t_selectClient=mysqli_real_escape_string($this->db->link,$t_selectClient);
    }else{
      $t_selectClient=null;
    }
// end tag client
  
    $t_name= $this->fm->validation($t_name);  
    $t_name=mysqli_real_escape_string($this->db->link,$t_name);

    if ($loggedRole==3) {
      $approved_status=1;
      $approved_by=$emp_id;
    }else{
      $approved_status=0;
      $approved_by=null;
    }

     $insert_query="INSERT INTO tasks(name,description,category_id,start_date,end_date,assigned_to,project_id,client_id,created_by,approved_status,approved_by) VALUES ('$t_name','$t_description','$t_category','$t_start_date','$t_end_date','$t_assigned_to','$t_selectProject','$t_selectClient','$emp_id','$approved_status','$approved_by')";
          $results=$this->db->insert($insert_query);
          if ($results) {
              return $results;
          exit();
          }
 
   }
   public function start_task($start_task_id)
  {
    Session::init();
    $start_date=date("Y-m-d");
    $emp_id=Session::get("emp_id");
    $loggedRole=Session::get("loggedRole");
    if ($start_task_id =="") {
      echo " Selected Task not be Empty";
    }
   else
   {
    $start_date= $this->fm->validation($start_date);  
    $start_date=mysqli_real_escape_string($this->db->link,$start_date);
  $query="UPDATE tasks SET actual_start_date = '$start_date' WHERE id = '$start_task_id' ";
       $results=$this->db->update($query);
          if ($results) {
             return $results;
          }   

     }


   }
public function approve_all_task($approve_all_task_ids){
    Session::init();
    $emp_id=Session::get("emp_id");
    if ($approve_all_task_ids =="") {
      echo " Name Field Must Not be Empty";
      exit();
    }
   else{
    $query="UPDATE tasks SET approved_status = '1',approved_by='$emp_id',approved_at=NOW()  WHERE id IN('".implode("','",$approve_all_task_ids)."')";
          $results=$this->db->update($query);
          if ($results) {
             return $results;
          }

     }


   }
   public function update_task_status($task_id,$task_status){
     Session::init();
    $emp_id=Session::get("emp_id");
    $task_id= $this->fm->validation($task_id);  
    $task_id=mysqli_real_escape_string($this->db->link,$task_id);    
    $task_status= $this->fm->validation($task_status);  
    $task_status=mysqli_real_escape_string($this->db->link,$task_status);
    $query="UPDATE tasks SET task_status = '$task_status' WHERE id='$task_id'";
      $results=$this->db->update($query);
      if ($results) {
         $statusTrackquery="INSERT INTO task_status_updated_history(task_id,status_id,updated_by) VALUES ('$task_id','$task_status','$emp_id')";
          $results=$this->db->insert($statusTrackquery);
         return $results;
      }
   }
  public function end_task($task_id){
    $task_id= $this->fm->validation($task_id);  
    $task_id=mysqli_real_escape_string($this->db->link,$task_id);
    $actual_end_date=date("Y-m-d");
    $actual_end_date=mysqli_real_escape_string($this->db->link,$actual_end_date);  
    $query="UPDATE tasks SET actual_end_date = '$actual_end_date',task_status='0' WHERE id='$task_id'";
          $results=$this->db->update($query);
          if ($results) {
             return $results;
          }
   }



}



?>
