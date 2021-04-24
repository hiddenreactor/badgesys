<?php
include('database_connection.php');
// include('function.php');
if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Confirm") {
        $message = "Message from Update button! ";
        echo $message;
        
  
        $statement = $connection->prepare(
    "UPDATE members 
     SET memberusername = :updateuser, Contact = :Contact, Email = :email
     WHERE MemberID = :id
   "
        );
        $result = $statement->execute(
            array(
        ':updateuser' => $_POST["memberusername"],
        ':email' => $_POST["email"],
        ':Contact' => $_POST["Contact"],
        ':id'   => $_POST["m_id"]
       )
        );
        if (!empty($result)) {
            echo 'Data Updated!';
        }
    }
}
?>