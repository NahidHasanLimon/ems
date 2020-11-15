<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');
Session::init();
if ($_SESSION['adminLogin']!=true){
Session::init();
}
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
 public function add_task()
  {
    //   Session::init();
    $emp_id=Session::get("emp_id");
    // $emp_id=$_POST['emp_id'];
    $loggedRole=Session::get("loggedRole");
    // $loggedRole=3;
    
    // var_dump($_SESSION);
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

     $insert_query="INSERT INTO tasks(name,description,category_id,start_date,end_date,assigned_to,project_id,client_id,created_by,approved_status,approved_by,approved_at) VALUES ('$t_name','$t_description','$t_category','$t_start_date','$t_end_date','$t_assigned_to','$t_selectProject','$t_selectClient','$emp_id','$approved_status','$approved_by',NOW())";
          $results=$this->db->insert($insert_query);
          if ($results) {
              return $results;
          exit();
          }
 
   }

function all_project_category_details()
    
  {
     $query= "SELECT * FROM project_categories ORDER BY id ";
     $result=$this->db->select($query);
     return $result;
  }

public function delete_task($del_task_id)
      {
       $query="DELETE FROM tasks WHERE id='$del_task_id' ";
        $result = $this->db->delete($query);
        return $result;
      }
public function delete_task_category($del_task_cat_id)
      {
       $query="DELETE FROM task_categories WHERE id='$del_task_cat_id' ";
        $result = $this->db->delete($query);
        return $result;
      }
  public function update_task_category($update_task_cat_id,$task_cat_name,$task_cat_description)
      {
  $task_cat_name= $this->fm->validation($task_cat_name);  
$task_cat_name=mysqli_real_escape_string($this->db->link,$task_cat_name);
$task_cat_description= $this->fm->validation($task_cat_description);  
$task_cat_description=mysqli_real_escape_string($this->db->link,$task_cat_description);
      $query="UPDATE task_categories SET name = '$task_cat_name',description='$task_cat_description' WHERE id = '$update_task_cat_id' ";
        $result = $this->db->update($query);
        return $result;
      }
      
  public function add_task_category($task_cat_name,$task_cat_description)
  {
 $task_cat_name= $this->fm->validation($task_cat_name);  
$task_cat_name=mysqli_real_escape_string($this->db->link,$task_cat_name);
 $task_cat_description= $this->fm->validation($task_cat_description);  
$task_cat_description=mysqli_real_escape_string($this->db->link,$task_cat_description);

    if ($task_cat_name =="") {
      echo " Field Must Not be Empty";
      exit();
    }
   else
   {
        $insert_query="INSERT INTO task_categories(name,description) VALUES ('$task_cat_name','$task_cat_description')";
          $results=$this->db->insert($insert_query);
          if ($results) {
              echo "success";
          exit();
          }
     }

   }

  public function add_project_category($project_cat_name,$project_cat_description)
  {
 $project_cat_name= $this->fm->validation($project_cat_name);  
$project_cat_name=mysqli_real_escape_string($this->db->link,$project_cat_name);
 $project_cat_description= $this->fm->validation($project_cat_description);  
$project_cat_description=mysqli_real_escape_string($this->db->link,$project_cat_description);

    if ($project_cat_name =="") {
      echo " Field Must Not be Empty";
      exit();
    }
   else
   {
        $insert_query="INSERT INTO project_categories(name,description) VALUES ('$project_cat_name','$project_cat_description')";
          $results=$this->db->insert($insert_query);
          if ($results) {
              echo "success";
          exit();
          }
     }

   }

   public function approve_task($approve_task_id)
  {
    // Session::init();
    $emp_id=Session::get("emp_id");
    $loggedRole=Session::get("loggedRole");

    if ($approve_task_id =="") {
      echo " Name Field Must Not be Empty";

      exit();
    }

   else
   {
    $approve_task_id= $this->fm->validation($approve_task_id);  
    $approve_task_id=mysqli_real_escape_string($this->db->link,$approve_task_id);
    $query="UPDATE tasks SET approved_status = '1',approved_by='$emp_id', approved_at=NOW()  WHERE id = '$approve_task_id' ";
     if ($loggedRole==3) {
       $results=$this->db->update($query);
          if ($results) {
             return $results;
          }
     }
          

     }


   }
public function approve_all_task($approve_all_task_ids){
    // Session::init();
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



}



?>
