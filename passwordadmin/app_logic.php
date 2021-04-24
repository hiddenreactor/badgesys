<?php 

// session_start();
require_once('../includes/connection.php');
$errors = [];
$user_id = "";

// if (isset($_GET['token'])) {
//     $_SESSION['token']=mysqli_real_escape_string($con,$_GET['token']);
//     }
// LOG USER IN
if (isset($_POST['login_user'])) {
  // Get username and password from login form
  $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  // validate form
  if (empty($user_id)) array_push($errors, "Username or Email is required");
  if (empty($password)) array_push($errors, "Password is required");

  // if no error in form, log user in
  if (count($errors) == 0) {
    $password = md5($password);
    $sql = "SELECT * FROM user_data WHERE UName='$user_id' OR Email='$user_id' AND password='$password'";
    $results = mysqli_query($con, $sql);

    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $user_id;
      $_SESSION['success'] = "You are now logged in";
      header('location: ../passwordadmin/success.php');
    }else {
      array_push($errors, "Wrong credentials");
    }
  }
}

/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
  $email = mysqli_real_escape_string($con, $_POST['email']);
  // ensure that the user exists on our system
  $query = "SELECT Email FROM user_data WHERE Email='$email'";
  $results = mysqli_query($con, $query);

  if (empty($email)) {
    array_push($errors, "Your email is required");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sorry, no user exists on our system with that email");
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));

  if (count($errors) == 0) {
    $timestamp = date("Y-m-d H:i:s");  
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_reset(email, token, tokenexpire) VALUES ('$email', '$token', '$timestamp')";
    $results = mysqli_query($con, $sql);

    // Send email to user with the token in a link they can click on
    $to = $email;
    $subject = "Reset your password on badgesystem.com";
    $msg = "Hi there, click on this <a href=\"localhost/badgesys/passwordadmin/new_password.php?email=".$email."&token=".$token."\">link</a> to reset your password on our site";
    $msg = wordwrap($msg,70);
   
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= 'From: Password Change Reminder <sent@badgesystem.com>' . "\r\n";
    // $headers .= 'Cc: birthdayarchive@badgesystem.com' . "\r\n";
    // $headers .= 'Bcc: birthdaycheck@badgesystem.com' . "\r\n";

    mail($to, $subject, $msg, $headers);
    header('location: ../passwordadmin/pending.php?email=' . $email);
  }
}

if (isset($_GET['token'])){
  $_SESSION['token']=mysqli_real_escape_string($con,$_GET['token']); 
  $email = $_GET['email'];
  $sql = "SELECT token FROM password_reset WHERE email='$email' LIMIT 1";
  $results = mysqli_query($con, $sql);
  $tokens = mysqli_fetch_assoc($results)['token'];
if (isset($_GET['token']) != $tokens) {
  header('location: ../passwordadmin/expire.php?email=' . $email);
  } 
} 
// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
  $new_pass = mysqli_real_escape_string($con, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($con, $_POST['new_pass_c']);

  $token = $_SESSION['token'];
  //Put the expire token code below
  $currenttime = date('y-m-d h:i:s');
  $currenttimestring = strtotime(date('y-m-d h:i:s'));
  $sql = "SELECT email FROM password_reset WHERE token='$token' LIMIT 1";
  $result = mysqli_query($con, $sql);
  $email = mysqli_fetch_assoc($result)['email'];

  $sql = "SELECT * FROM password_reset WHERE email = '$email'";
  $result = mysqli_query($con, $sql);
  $timefromdb = strtotime(mysqli_fetch_assoc($result)['tokenexpire']);

  $current_time = time(); 
  $time_expire = $timefromdb + 86400; // timestamp after 24 hours in unix 86400

  if ($time_expire > $current_time) {
    // Grab to token that came from the email link    
    if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
    if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");

    if (count($errors) == 0) {
    // select email address of user from the password_reset table 
    $sql = "SELECT email FROM password_reset WHERE token='$token' LIMIT 1";
    $results = mysqli_query($con, $sql);
    $email = mysqli_fetch_assoc($results)['email'];
    // Password updated, now delete token or delete whole record.
    if ($email) {
        $hashedPassword = password_hash($new_pass, PASSWORD_BCRYPT);
        $sql = "UPDATE user_data SET Password='$hashedPassword' WHERE Email='$email' ";
        $results = mysqli_query($con, $sql);
        $deleterecord = "DELETE FROM password_reset WHERE token = '$token'";
        $result = mysqli_query($con, $deleterecord);
        header('location: ../passwordadmin/success.php?email=' . $email);
        }        
      }       
  } else {
    $deleterecord = "DELETE FROM password_reset WHERE token = '$token'";
    $result = mysqli_query($con, $deleterecord);
    header('location: ../passwordadmin/expire.php?email=' . $email);
  }
} 

?>