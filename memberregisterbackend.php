<?php

include_once('lib/access.php');
include_once('includes/config/connection.php');
// sleep(1);

if(isset($_POST["email"]))
{


 $query = " SELECT * FROM member_data WHERE email = '".$_POST["email"]."'";

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

if(isset($_POST["uname"]))
{


 $query = " SELECT * FROM member_data WHERE uname = '".$_POST["uname"]."' ";

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


if(isset($_POST['member_name']))


    {

 
 $data = array(
  ':fullname'  => $_POST['member_name'],
  ':username'  => $_POST['uname'],
  ':email'   => $_POST['email'],
  ':password'   => password_hash($_POST['password'], PASSWORD_DEFAULT),
  ':date' =>  date("d/m/y")
 );
  
 $query = " INSERT INTO member_data (member_name, uname, email, password, dateregister) VALUES (:fullname, :username, :email, :password, :date)";
 $statement = $connect->prepare($query);
 if ($statement->execute($data)) {
     echo 'Registration Completed Successfully...';
     header( "refresh:2;url=index.php" );
 }
}


?>