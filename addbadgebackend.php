<?php
// include_once('includes/config/connection.php');
include('database_connection.php');
// include('function.php');
echo "hellop";
if(isset($_POST["operations"]))
{echo "hello3";
 if($_POST["operations"] == "Add_Badge")
 {
    echo "hello4";
    $message = "Message from Add Badge button! ";
    echo $message;
    echo "hello5";
$statement = $connection->prepare("INSERT INTO earned (MemberID, SectionID, ColorID, BadgeID, LevelID, DateReceived, AdminID) 
VALUES (:id, :SectionID, :ColorID, :BadgeID, :LevelID, :DateReceived, :AdminID) ");

  $result = $statement->execute(
    array(
        ':id'   => $_POST["user"],
        ':SectionID' => $_POST["SectionID"],
        ':ColorID' => $_POST["ColorID"],
        ':BadgeID' => $_POST["BadgeID"],
        ':LevelID' => $_POST["LevelID"],
        ':DateReceived' => $_POST["DateReceived"],
        ':AdminID' => $_POST["AdminID"]        
       )
  );
  if(!empty($result))
  {
   echo 'Badge Added';
  }
 }
}

?>
