 
<?php
   include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
  $usr= new User();
  ?>

 <?php  

if(isset($_FILES["file-input"]["type"]) && !empty($_POST) && !empty($_POST['gender']) )
{


      $firstName =$_POST["firstName"];

      $lastName =$_POST['lastName'];
      $address = $_POST["address"];  
      $gender = $_POST["gender"];  
      $nid =$_POST["nid"];
      $mobileNo = $_POST["mobileNo"];   
      $email =  $_POST["email"];  
      $password = $_POST["password"];  
      $dob=$_POST["datepicker"];
      $photoName=$_FILES["file-input"]["name"];

      $photoName=$_FILES["file-input"]["name"];


// Inserting into Database
 if($_POST["firstName"] != '')  
      {  
      
 
       // $addEmployee=$usr->addEmployee($name,$email,$password,$mobileNo,$address,$gender,$nid,$dob,$photoName);
      
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['file-input']['name'];
    $file_size = $_FILES['file-input']['size'];
    $file_temp = $_FILES['file-input']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;
    // $uploaded_image = "/".$unique_image;

      if ($firstName=="" || $lastName= "" || $gender==""|| $nid=="" || $mobileNo=="" || $email=="" ||  $password=="" ||  $dob=="" ||  $photoName=="" ||  $address=="") 
      {

         echo " <span class='error_response'> Field Must not be Empty 2 </span>";
      }


      elseif ($file_size>1048567) 
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

        $addEmployee=$usr->addEmployee($firstName,$_POST['lastName'],$email,$password,$mobileNo,$address,$gender,$nid,$dob,$uploaded_image);
      
           
            if ($addEmployee) 
            {
                 echo "success";
            }
                
      }  
      

}

}
else {
  echo "Field Must not be Empty ";
}


 ?>
 