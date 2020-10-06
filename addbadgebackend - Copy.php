<?php
include_once('includes/config/connection.php');
include('function.php');

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Addme")
 {
    $message = "Message from AddBadge button! ";
    echo $message;
  
  $statement = $connection->prepare(
   "INSERT INTO earned (MemberID, SectionID, ColorID, BadgeID, LevelID,  DateReceived, AdminID)
    VALUES (:id, :SectionID, :ColorID, :BadgeID, :LevelID, :DateReceived, :AdminID)
   "
  );
  $result = $statement->execute(
    array(
        ':id'   => $_POST["user_id"],
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
