<?php 


require_once('includes/connection.php');



$query = "SELECT * FROM members, colors, sections WHERE MemberID ='".$_POST["MemberID"]."' AND members.ColorID = colors.ColorID AND sections.SectionID = members.SectionID";
$result = mysqli_query($con, $query);

?>

<option>Select Color</option>
<?php 
    while($row=mysqli_fetch_assoc($result))
    {
?>       
        <option value = "<?php echo $row["ColorID"]; ?>"> <?php echo $row["Color"]; ?></option>
        <tr>
           <td id="colors" value = "<?php echo $row["ColorID"]; ?>"> <?php echo $row["Color"]; ?> </td>
        </tr>
<?php
    }
?>