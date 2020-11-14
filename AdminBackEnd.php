<?php

include_once('lib/access.php');
include_once('includes/config/connection.php');
// sleep(1);

if (isset($_POST["email"])) {
    $query = " SELECT * FROM admin WHERE Email = '".$_POST["email"]."'";

    $statement = $connect->prepare($query);

    $statement->execute();

    $total_row = $statement->rowCount();

    if ($total_row == 0) {
        $output = array(
   'success' => true
  );

        echo json_encode($output);
    }
}

if(isset($_POST["username"]))
{


 $query = " SELECT * FROM admin WHERE UName = '".$_POST["username"]."' ";

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


if(isset($_POST['FName']))
if ($AccessCode !== $_POST['Access']) {
echo 'Invalid Access Code';
return;
}
else {

    {

 
 $data = array(
  ':fname'  => $_POST['FName'],
  ':username'  => $_POST['UName'],
  ':email'   => $_POST['Email'],
  ':password'   => password_hash($_POST['Password'], PASSWORD_DEFAULT),
  ':date' =>  date("d/m/y")
 );
  
 $query = " INSERT INTO admin (FName, UName, Email, Password, Date) VALUES (:fname, :username, :email, :password, :date)";
 $statement = $connect->prepare($query);
 if ($statement->execute($data)) {
     echo 'Registration Completed Successfully...';
    //  header("location:index.php");
    // exit();
 }
}
}

?>