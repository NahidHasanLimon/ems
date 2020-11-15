 
<?php

   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Department.php'); 
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Designation.php'); 
  $usr= new User();
  $dep= new Department();
  $des= new Designation();
  ?>

 <?php  
 if($_POST["employee_id"] != '')  
      {  
        // print_r($_POST);
       $firstName =$_POST["firstName"];
       $lastName =$_POST["lastName"];
        // $role =$_POST["role"];
        // $status =$_POST["status"];
    
      $address = $_POST["address"];  
      $gender = $_POST["gender"];  
      $nid =$_POST["nid"];
      $mobileNo = $_POST["mobileNo"];   
      $email =  $_POST["email"];  
    
      $dob=$_POST["datepicker"];
      $photoName=$_FILES["file-input"]["name"];

    
    
    
    $employee_id = $_POST["employee_id"];  

    // print_r($uploaded_image);


  if ($firstName=="" || $_POST["lastName"] == "" || $gender==""|| $nid=="" || $mobileNo=="" || $email==""  ||  $dob==""  ||  $address=="") 
      {

         echo " <span class='error_response'> Field Must not be Empty</span>";
     }
     else {
      if(empty($photoName)) {
    
        
      $update_admin_profile=$usr->update_admin_profile($employee_id,$firstName,$lastName,$email,$mobileNo,$address,$gender,$nid,$dob,$photoName);
      if ($update_admin_profile) 
            {
                 echo $update_admin_profile;
            }
      }
      else{
        // print_r("nahid");
       $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['file-input']['name'];
    $file_size = $_FILES['file-input']['size'];
    $file_temp = $_FILES['file-input']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;

         if ($file_size>1048567) 
      {
          echo " <span class='error_response'> Image Size Should Be Less then 1 MB </span>";
      }

      elseif (in_array($file_ext,$permited)===false) 
      {
           echo " <span class='error_response'>You Can Upload Only:- JPG,JPEG,PNG,GIF </span>";
           implode(',',$permited);
      }

      else 
      {
           // move_uploaded_file($file_temp, $uploaded_image);
             move_uploaded_file($file_temp, $_SERVER['DOCUMENT_ROOT'].'/ems/photo/'.$uploaded_image);
           // print_r($_POST['lastName']);

            $update_admin_profile=$usr->update_admin_profile($employee_id,$firstName,$_POST["lastName"],$email,$mobileNo,$address,$gender,$nid,$dob,$uploaded_image);
      
           
            if ($update_admin_profile) 
            {
                 // echo "success";
              echo $update_admin_profile;
            }
                
      }  

      }
}
 



     
      

}

else {
  echo "Field Must not be Empty ";
}


 ?>
