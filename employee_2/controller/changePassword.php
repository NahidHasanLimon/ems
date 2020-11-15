     
    <?php

      include_once($_SERVER['DOCUMENT_ROOT'].'/ems/employee/classes/User.php'); 
      include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php'); 
      session_start();
  
      $usr= new User();
      ?>
     <?php
     
      if( !empty($_POST['currentPassword']) && !empty($_POST['newPassword']) && !empty($_POST['confirmPassword'])   ) {
         $employee_id= Session::get("emp_id");
          $curPass = $_POST["currentPassword"];  
          $newPass = $_POST["newPassword"];  
          $confPass = $_POST["confirmPassword"];  
         $result=$usr->update_password($curPass,$newPass,$employee_id);
         if ($result) {
          echo $result;
         }
         else{
         echo $result;
         }
        
      } 
      else{
        echo "empty";
      }


     ?>
