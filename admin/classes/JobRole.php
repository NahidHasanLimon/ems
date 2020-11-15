<?php
 $filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 


class JobRole
{

 private $db;
 private $fm;

public function __construct()
   {
 $this->db = new Database();
 $this->fm = new Format();
   }
function all_noEndDateEmployee_details()
    
  {
     // $query= "SELECT * FROM department LEFT ORDER BY dep_id ";
     $query= "SELECT DISTINCT emp_job_role.emp_id,employee.first_name,employee.last_name FROM `emp_job_role` LEFT JOIN employee ON emp_job_role.emp_id = employee.emp_id WHERE end_date= '0000-00-00' ";

     $result=$this->db->select($query);
     return $result;
  }
  function all_notExistEmployee_details()
    
  {
     $query= "SELECT first_name,last_name,emp_id FROM employee WHERE NOT EXISTS (SELECT DISTINCT emp_id FROM emp_job_role WHERE employee.emp_id= emp_job_role.emp_id)";

     $result=$this->db->select($query);
     return $result;
  }
  function find_department_details($department_id)
    
  {
     $query= "SELECT d.dep_id,d.dep_name, c.comp_name FROM department as d
      LEFT JOIN company as c ON d.comp_id = c.comp_id
      WHERE d.dep_id='$department_id' ";
     $result=$this->db->select($query);
     return $result;
  }
  function find_SelectedCompanies_department_details($SelectedCompanyID)
    
  {
     $query= "SELECT d.dep_id,d.dep_name, c.comp_name,d.comp_id FROM department as d
      LEFT JOIN company as c ON d.comp_id = c.comp_id
      WHERE d.comp_id='$SelectedCompanyID'
      ORDER BY dep_id ";
     $result=$this->db->select($query);
     return $result;
  }

public function delete_department($department_id)
      {
       $query="DELETE FROM department WHERE dep_id='$department_id' ";
        $result = $this->db->delete($query);
        return $result;
      }
public function check_same_JobRole_exist_or_not_by_designation($employee_id,$designation_id)
  {
       $now = new DateTime();
        $CurrentDate= $now->format('Y/m/d');
        $query = "SELECT id FROM emp_job_role  WHERE emp_id = '$employee_id' AND des_id='$designation_id'";
        $results=$this->db->select($query);
        return $results;

   }
    public function check_same_JobRole_exist_or_not_by_designation_without_this($employee_id,$designation_id,$jobRoleID)
  {
       $now = new DateTime();
        $CurrentDate= $now->format('Y/m/d');
        $query = "SELECT id FROM emp_job_role  WHERE emp_id = '$employee_id' AND des_id='$designation_id' AND id!='$jobRoleID'";
        $results=$this->db->select($query);
        return $results;

   } 
    public function find_jobRole_details_byJobRoleID($jobRoleID)
   {
   $query= "SELECT r2.*,com.comp_name,emp.first_name,emp.last_name,emp.photo
    FROM (
    SELECT r1.*,dep.dep_name,dep.comp_id
    FROM (
    SELECT ejr.id as jobRoleID,ejr.emp_id,ejr.job_nature,ejr.start_date,ejr.end_date,ejr.salary,ejr.notes,ejr.des_id,des.des_name,des.dep_id
    FROM `emp_job_role`  ejr
    INNER JOIN designation des ON des.des_id=ejr.des_id
        ) r1
     INNER JOIN department dep ON r1.dep_id = dep.dep_id
        ) r2
        INNER JOIN company com ON r2.comp_id= com.comp_id
        INNER JOIN employee emp ON r2.emp_id=emp.emp_id
        WHERE r2.jobRoleID='$jobRoleID' ";
     $result=$this->db->select($query);
     return $result;
     exit();

   }

 public function add_employee_job_role($employee_id,$company_id,$department_id,$designation_id,$job_nature,$start_date,$salary,$notes)
  {

  

    if ($employee_id =="" || $designation_id=="" || $start_date=="" || $salary=="" || $job_nature=="" || $notes=="") {
      echo " Field Must Not be Empty";
      exit();
    }

   else
   {
    $checkSameJobRole= $this->check_same_JobRole_exist_or_not_by_designation($employee_id,$designation_id);
      if ($checkSameJobRole) {
            echo "Same Job allready exist";
            exit();
          }
   
            else{
        $insert_query="INSERT INTO emp_job_role
        (emp_id,des_id,job_nature,start_date,salary,notes) VALUES 
        ('$employee_id','$designation_id','$job_nature','$start_date','$salary','$notes')";

          $results=$this->db->insert($insert_query);
          if ($results) {
            return $results;

          exit();
          }
          else {
           echo "error";
           exit();
          }
    }
    // End of Inneer Else

   }
 // End of Else

   } 
    public function edit_employee_job_role($employee_id,$designation_id,$job_nature,$salary,$notes,$jobRoleID,$start_date,$end_date)
  {

  

    if ($employee_id =="" || $designation_id=="" || $salary=="" || $start_date=="") {
      echo " Field Must Not be Empty";
      exit();
    }

   else
   {
    $checkSameJobRole= $this->check_same_JobRole_exist_or_not_by_designation_without_this($employee_id,$designation_id,$jobRoleID);
      if ($checkSameJobRole) {
            echo "Same Job allready exist";
            exit();
          }
   
            else{
              if (empty($end_date) || $end_date=='0000-00-00') {
               $updateQuery="UPDATE  emp_job_role
           SET 
          salary='$salary',
          notes='$notes',
          des_id='$designation_id',
          job_nature='$job_nature',
          start_date='$start_date',
          end_date=null
          WHERE  id ='$jobRoleID'";
              }else{
                $updateQuery="UPDATE  emp_job_role
           SET 
          salary='$salary',
          notes='$notes',
          des_id='$designation_id',
          job_nature='$job_nature',
          start_date='$start_date',
          end_date='$end_date'
          WHERE  id ='$jobRoleID'";
              }
        
          $results=$this->db->update($updateQuery);
          if ($results) {
            // return $results;
            echo "success";

          exit();
          }
          else {
           echo "error";
           exit();
          }
    }
    // End of Inneer Else

   }
 // End of Else

   }

   public function end_job_role($endJobRoleID)
  {
     $now = new DateTime();
$CurrentDate= $now->format('Y/m/d');
        $query = "UPDATE emp_job_role SET end_date= '$CurrentDate' WHERE id = '$endJobRoleID'";
        $results=$this->db->update($query);
        if ($results) {
              echo "success";
              exit();
          }
          else{
            echo "error";
             exit();
          }

   } 
   

   public function promoteEmployee($employee_id,$job_role_id,$designation_id,$salary,$notes,$start_date,$job_nature)
  {
    if ($employee_id =="" || $job_role_id==""  || $designation_id =="" || $salary==""  || $start_date=="" ) {
      echo "Field Can not be empty";
    }
    else  {
      $now = new DateTime();
      $CurrentDate= $now->format('Y/m/d');
      $checkSameJobRole= $this->check_same_JobRole_exist_or_not_by_designation($employee_id,$designation_id);
      if ($checkSameJobRole) {
            echo "Same Job allready exist";
          }
        else{
      
        $queryInsert = "INSERT  INTO emp_job_role (emp_id,des_id,job_nature,start_date,salary,notes) VALUES 
        ('$employee_id','$designation_id','$job_nature','$start_date','$salary','$notes')";
        $results=$this->db->insert($queryInsert);
        if ($results) {
         $queryEndRole = "UPDATE emp_job_role SET end_date= '$CurrentDate' WHERE id = '$job_role_id'";
         $resultsEndRole=$this->db->update($queryEndRole);
         if ($resultsEndRole=$this->db->update($queryEndRole)) {
          echo "success";
          exit();
        }
        else{
          echo "failed to update";
          exit();
        }
        }else{
          echo "failed to insert";
          exit();
         }
        }
      }
   }
 
       public function update_department($department_id,$department_name,$comp_id)
      {

        if ($department_name =="") {
          echo " Name Field Must Not be Empty";

          exit();
        }

       else
       {
            $query="UPDATE department SET dep_name = '$department_name',comp_id='$comp_id' WHERE dep_id = '$department_id' ";
              $results=$this->db->update($query);
              if ($results) {
                  echo "Successfully Updated department";
                  exit();
              }

         }


   }



}



?>
