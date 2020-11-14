<?php
include('database_connection.php');
// include('function.php');
if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Update") {
        $message = "Message from Update button! ";
        echo $message;
        $image = '';
  
        $statement = $connection->prepare(
            "UPDATE inventorys 
    SET Quantity = :Quantity, RestockDate = :RestockDate
   WHERE inventoryid = :id
   "
        );
        $result = $statement->execute(
            array(
        ':Quantity' => $_POST["Quantity"],
        ':RestockDate' => $_POST["RestockDate"],
        ':id'   => $_POST["badge_id"]
       )
        );
        if (!empty($result)) {
            echo 'Data Updated!';
        }
    }
}
?>