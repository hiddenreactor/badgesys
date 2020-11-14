<?php
if (isset($_POST["category"])) {
    $con = mysqli_connect("us-cdbr-iron-east-01.cleardb.net", "b8a2927a50099e", "8036e8df", "heroku_c1c6c2ef5faa08f");
    $category = mysqli_real_escape_string($con, $_POST["category"]);
    $badge = mysqli_real_escape_string($con, $_POST["badge"]);
    $level = mysqli_real_escape_string($con, $_POST["levels"]);
    $quantity = mysqli_real_escape_string($con, $_POST["quantity"]);
    $restockdate = mysqli_real_escape_string($con, $_POST["restockdate"]);

    // $rsBadge = mysqli_query($con, "SELECT * FROM badge_w_levels WHERE BadgeName = '".$badge."' AND CategoryID = '".$category."' AND LevelID = '".$level."'");
    $rsBadge = mysqli_query($con, "SELECT * FROM badgedetail WHERE BadgeName = '".$badge."' AND CategoryID = '".$category."' AND LevelID = '".$level."'");
    $numBadge = mysqli_num_rows($rsBadge);

//     echo "Category ID ";
//     echo "$category";
//     echo "\r\n";
//     echo "Badge Name ";
//     echo "$badge";
//     echo "\r\n";

    if ($numBadge > 0) {
        echo "This badge is in the system!!!";
        echo "\r\n";
        echo "Session Over.";
    } else {
        // $newBadge = "INSERT INTO badge_w_levels (CategoryID, BadgeName, LevelID) VALUES ('$category', '$badge', '$level')";
        $newBadge = "INSERT INTO badges (CategoryID, BadgeName) VALUES ('$category', '$badge')";
        // $newBadge = "INSERT INTO badgesdetail (CategoryID, BadgeName, LevelID) VALUES ('$category', '$badge', '$level')";
        if (mysqli_query($con, $newBadge)) {
            $bid = mysqli_insert_id($con);
//     echo "BadgeID ";        
//     echo "$bid";
//     echo "\r\n";
//     echo "CategoryID ";  
//     echo "$category";
//     echo "\r\n";
//     echo "LevelID ";  
//     echo "$level";
//     echo "\r\n";
//     echo "Quantity ";  
//     echo "$quantity";
//     echo "\r\n";
//     echo "Restock Data ";  
//     echo "$restockdate";
//     echo "\r\n";

            $newInventory = "INSERT INTO inventorys (BadgeID, CategoryID, LevelID, Quantity, RestockDate) VALUES (".$bid.", '$category', '$level', '$quantity', '$restockdate')" ;
            if (mysqli_query($con, $newInventory)) {
                echo "New Badge added to Inventory Table.";
                echo "\r\n";
            }            
        }
        
    
        $newBadgeDetail = "INSERT INTO badgedetail (BadgeID, BadgeName, LevelID, CategoryID) VALUES (".$bid.", '$badge', '$level', '$category')" ;
    
//         echo "BadgeID ";        
//         echo "$bid";
//         echo "\r\n";
//         echo "CategoryID ";  
//         echo "$category";
//         echo "\r\n";
//         echo "LevelID ";  
//         echo "$level";
//         echo "\r\n";;
//         echo "Badge Name ";  
//         echo "$badge";
//         echo "\r\n";
                if (mysqli_query($con, $newBadgeDetail)) {
                    echo "New Badge Added to BadgeDetail Table";
                }

    }
}
?>
