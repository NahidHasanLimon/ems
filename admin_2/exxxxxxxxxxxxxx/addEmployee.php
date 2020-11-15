 
<?php
// move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file

// move_uploaded_file($_FILES["file-input"]["tmp_name"],"upload/".$_FILES["file-input"]["name"]); 
$filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../../classes/User.php');
  $usr= new User();
  ?>

 <?php  

if(isset($_FILES["file-input"]["type"]) && !empty($_POST) )
{

      $name =$_POST["name"]; 
      // print_r($name); 
      // print_r($_POST['name']); 
      // print_r("What The Fuck it is"); 
      $address = $_POST["address"];  
      $gender = $_POST["gender"];  
      $nid =$_POST["nid"];
      $mobileNo = $_POST["mobileNo"];   
      $email =  $_POST["email"];  
      $password = $_POST["password"];  
      $dob=$_POST["datepicker"];
      $photoName=$_FILES["file-input"]["name"];
      print_r($dob);



$photoName=$_FILES["file-input"]["name"];
print_r($photoName);


// Inserting into Database
 if($_POST["name"] != '')  
      {  
 
       // $addEmployee=$usr->addEmployee($name,$email,$password,$mobileNo,$address,$gender,$nid,$dob,$photoName);
       if ($addEmployee) {

          $validextensions = array("jpeg", "jpg", "png");
            $temporary = explode(".", $_FILES["1-input"]["name"]);
            $file_extension = end($temporary);
            if ((($_FILES["file-input"]["type"] == "image/png") || ($_FILES["file-input"]["type"] == "image/jpg") || ($_FILES["file-input"]["type"] == "image/jpeg")
            ) && ($_FILES["file-input"]["size"] < 100000)//Approx. 100kb files can be uploaded.
            && in_array($file_extension, $validextensions)) {
            if ($_FILES["file-input"]["error"] > 0)
            {
            echo "Return Code: " . $_FILES["file-input"]["error"] . "<br/><br/>";
            }
            else
            {
            if (file_exists("upload/" . $_FILES["file-input"]["name"])) {
            echo $_FILES["file-input"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
            }
            else
            {
            $sourcePath = $_FILES['file-input']['tmp_name']; // Storing source path of the file in a variable
            $targetPath = "upload/".$_FILES['file-input']['name']; // Target path where file is to be stored
            move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
            echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
            echo "<br/><b>File Name:</b> " . $_FILES["file-input"]["name"] . "<br>";
            echo "<b>Type:</b> " . $_FILES["file-input"]["type"] . "<br>";
            echo "<b>Size:</b> " . ($_FILES["file-input"]["size"] / 1024) . " kB<br>";
            echo "<b>Temp file:</b> " . $_FILES["file-input"]["tmp_name"] . "<br>";
            }
            }
            }
            else
            {
            echo "<span id='invalid'>***Invalid file Size or Type***<span>";
            }


        
          }    
      }  
      
















}


 ?>
 