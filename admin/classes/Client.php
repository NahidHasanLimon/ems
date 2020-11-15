<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');
Session::init();
if ($_SESSION['adminLogin']!=true){
Session::init();
}
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 
class Client
{

 private $db;
 private $fm;

public function __construct()
   {
 $this->db = new Database();
 $this->fm = new Format();
   }

public function all_client_details()
      {
       $query="SELECT * FROM clients";
        $result = $this->db->delete($query);
        return $result;
      }
public function delete_client($del_client_id)
      {
       $query="DELETE FROM clients WHERE id='$del_client_id' ";
        $result = $this->db->delete($query);
        return $result;
      }
  public function update_client($update_client_id,$client_name,$client_description)
      {
$client_name= $this->fm->validation($client_name);  
$client_name=mysqli_real_escape_string($this->db->link,$client_name);
$client_description= $this->fm->validation($client_description);  
$client_description=mysqli_real_escape_string($this->db->link,$client_description);
      $query="UPDATE clients SET name = '$client_name',description='$client_description' WHERE id = '$update_client_id' ";
        $result = $this->db->update($query);
        return $result;
      }
      
  public function add_client($client_name,$client_description)
  {
 $client_name= $this->fm->validation($client_name);  
$client_name=mysqli_real_escape_string($this->db->link,$client_name);
 $client_description= $this->fm->validation($client_description);  
$client_description=mysqli_real_escape_string($this->db->link,$client_description);

    if ($client_name =="") {
      echo " Field Must Not be Empty";
      exit();
    }
   else
   {
        $insert_query="INSERT INTO clients(name,description) VALUES ('$client_name','$client_description')";
          $results=$this->db->insert($insert_query);
          if ($results) {
              echo "success";
          exit();
          }
     }

   }


 
  


}



?>
