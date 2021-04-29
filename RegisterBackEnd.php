<?php
require_once('lib/access.php');
require_once('includes/config/connection.php');
ob_start();
// sleep(1);

if(isset($_POST['FName']))
if ($AccessCode !== $_POST['Access']) {
echo 'Invalid Access Code!';
// echo '<meta http-equiv="refresh" content="2;url=index.php">';
return;
}
else {
 
 $data = array(
  ':fname'  => $_POST['FName'],
  ':lname'  => $_POST['LName'],
  ':username'  => $_POST['UName'],
  ':email'   => $_POST['Email'],
  ':password'   => password_hash($_POST['Password'], PASSWORD_DEFAULT),
  ':date' =>  date("d/m/y")
 );
  
 $query = " INSERT INTO user_data (FName, LName, UName, Email, Password, Date) VALUES (:fname, :lname, :username, :email, :password, :date)";
 
 $statement = $connect->prepare($query);
 if ($statement->execute($data)) {
    echo 'Registration Completed Successfully...'; 
    exit();
 }
}

if(isset($_POST["email"]))
{

 $query = " SELECT * FROM user_data WHERE Email = '".$_POST["email"]."'";

 $statement = $connect->prepare($query);

 $statement->execute();

 $total_row = $statement->rowCount();

 if($total_row == 0)
 {
  $output = array(
   'success' => true
  );

  echo json_encode($output);
 }
}

if(isset($_POST["username"]))
{

 $query = " SELECT * FROM user_data WHERE UName = '".$_POST["username"]."' ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $total_row = $statement->rowCount();

 if($total_row == 0)
 {
  $output = array(
   'success' => true
  );

  echo json_encode($output);
 }
}
?>
