     
    <?php

      include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/User.php'); 
      $usr= new User();
      ?>

     <?php  
      if(!empty($_POST['find_employe_id']) ) {
        $employee_id=$_POST['find_employe_id'];
        $result= $usr->find_employee_info($employee_id);
        if ($result) {
          $empInfo=$result->fetch_assoc();
          echo json_encode($empInfo);
        }

      }

      else if(!empty($_POST['currentPassword']) && !empty($_POST['newPassword']) && !empty($_POST['confirmPassword']) && !empty($_POST['selectEmployee']) && empty($_POST['find_employe_id']) ) {
          $employee_id = $_POST["selectEmployee"];  
          $curPass = $_POST["currentPassword"];  
          $newPass = $_POST["newPassword"];  
          $confPass = $_POST["confirmPassword"];  
         $result=$usr->update_password($curPass,$newPass,$employee_id);
         if ($result) {
          echo $result;
         }
         else{
         echo "error";
         }
        
      } 
      else{
        echo "empty";
      }


     ?>
