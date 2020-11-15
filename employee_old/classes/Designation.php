<?php
 $filepath = realpath(dirname(__FILE__));
	 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 


class Designation
{

 private $db;
 private $fm;

public function __construct()
   {
 $this->db = new Database();
 $this->fm = new Format();



   }


function all_designation_details()
    
  {
     // $query= "SELECT * FROM department LEFT ORDER BY dep_id ";
     $query= "SELECT designation.des_id as des_id, designation.des_name as des_name,designation.dep_id as dep_id,department.dep_name as dep_name ,company.comp_id as comp_id, company.comp_name as comp_name FROM designation INNER JOIN department ON department.dep_id = designation.dep_id INNER JOIN company ON company.comp_id =department.comp_id";

     $result=$this->db->select($query);
     return $result;
  }
  function find_designation_details($designation_id)
    
  {
     $query= "SELECT designation.des_id,designation.des_name,department.dep_name,department.dep_id,company.comp_name,company.comp_id FROM designation INNER JOIN department ON department.dep_id = designation.dep_id INNER JOIN company ON company.comp_id =department.comp_id WHERE des_id='$designation_id'";
     $result=$this->db->select($query);
     return $result;
  }
  function find_SelectedDepartment_designation_details($SelectedDepartmentID)
    
  {
     $query= "SELECT dep.dep_id,dep.dep_name, des.des_name,des.des_id FROM designation as des 
     LEFT JOIN department as dep ON dep.dep_id = des.dep_id WHERE des.dep_id='$SelectedDepartmentID' ORDER BY des_id ";
     $result=$this->db->select($query);
     return $result;
  }

public function delete_designation($designation_id)
      {
       $query="DELETE FROM designation WHERE des_id='$designation_id' ";
        $result = $this->db->delete($query);
        return $result;
      }
 public function add_designation($designationName,$dep_id)
  {

  

    if ($designationName =="" || $dep_id =="") {
      echo " Field Must Not be Empty";

      exit();
    }

   else
   {
        $insert_query="INSERT INTO designation(des_name,dep_id) VALUES ('$designationName','$dep_id')";

          $results=$this->db->insert($insert_query);
          if ($results) {
              echo "success";

          exit();
          }

     }


   }
   public function update_designation($designation_id,$designationName,$department_id)
  {
// echo $designation_id;
//           echo $designationName;
//           echo $department_id;
    if ($designationName =="" || $department_id ==""|| $designation_id=="") {
      echo " Name Field Must Not be Empty";
      exit();
    }

   else
   {
        $query="UPDATE designation SET des_name = '$designationName',dep_id='$department_id' WHERE des_id = '$designation_id' ";
          $results=$this->db->update($query);
          if ($results) {
              echo "Successfully Updated designation";
              exit();
          }

     }


   }



}



?>
