<?php 

require_once('includes/connection.php');

$query = "SELECT * FROM members, colors, sections, earned, badges, category WHERE 
members.MemberID ='".$_POST["MemberID"]."' AND 
members.ColorID = colors.ColorID AND 
sections.SectionID = members.SectionID AND
badges.BadgeID = earned.BadgeID AND
category.CategoryID = badges.CategoryID AND
earned.MemberID = '".$_POST["MemberID"]."' ORDER BY DateReceived
";
$result = mysqli_query($con, $query);

?>
    <div class=text-center col-lg-9>
        <tr>                        
            <td>Member Color</td>
            <td>Badge Name</td>
            <td>Badge Category</td>
            <td>Badge Level</td>
            <td>Date Received</td>
        </tr>                  
    </div>          

<?php
    while($row=mysqli_fetch_assoc($result))
    { 
?>                     
    <tr class="bg-light text-dark">                    
        <td value = "<?php echo $row["ColorID"]; ?>"> <?php echo $row["Color"]; ?></td>
        <td value = "<?php echo $row["BadgeID"]; ?>"> <?php echo $row["BadgeName"]; ?></H>
        <td value = "<?php echo $row["CategoryID"]; ?>"> <?php echo $row["CategoryName"]; ?></td>
        <td value = "<?php echo $row["MemberID"]; ?>"> <?php echo $row["Level"]; ?></td>
        <td value = "<?php echo $row["MemberID"]; ?>"> <?php echo $row["DateReceived"]; ?></td>                    
    </tr>
                                  
<?php
    } 
?>

