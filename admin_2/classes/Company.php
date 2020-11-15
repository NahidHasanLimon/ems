<?php
 $filepath = realpath(dirname(__FILE__));
	 include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 


class Company
{

 private $db;
 private $fm;

public function __construct()
   {
 $this->db = new Database();
 $this->fm = new Format();



   }


function all_company_details()
    
  {
     $query= "SELECT * FROM company ORDER BY comp_id ";
     $result=$this->db->select($query);
     return $result;
  }
  function find_company_details($company_id)
    
  {
     $query= "SELECT * FROM company WHERE comp_id='$company_id'  ";
     $result=$this->db->select($query);
     return $result;
  }

public function delete_company($company_id)
      {
       $query="DELETE FROM company WHERE comp_id='$company_id' ";
        $result = $this->db->delete($query);
        return $result;
      }
 public function add_company($companyName)
  {

  

    if ($companyName =="") {
      echo " Field Must Not be Empty";

      exit();
    }

   else
   {
        $insert_query="INSERT INTO company(comp_name) VALUES ('$companyName')";

          $results=$this->db->insert($insert_query);
          if ($results) {
              echo "success";

          exit();
          }

     }


   }
   public function update_company($company_id,$company_name)
  {

    if ($company_name =="") {
      echo " Name Field Must Not be Empty";

      exit();
    }

   else
   {
        $query="UPDATE company SET comp_name = '$company_name' WHERE comp_id = '$company_id' ";
          $results=$this->db->update($query);
          if ($results) {
              echo "Successfully Updated Company";
              exit();
          }

     }


   }



}



?>
