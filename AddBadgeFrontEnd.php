<?php
    require_once('includes/header.php');
    require_once('includes/connection.php');
    require_once('includes/function.php');

    if(isset($_GET['MemberID']) || isset($_SESSION['admin']))
    {
        $GetID = $_GET['addBadge'];
        $query = "SELECT * FROM earned, colors, sections, members, badges, category WHERE 
        members.MemberID = '".$GetID."' AND        
        members.ColorID = colors.ColorID AND 
        members.SectionID = sections.SectionID AND
        earned.BadgeID = badges.BadgeID AND
        category.CategoryID = badges.CategoryID
        ";
        $result = mysqli_query($con,$query);

        if($row=mysqli_fetch_assoc($result))
        {
            $MemberName = $row['MemberName'];
            $MemberID = $row['MemberID'];
            $SectionID = $row['SectionID'];
            $SectionName = $row['SectionName'];
            $ColorID = $row['ColorID'];
            $Color = $row['Color'];
            $CategoryName = $row['CategoryName'];
            $CategoryID = $row['CategoryID'];
            $BadgeName = $row['BadgeName'];
            $BadgeID = $row['BadgeID'];
        }

    }

?>
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
function getMember(val)
{
    $.ajax({
        type: "POST",
        url: "get_Member.php",
        data: 'SectionID=' + val,
        success: function(data){
            $("#members").html(data);
        }
    });
}
function getDetail(val)
{
    $.ajax({
        type: "POST",
        url: "get_Detail.php",
        data: 'MemberID=' + val,
        success: function(data){
            $("#details").html(data);
        }
    });
}
function getBadge(val)
{
    $.ajax({
        type: "POST",
        url: "get_badge.php",
        data: 'CategoryID=' + val,
        success: function(data){
            $("#badges").html(data);
        }
    });
}
</script>

<script>
    if(performance.navigation.type == 2){
        location.reload(true);
    }
</script>
<script>

$(document).ready(function() {
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;       
    $("#theDate").attr("value", today);
});

</script>

<div class="container" onLoad="getDetail(this.value);">
    <div class="row">
        <div class="col">
            <div class="card bg-dark text-white mt-5">
                <h3 class="text-center py-3">Add Badges for <?php echo $MemberName ?></h3>
            </div>
            <?php
                addBadgeFunction();      
            ?>
        </div>
    </div>

    <div class="row">
        <div class=col-lg-12> 
            <div class="card mt-3">
                <table class="table table-striped">
                <form action="AddBadgeBackEnd.php?M_ID=<?php echo $GetID ?>" method="POST" enctype="multipart/form-data">        
                    <tr>                    
                        <td>Section Name</td>
                        <td>Group Color</td>
                        <td>Badge Category</td>
                        <td>Badge Name</td>
                        <td>Badge Level</td>
                        <td>Date Received</td>
                    </tr>

                    <tr>
                        <td>
                            <select name='SectionID' id='SectionID' class="form-control mb-2">
                                
                                
                                <option value ="<?php echo $row['SectionID']; ?>"><?php echo $row['SectionName']; ?></option>
                                <?php
                                $query = "SELECT * FROM sections ";
                                $result = mysqli_query($con, $query);   
                                while($Section_row=mysqli_fetch_assoc($result))
                                { 
                                ?>
                                <option value ="<?php echo $Section_row['SectionID']; ?>"><?php echo $Section_row['SectionName']; ?></option>
                                <?php    
                                }
                                ?>                   
                            </select>                       
                        </td>
                        <td>
                            <select name='ColorID' id='ColorID' class="form-control mb-2">
                                <option value ="<?php echo $row['ColorID']; ?>"><?php echo $row['Color']; ?> </option>
                                <?php
                                $query = "SELECT * FROM colors ";
                                $result = mysqli_query($con, $query);   
                                while($Color_row=mysqli_fetch_assoc($result))
                                { 
                                ?>
                                <option value="<?php echo $Color_row['ColorID']; ?>"><?php echo $Color_row['Color']; ?></option>
                                <?php    
                                }
                                ?>                   
                            </select>
                        </td>  
                        <td>
                            <select name='CategoryID' class="form-control mb-2" id="category" onChange="getBadge(this.value);">
                            <option value="null">Badge Category</option>
                                <?php
                                $query = "SELECT * FROM category ";
                                $result = mysqli_query($con, $query);   
                                while($row=mysqli_fetch_assoc($result))
                                    { 
                                ?>
                                    <option value = "<?php echo $row["CategoryID"]; ?>"> <?php echo $row["CategoryName"]; ?> </option>
                                <?php    
                                    }
                                ?>                   
                            </select>
                        <td>
                            <select name='BadgeID' class="form-control mb-2" id="badges" onChange="getDetail(this.value);">
                                <option value="null">Select Badges</option>               
                            </select>                            
                        </td>
                        <td>
                            <!-- <input name="Level" type="text" class="form-control"> -->
                            <select name='Level' class="form-control">
                                <option value="null">Level</option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                                <option value='6'>6</option> 
                                <option value='7'>7</option>
                                <option value='8'>8</option>
                                <option value='9'>9</option>          
                            </select>
                        </td>
                        <td>                            
                            <input type='date' id="theDate" name="DateReceived" placeholder="YYYY-MM-DD" class="form-control mb-1">            
                        </td>
                    </tr>   
                                                 
                </table>
                                            
                        <div class="card-body">                          
                            <a href="AdminPanelFrontEnd.php" class="btn btn-primary mb-1">Back</a>                  
                                <div class="form-inline float-right">
                                    <button name="addBadge" class="btn btn-danger">Add Badges</button>
                                </div>                            
                        </div>      
                    
             
                      
            </div>
        </div>
        
    </div>
    
</div>
