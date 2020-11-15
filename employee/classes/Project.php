<?php
 $filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');
Session::init();
if ($_SESSION['adminLogin']!=true){
Session::init();
}

include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 


class Project
{

 private $db;
 private $fm;

public function __construct()
   {
 $this->db = new Database();
 $this->fm = new Format();
   }


function all_client_details()
    
  {
     $query= "SELECT * FROM clients ORDER BY id ";
     $result=$this->db->select($query);
     return $result;
  }
function project_completion_status()
    
  {
     $query= "SELECT * FROM project_status ORDER BY id ";
     $result=$this->db->select($query);
     return $result;
  }
  public function project_status_track($project_id)
  {
    $project_id= $this->fm->validation($_POST['project_id']);  
    $project_id=mysqli_real_escape_string($this->db->link,$project_id);
     $query= "
     SELECT project_id,status_id,updated_by,updated_at,concat( emp.first_name,' ',emp.last_name) as updated_by_name,p_status.status as project_status 
    FROM `project_status_updated_history` p_s_history
    LEFT JOIN employee as emp ON p_S_history.updated_by=emp.emp_id
    LEFT JOIN project_status as p_status ON p_S_history.status_id=p_status.id
    WHERE p_s_history.project_id='$project_id'";
     $result=$this->db->select($query);
     return $result;
  }
  function all_project_details()
    
  {
     $query= "SELECT pro.*,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,pro_cat.name as project_cat_name,cl.name as client_name
       FROM `projects` as pro 
       LEFT JOIN employee emp1 ON emp1.emp_id=pro.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=pro.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=pro.assigned_to
       LEFT JOIN project_categories pro_cat ON  pro_cat.id=pro.category_id  
       LEFT JOIN clients cl ON  cl.id=pro.client_id ";
     $result=$this->db->select($query);
     return $result;
  }
  function all_project_list()
    
  {
     $query= "SELECT * FROM projects ORDER BY id ";
     $result=$this->db->select($query);
     return $result;
  }
  // function find_project_details($project_id)
    
  // {
  //    $query= "SELECT * FROM projects WHERE id='$project_id'  ";
  //    $result=$this->db->select($query);
  //    return $result;
  // } 
  function find_project_details($project_id)
    
  {
     $query= "
         SELECT pro.*,cl.name as client_name, approved_by.approved_by_name as approved_by_name,created_by.created_by_name as created_by_name,pc.name as project_category_name,(pro.revenue - pro.expense) as income,assigned_to.assigned_to_name as assigned_to_name,p_status.status as status
          FROM projects pro
        LEFT JOIN clients cl ON cl.id=pro.client_id
        LEFT JOIN project_status p_status ON p_status.id=pro.project_status
        LEFT JOIN project_categories pc ON pc.id=pro.category_id
        LEFT JOIN ( 
        select 
         CONCAT(emp2.first_name,' ',emp2.last_name)as approved_by_name,emp2.emp_id
        FROM employee as emp2
        ) as approved_by
        ON approved_by.emp_id = pro.approved_by
        LEFT JOIN ( 
        select 
         CONCAT(emp3.first_name,' ',emp3.last_name)as created_by_name ,emp3.emp_id
        FROM employee as emp3
        ) as created_by 
         ON created_by.emp_id = pro.created_by
        LEFT JOIN ( 
        select 
         CONCAT(emp4.first_name,' ',emp4.last_name)as assigned_to_name ,emp4.emp_id
        FROM employee as emp4
        ) as assigned_to
        ON assigned_to.emp_id = pro.assigned_to
        WHERE pro.id='$project_id'";
     $result=$this->db->select($query);
     return $result;
  }
  function all_un_approved_project_details()
    
  {

     $query= "
      SELECT pro.*, emp1.first_name as approved_by_name, emp2.first_name as created_by_name FROM `projects` as pro
      LEFT JOIN clients cl ON cl.id=pro.client_id
      LEFT JOIN employee emp1 ON emp1.emp_id=pro.`approved_by`
      LEFT JOIN employee emp2 ON emp2.emp_id=pro.`created_by`
      WHERE pro.approved_status='0'";
     $result=$this->db->select($query);
     return $result;
  }
 public function add_project()
  {
    //  Session::init();
    // start_session();
    $emp_id=Session::get("emp_id");
    $loggedRole=Session::get("loggedRole");

    $p_concate_month_picker= $_POST['p_concate_month_picker'];
    $p_name_plain= $_POST['p_name'];

    $p_name= $p_name_plain."-".$p_concate_month_picker; 

    $p_name= $this->fm->validation($p_name);  
    $p_name=mysqli_real_escape_string($this->db->link,$p_name);

    $p_description= $this->fm->validation($_POST['p_description']);  
    $p_description=mysqli_real_escape_string($this->db->link,$p_description);

    $p_start_date= $this->fm->validation($_POST['p_start_date']);  
    $p_start_date=mysqli_real_escape_string($this->db->link,$p_start_date);
    $p_end_date= $this->fm->validation($_POST['p_end_date']);  
    $p_end_date=mysqli_real_escape_string($this->db->link,$p_end_date);

    $p_budget= $this->fm->validation($_POST['p_budget']);  
    $p_budget=mysqli_real_escape_string($this->db->link,$p_budget);

    $p_category= $this->fm->validation($_POST['p_category']);  
    $p_category=mysqli_real_escape_string($this->db->link,$p_category);

    $p_assigned_to= $this->fm->validation($_POST['p_assigned_to']);  
    $p_assigned_to=mysqli_real_escape_string($this->db->link,$p_assigned_to); 

    $p_completion_status= $this->fm->validation($_POST['p_completion_status']);  
    $p_completion_status=mysqli_real_escape_string($this->db->link,$p_completion_status);

    if ( isset($_POST['tagClientorNot']) ) {
      $p_selectClient= $this->fm->validation($_POST['p_selectClient']);  
      $p_selectClient=mysqli_real_escape_string($this->db->link,$p_selectClient);
    }else{
      $p_selectClient=null;
    }

    if ($loggedRole==3) {
      $approved_status=1;
      $approved_by=$emp_id;
    }else{
      $approved_status=0;
      $approved_by=null;
    }

     $insert_query="INSERT INTO projects(name,description,category_id,assigned_to,start_date,end_date,expense,client_id,created_by,approved_status,project_status,approved_by) VALUES ('$p_name','$p_description','$p_category','$p_assigned_to','$p_start_date','$p_end_date','$p_budget','$p_selectClient','$emp_id','$approved_status','$p_completion_status','$approved_by')";
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

public function delete_project_category($del_project_cat_id)
      {
       $query="DELETE FROM project_categories WHERE id='$del_project_cat_id' ";
        $result = $this->db->delete($query);
        return $result;
      }
  public function delete_project($del_project_id)
      {
       $query="DELETE FROM projects WHERE id='$del_project_id' ";
        $result = $this->db->delete($query);
        return $result;
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
   public function update_project_category($update_project_cat_id,$project_cat_name,$project_cat_description)
  {
 $update_project_cat_id= $this->fm->validation($update_project_cat_id);  
$update_project_cat_id=mysqli_real_escape_string($this->db->link,$update_project_cat_id); 

$project_cat_name= $this->fm->validation($project_cat_name);  
$project_cat_name=mysqli_real_escape_string($this->db->link,$project_cat_name);
 $project_cat_description= $this->fm->validation($project_cat_description);  
$project_cat_description=mysqli_real_escape_string($this->db->link,$project_cat_description);
$query="UPDATE project_categories SET name = '$project_cat_name',description='$project_cat_description'  WHERE id ='$update_project_cat_id' ";
          $results=$this->db->update($query);
          if ($results) {
             return $results;
          }



   }

   public function approve_project($approve_project_id)
  {
    Session::init();
    $emp_id=Session::get("emp_id");

    if ($approve_project_id =="") {
      echo " Name Field Must Not be Empty";

      exit();
    }
   else
   {
    $approve_project_id= $this->fm->validation($approve_project_id);  
    $approve_project_id=mysqli_real_escape_string($this->db->link,$approve_project_id);
    $query="UPDATE projects SET approved_status = '1',approved_by='$emp_id'  WHERE id = '$approve_project_id' ";
          $results=$this->db->update($query);
          if ($results) {
             return $results;
          }

     }
   }  
  public function start_project($start_project_id)
  {
  if ($start_project_id =="") {
      echo "empty";
      exit();
    }
   else
   {
    $start_date=date("Y-m-d");
    $start_date= $this->fm->validation($start_date);
    $start_date=mysqli_real_escape_string($this->db->link,$start_date);
    $start_project_id= $this->fm->validation($start_project_id);
    $start_project_id=mysqli_real_escape_string($this->db->link,$start_project_id);
    $query="UPDATE projects SET actual_start_date = '$start_date'  WHERE id = '$start_project_id' ";
          $results=$this->db->update($query);
          if ($results) {
             return $results;
          }

     }
   }
   public function end_project($end_project_id)
  {
  if ($end_project_id =="") {
      echo "empty";
      exit();
    }
   else
   {
    $end_date=date("Y-m-d");
    $end_date= $this->fm->validation($end_date);
    $end_date=mysqli_real_escape_string($this->db->link,$end_date);
    $end_project_id= $this->fm->validation($end_project_id);
    $end_project_id=mysqli_real_escape_string($this->db->link,$end_project_id);
    $query="UPDATE projects SET request_for_end = '1'  WHERE id = '$end_project_id' ";
          $results=$this->db->update($query);
          if ($results) {
             return $results;
          }

     }
   }
public function update_project_status($statusChangeProject_id,$selectedTaskStatus){
     // Session::init();
    $emp_id=Session::get("emp_id");
    $statusChangeProject_id= $this->fm->validation($statusChangeProject_id);  
    $statusChangeProject_id=mysqli_real_escape_string($this->db->link,$statusChangeProject_id);    
    $selectedTaskStatus= $this->fm->validation($selectedTaskStatus);  
    $selectedTaskStatus=mysqli_real_escape_string($this->db->link,$selectedTaskStatus);
    $query="UPDATE projects SET project_status = '$selectedTaskStatus' WHERE id='$statusChangeProject_id'";
      $results=$this->db->update($query);
      if ($results) {
         $statusTrackquery="INSERT INTO project_status_updated_history(project_id,status_id,updated_by) VALUES ('$statusChangeProject_id','$selectedTaskStatus','$emp_id')";
          $results=$this->db->insert($statusTrackquery);
         return $results;
      }
   }
public function approve_all_project($approve_all_project_ids) {
    Session::init();
    $emp_id=Session::get("emp_id");
    if ($approve_all_project_ids =="") {
      echo " Name Field Must Not be Empty";

      exit();
    }

   else
   {
    $query="UPDATE projects SET approved_status = '1',approved_by='$emp_id'  WHERE id IN('".implode("','",$approve_all_project_ids)."')";
          $results=$this->db->update($query);
          if ($results) {
             return $results;
          }

     }


   }



}



?>
