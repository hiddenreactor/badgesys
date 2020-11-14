<?php 
require_once('includes/connection.php');

// $query = "SELECT DISTINCT BadgeName, CategoryID, BadgeID FROM badge_w_levels WHERE CategoryID = '".$_POST["CategoryID"]."' AND LevelID >= 9";
$query = "SELECT * FROM badges WHERE CategoryID ='".$_POST["CategoryID"]."'";
$result = mysqli_query($con, $query);
?>

<option>Select Badge</option>
<?php 
    while($row=mysqli_fetch_assoc($result))
    {
?>       
        <option value = "<?php echo $row["BadgeID"]; ?>"> <?php echo $row["BadgeName"]; ?></option>
<?php
    }
?>

