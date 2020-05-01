<?php 

require_once('includes/header.php');
require_once('includes/connection.php');

if(isset($_SESSION['MemberID']) || isset($_SESSION['admin']))
{
    $_SESSION['GET'] = $GetID = $_GET['success'];
    $query = "SELECT * FROM members, colors, sections, earned, badges, category WHERE 
members.MemberID ='".$GetID."' AND 
earned.ColorID = colors.ColorID AND 
earned.SectionID = sections.SectionID AND
badges.BadgeID = earned.BadgeID AND
category.CategoryID = badges.CategoryID AND
earned.MemberID = '".$GetID."' ORDER BY earned.level desc
";

    $result = mysqli_query($con, $query);

    if($row=mysqli_fetch_assoc($result))
    {
        $MemberName = $row['MemberName'];

require_once('includes/footer.php'); 



?>

<div class="container" onLoad="getDetail(this.value);">
    <div class="row">
        <div class="col">
            <div class="card bg-dark text-white mt-5">
                <h3 class="text-center py-3">Badge Details for <?php echo $MemberName ?></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- <div class="col-lg-3">
            <div class="card mt-3">
                <div class="card-title bg-warning text-white py-2 rounded-top">
                    <h4 class="text-center"> <?php echo $MemberName ?></h4>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div> -->
        
        <div class=col-lg-12>
            <div class="card mt-3">
                <table class="table table-striped text-center">    
                    <tr class="bg-info text-white ml-5">
                        <td>Section History</td>
                        <td>Member Color</td>
                        <td>Badge Name</td>
                        <td>Badge Category</td>
                        <td>Badge Level</td>
                        <td>Date Received</td>
                    </tr>      
            
                <?php
                    $query = "SELECT * FROM members, colors, sections, earned, badges, category WHERE 
                    members.MemberID ='".$GetID."' AND 
                    earned.ColorID = colors.ColorID AND 
                    earned.SectionID = sections.SectionID AND
                    badges.BadgeID = earned.BadgeID AND
                    category.CategoryID = badges.CategoryID AND
                    earned.MemberID = '".$GetID."' ORDER BY earned.DateReceived DESC
                    ";
                    $result = mysqli_query($con, $query);   
                    while($row=mysqli_fetch_assoc($result))
                        { 
                    ?>
                    <tr>
                        <td value = "<?php echo $row["SectionID"]; ?>"> <?php echo $row["SectionName"]; ?></td>
                        <td value = "<?php echo $row["ColorID"]; ?>"> <?php echo $row["Color"]; ?></td>
                        <td value = "<?php echo $row["BadgeID"]; ?>"> <?php echo $row["BadgeName"]; ?></H>
                        <td value = "<?php echo $row["CategoryID"]; ?>"> <?php echo $row["CategoryName"]; ?></td>
                        <td value = "<?php echo $row["MemberID"]; ?>"> <?php echo $row["Level"]; ?></td>
                        <td value = "<?php echo $row["MemberID"]; ?>"> <?php echo $row["DateReceived"]; ?></td>
                    </tr> 
                <?php
                    }
                ?>            
                </table>

                <div class="row">                                             
                    <div class="card-body">                          
                        <a href="AdminPanelFrontEnd.php" class="btn btn-primary mb-1">Back</a>  
                        <div class="form-inline float-right">
                            <a href="AddBadgeFrontEnd.php?addBadge=<?php echo $GetID ?>" class="btn btn-danger">Add Badge</a>
                        </div>
                                           
                    </div>      
                </div> 
                 
            </div>
        </div>
    </div>


</div>

<?php
    }
    else
        {
        header("location:message.php");
        exit();
        }
    
}
?>