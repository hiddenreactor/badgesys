<?php 


require_once('includes/connection.php');



$query = "SELECT * FROM members WHERE SectionID='".$_POST["SectionID"]."'";
$result = mysqli_query($con, $query);

?>

<option>Select Member</option>
<?php 
    while($row=mysqli_fetch_assoc($result))
    {
?>       
        <option value = "<?php echo $row["MemberID"]; ?>"> <?php echo $row["MemberName"]; ?></option>
<?php
    }
?>

