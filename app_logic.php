<?php 
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 
   $db = new Database();
   $fm = new Format();
   error_reporting(0);
 ?>
<?php 
 
session_start();
$errors = [];
// connect to database



/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
  $email= $fm->validation($_POST['email']);
  $email=mysqli_real_escape_string($db->link,$_POST['email']);
 
  // ensure that the user exists on our system
  $query = "SELECT email FROM employee WHERE email='$email'";
 
  $results=$db->select($query);

  if (empty($email)) {
    array_push($errors, "Your email is required");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sorry, no user exists on our system with that email");
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));

  if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_reset(email, token) VALUES ('$email', '$token')";
    // $results = mysqli_query($db, $sql);
    

    // Send email to user with the token in a link they can click on
    $to = $email;
    $subject = "Reset your password on 7Teen Digital";
    // $msg = "Hi there,click on this <a href="new_password.php?token=".$token ."">link</a> to reset your password on our site";
    // $msg=""
    // $msg = "Hi there, click on this <a href="https://nhlimon.com/ems/new_pass.php?token='. $token . '">click link</a> to reset your password on our site";
    $msg = '<html><body>';
    $msg .= '<h1 style="color:#f40;">Hi!</h1>';
    $msg .= '<p style="color:#080;font-size:18px;">This Email is sent for password reset from 7Teen Digital!';
    $msg .= 'Click password reset button for reset your password before link expire!**';
    $msg .= '<br><strong> <a href="https://nhlimon.com/ems/new_pass.php?token='. $token . '">Password Reset</a> <strong></p>';
    $msg .= '<br>Visit our website<strong> <a href="https://7teen.com.bd">7Teen Digital</a> </strong>';
    $msg .= '</body></html>';
    $msg = wordwrap($msg,70);
    $sender = 'info@7teen.com.bd';
    // $headers = 'From:' . $sender;
    $headers ="From:<$sender>\n";
    $headers.="MIME-Version: 1.0\n";
    $headers.="Content-type: text/html; charset=iso 8859-1";
  
    if (mail($to, $subject, $msg, $headers)) {
       $results=$db->insert($sql);
     header('location: pending.php?email=' . $email);
    }
    else{
      echo "Failed";
    }
    
  }
}

// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
  $new_pass=mysqli_real_escape_string($db->link,$_POST['new_pass']);
  $new_pass_c=mysqli_real_escape_string($db->link,$_POST['new_pass_c']);
  // Grab to token that came from the email link
  $token = $_SESSION['token'];
  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
  if (count($errors) == 0) {
    // select email address of user from the password_reset table 
    $sql = "SELECT email FROM password_reset WHERE token='$token' LIMIT 1";
      $results=$db->select($sql);
    $email = mysqli_fetch_assoc($results)['email'];
    if ($email) {
      $new_pass =$new_pass;
      $sqlCheckExpireStatus = "SELECT isExpired FROM password_reset WHERE token='$token'";

       $resultsCheckExpireStatus=$db->select($sqlCheckExpireStatus);

       // $isExpiredstatus = mysqli_fetch_assoc($resultsCheckExpireStatus)['isExpired'];
        $isExpiredstatus=$resultsCheckExpireStatus->fetch_assoc()['isExpired'];
       if ($isExpiredstatus==0) {
      $sql = "UPDATE employee SET password='$new_pass' WHERE email='$email'";
       $results=$db->update($sql);
      if ($results) {
        $sqlInsertExpired = "UPDATE password_reset SET isExpired='1' WHERE token='$token'";
        $resultsInsertExpiredStatus=$db->insert($sqlInsertExpired);
       if ($resultsInsertExpiredStatus) {
         header('location: index.php');
       }else{
         array_push($errors, "Failed");
       }
      }else{
        array_push($errors, "Failed to Update");

      }
       
       }
       elseif ($isExpiredstatus==1) {
        array_push($errors, "Sorry!!link is expired !!".'<a href="enter_email.php">Click Again for reset link!</a>');
       }
       else{
       
        array_push($errors, "Invalid Reset Link");

       }


      
     
    }
  }
}
?>