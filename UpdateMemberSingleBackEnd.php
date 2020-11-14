<?php
include('database_connection.php');
// include('function.php');
if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Update") {
        $message = "Message from Update button! ";
        echo $message;
        $image = '';
  
        $statement = $connection->prepare(
            "UPDATE members 
    SET SectionID = :SectionID, ColorID = :ColorID,  Contact = :Contact, Email = :updateemail
   WHERE MemberID = :id
   "
        );
        $result = $statement->execute(
            array(
        ':SectionID' => $_POST["SectionID"],
        ':ColorID' => $_POST["ColorID"],
        ':updateemail' => $_POST["Email"],
        ':Contact' => $_POST["Contact"],
        ':id'   => $_POST["user_id"]
       )
        );
        if (!empty($result)) {
            echo 'Data Updated!';
        }
    }
}
?>