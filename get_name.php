<?php 


require_once('includes/connection.php');



$query = "SELECT * FROM members, colors, sections, earned, badges, category WHERE 
members.MemberID ='".$_POST["MemberID"]."' AND 
members.ColorID = colors.ColorID AND 
sections.SectionID = members.SectionID AND
badges.BadgeID = earned.BadgeID AND
category.CategoryID = badges.CategoryID AND
earned.MemberID = '".$_POST["MemberID"]."' 
";
$result = mysqli_query($con, $query);

?>

<?php 
    if($row=mysqli_fetch_assoc($result))
    { 
?>          
        <div class="card bg-dark text-white mt-3">
            <h3 class="text-center" value = "<?php echo $row["MemberID"]; ?>">Badge Details for <?php echo $row["MemberName"]; ?> </h3>                   
        </div>                              
<?php
    } 
?>
