<?php

include('database_connection.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scout";

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST["operations"])) {
    if ($_POST["operations"] === "Earned_Badge") {
        // $message = "Message from Earned Badge button! ";        
        // echo $message;
        // echo "\r\n";
    }

    $sql = "SELECT * FROM earned WHERE BadgeID = ".$_POST["BadgeID"]." AND LevelID = ".$_POST["LevelID"]." AND MemberID = ".$_POST["MemberID"]."";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "This member has earned this badge already.";
        echo "\r\n";
        echo "Request denied.";
    } else {

// Check if inventorys and badgedetail has this badge in the record

// if not add the this new badge into inventorys and badgedetail

$checkinventorys_sql = "SELECT * FROM inventorys WHERE BadgeID = ".$_POST["BadgeID"]." AND CategoryID = ".$_POST["CategoryID"]." AND LevelID = ".$_POST["LevelID"]." ";
$checkinventorys_res = $conn->query($checkinventorys_sql);
if ($checkinventorys_res->num_rows > 0) {
    echo "This badge is inside inventory database.";
        echo "\r\n";
} else {
    $insertinventorys_sql = "INSERT INTO inventorys (BadgeID, CategoryID, LevelID, Quantity, RestockDate) 
    VALUES ('".$_POST["BadgeID"]."', '".$_POST["CategoryID"]."', '".$_POST["LevelID"]."', 10, '".$_POST["DateReceived"]."')";
    $insertinventorys_res = $conn->query($insertinventorys_sql);
    echo "New badge Added to inventory database.";
    echo "\r\n";
}

$checkbadges_sql = "SELECT * FROM badges WHERE BadgeID = ".$_POST["BadgeID"]." AND CategoryID = ".$_POST["CategoryID"]." ";
$checkbadges_res = $conn->query($checkbadges_sql);
if ($checkbadges_res->num_rows > 0) {
    echo "This badge is inside badges database.";
        echo "\r\n";
} else {
    echo "This badge is NOT inside badges database.";
    echo "\r\n";
}
        
$selectbadge = "SELECT * FROM badges WHERE BadgeID = ".$_POST["BadgeID"]."";
$result = $conn->query($selectbadge);
$row=mysqli_fetch_assoc($result);
    // echo "BadgeID ";        
    // echo $_POST["BadgeID"];
    // echo "\r\n";
    // echo $row["BadgeName"];
    // echo "\r\n";
    // echo "CategoryID ";        
    // echo $_POST["CategoryID"];
    // echo "\r\n";
    // echo "LevelID ";        
    // echo $_POST["LevelID"];
    // echo "\r\n";


$badgedetail_sql = "INSERT INTO badgedetail (BadgeID, BadgeName, LevelID, CategoryID) 
VALUES ('".$_POST["BadgeID"]."', '".$row["BadgeName"]."', '".$_POST["LevelID"]."', '".$_POST["CategoryID"]."')";
$result = $conn->query($badgedetail_sql);
echo "Badge Added into Badge Database!!";
echo "\r\n";


        $statement = $connection->prepare("INSERT INTO earned (MemberID, SectionID, ColorID, BadgeID, LevelID, DateReceived, AdminID) 
        VALUES (:id, :SectionID, :ColorID, :BadgeID, :LevelID, :DateReceived, :AdminID) ");

        // echo "Member ID ";
        // echo $_POST["user"];
        // echo "\r\n";
        // echo "SectionID ";        
        // echo $_POST["SectionID"];
        // echo "\r\n";
        // echo "ColorID ";        
        // echo $_POST["ColorID"];
        // echo "\r\n";
        // echo "BadgeID ";        
        // echo $_POST["BadgeID"];
        // echo "\r\n";
        // echo "LevelID ";        
        // echo $_POST["LevelID"];
        // echo "\r\n";
        // echo "Restock Data ";  
        // echo $_POST["DateReceived"];
        // echo "\r\n";
        // echo "AdminID ";  
        // echo $_POST["AdminID"];
        // echo "\r\n";

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
        if (!empty($result)) {
            echo "Earned Badge Entered.";
            echo "\r\n";
            $statement = $connection->prepare(
                "UPDATE inventorys SET BadgeID = :BadgeID, CategoryID = :CategoryID, LevelID = :LevelID, Quantity = Quantity-1, RestockDate = :RestockDate
            WHERE BadgeID = :BadgeID AND CategoryID = :CategoryID AND LevelID = :LevelID"
            );
            $result = $statement->execute(
                array(
            ':BadgeID' => $_POST["BadgeID"],
            ':CategoryID' => $_POST["CategoryID"],
            ':LevelID' => $_POST["LevelID"],
            ':RestockDate'   => $_POST["DateReceived"]
           )
            );
            // echo "BadgeID ";        
            // echo $_POST["BadgeID"];
            // echo "\r\n";
            // echo "CategoryID ";  
            // echo $_POST["CategoryID"];
            // echo "\r\n";
            // echo "LevelID ";  
            // echo $_POST["LevelID"];
            // echo "\r\n";
            // echo "Restock Data ";  
            // echo $_POST["DateReceived"];
            // echo "\r\n";
            // echo 'Badge Updated to Inventory Table.';
            // echo "\r\n";
            // if (!empty($result)) {
            //     // echo 'Inventory Updated.';
            //     echo "Inventory Low.";
            // }
            
            if (!empty($result)) { // Beginning of sending email on low inventory
                // $sql = "SELECT * FROM inventorys WHERE BadgeID = ".$_POST["BadgeID"]." AND LevelID = ".$_POST["LevelID"]." ";
                // $sql = "SELECT * FROM inventorys WHERE BadgeID = ".$_POST["BadgeID"]." AND LevelID = ".$_POST["LevelID"]." AND Quantity <= 10";
                $sql = "SELECT Levels, Quantity, BadgeName FROM inventorys, badgelevel, badges WHERE inventorys.Quantity <= 9 
                AND inventorys.LevelID = badgelevel.LevelID AND inventorys.BadgeID = badges.BadgeID ORDER BY InventoryID";

                // $output = '';
                $output = '<html><body>';                
                $output .= '<p>This email is to inform you the following badge has less than 10.</p>';
                $output .= '<table class="table">';
                $output .= '<form><thead>';
                $output .= '<tr><td style="font-weight:bold">Badge Name</td><td style="font-weight:bold">Badge Level</td><td style="font-weight:bold">Quantity</td></tr>';
                $result = $conn->query($sql);                
                while ($row=mysqli_fetch_assoc($result)) {
                    $BadgeName = $row["BadgeName"];
                    $Levels = $row["Levels"];
                    $Quantity = $row["Quantity"];

                    // echo $BadgeName.$Levels.$Quantity;
                    // echo "\r\n";
                    $output .= '<tr><td>'.$row["BadgeName"].' </td>';  
                    $output .= '<td>'.$row["Levels"].' </td>';  
                    $output .= '<td>'.$row["Quantity"].' </td></tr>';  
                                        
                };
                $output .= '</table></form></thead>';
                $output .= '<p>Please restock at your earliest convenience.</p>';
                $output .= '<p>Thank you</p>';
                $output .= '<p>Scout Group33 Badge Support Team.</p>';
                $output .= '</body></html>';

                // print $output;

                
                if ($result->num_rows > 0) {
                    // echo "This Badge is LOW";
                    // echo "\r\n";
                    // echo $row["Quantity"];
                    $to      = 'philbertyu@gmail.com';
                    $subject = 'Inventory status alert!';
                    // $message .= 'This message is to inform you that badge <b>'.$row["BadgeName"].'</b> with level '.$row["Levels"].' has '.$row["Quantity"].' available.';  
                    // $message .= 'Please restock at your earliest convenience.';
                    // $headers = 'From: philbertyu2@gmail.com' . "\r\n" .
                    //     'Reply-To: philbertyu2@gmail.com' . "\r\n" .
                    //     'X-Mailer: PHP/' . phpversion();
                    // To send HTML mail, the Content-type header must be set
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    // Additional headers
                    $headers .= 'To: Philbert Yu <philbertyu@gmail.com>' . "\r\n";
                    $headers .= 'From: Badge System Reminder <philbertyu2@gmail.com>' . "\r\n";
                    mail($to, $subject, $output, $headers);
                    echo "Email sent!";
                } else {
                    echo "mail send ... ERROR!";
                    print_r( error_get_last() );
                } // End of sending email on low inventory


            }
        }
    }
}

?>


