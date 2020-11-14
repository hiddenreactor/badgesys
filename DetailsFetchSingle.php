<?php 

require_once('includes/header.php');
require_once('includes/connection.php');

if(isset($_SESSION['MemberID']) || isset($_SESSION['admin']))
{
    // echo "MemberID ";
    // echo "\r\n";
    // echo $_SESSION['MemberID'];
    // echo "\r\n";
    // echo "Admin ";
    // echo "\r\n";
    // echo $_GET['success'];
    // echo "\r\n";
    // echo "Admin ";
    // echo "\r\n";
    // echo $_SESSION['GET'];
    // echo "\r\n";
    // echo "Admin ";
    // echo "\r\n";
    $_SESSION['GET'] = $GetID = $_GET['success'];
    $query = "SELECT * FROM members, colors, sections, earned, badges, category WHERE 
members.MemberID ='".$GetID."' AND 
earned.ColorID = colors.ColorID AND 
earned.SectionID = sections.SectionID AND
badges.BadgeID = earned.BadgeID AND
category.CategoryID = badges.CategoryID AND
earned.MemberID = '".$GetID."' ORDER BY earned.MemberID desc
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
                    <tr class="bg-outline-dark text-dark ml-5">
                        <td>Badge Earned</td>
                        <td>Member Color</td>
                        <td>Badge Name</td>
                        <td>Badge Category</td>
                        <td>Badge Level</td>
                        <td>Date Tested</td>
                        <td>Tested By</td>
                    </tr>      
            
                <?php
                    $query = "SELECT * FROM members, colors, sections, earned, badges, badgelevel, admin, category WHERE 
                    members.MemberID ='".$GetID."' AND 
                    earned.ColorID = colors.ColorID AND 
                    earned.SectionID = sections.SectionID AND
                    earned.BadgeID = badges.BadgeID AND
                    earned.LevelID = badgelevel.LevelID AND 
                    earned.AdminID = admin.AdminID AND 
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
                        <td value = "<?php echo $row["LevelID"]; ?>"> <?php echo $row["Levels"]; ?></td>
                        <td value = "<?php echo $row["MemberID"]; ?>"> <?php echo $row["DateReceived"]; ?></td>
                        <td value = "<?php echo $row["AdminID"]; ?>"> <?php echo $row["FName"]; ?></td>
                    </tr> 
                <?php                
                    }
                ?>            
                </table>

                <div class="row">                                             
                    <div class="card-body">
                        <a href = "javascript:history.back()" class="btn btn-outline-primary mb-1">Back</a>
                        <div class="form-inline float-right">
                            <form method="post" action="exportcsv.php?success=<?php echo "$GetID" ?>"> 
                                <button type="submit" name="csv" value="CSV Export" class="btn btn-outline-dark " /><i class="fas fa-file-csv"></i> CSV Export</button>
                            </form><span style="width: 3px"></span> 
                            <form method="post" action="exportpdf.php?success=<?php echo "$GetID" ?>"> 
                                <button type="submit" name="pdf" value="PDF Export" class="btn btn-outline-dark " /><i class="fas fa-file-pdf"></i> PDF Export</button>                       
                            </form><span style="width: 3px"></span>
                            <form method="post" action="exportexcel.php?success=<?php echo "$GetID" ?>"> 
                                <button type="submit" name="excel" value="Excel Export" class="btn btn-outline-dark " /><i class="fas fa-file-excel"></i> Excel Export</button>                       
                            </form> 
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