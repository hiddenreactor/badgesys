<?php
include('database_connection.php');
// include('function.php');
if (isset($_POST["operate"])) {
    if ($_POST["operate"] == "Reset Password") {
  
$statement = $connection->prepare(
    "UPDATE members 
     SET Password = :password
     WHERE MemberID = :id
   "
        );
        $result = $statement->execute(
            array(
        ':password'   => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ':id'   => $_POST['u_id']
       )
        );
        if (!empty($result)) {
            echo 'Password Changed';
        }
    }
} 

?>