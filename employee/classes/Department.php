<?php
 $filepath = realpath(dirname(__FILE__));
	 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 


class Department
{

 private $db;
 private $fm;

public function __construct()
   {
 $this->db = new Database();
 $this->fm = new Format();



   }


function all_department_details()
    
  {
     // $query= "SELECT * FROM department LEFT ORDER BY dep_id ";
     $query= "SELECT * FROM department LEFT JOIN company ON department.comp_id = company.comp_id ORDER BY dep_id";

     $result=$this->db->select($query);
     return $result;
  }
  function find_department_details($department_id)
    
  {
     $query= "SELECT d.dep_id,d.dep_name,c.comp_id, c.comp_name FROM department as d
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
 public function add_department($departmentName,$comp_id)
  {

  

    if ($departmentName =="" || $comp_id =="") {
      echo " Field Must Not be Empty";

      exit();
    }

   else
   {
        $insert_query="INSERT INTO department(dep_name,comp_id) VALUES ('$departmentName','$comp_id')";

          $results=$this->db->insert($insert_query);
          if ($results) {
              echo "success";

          exit();
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
