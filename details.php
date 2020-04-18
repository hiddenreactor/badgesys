<?php 

require_once('includes/header.php');
require_once('includes/connection.php');

// if(isset($_SESSION['MemberID']) || isset($_SESSION['admin']))
// {
//     $_SESSION['GET'] = $GetID = $_GET['success'];
//     $query = "SELECT * FROM members, colors, sections, category, badges, earned WHERE
//     members.memberID = earned.memberID AND 
//     members.colorID = colors.colorID AND 
//     members.sectionID = sections.sectionID AND
//     badges.badgeID = earned.badgeID AND
//     category.categoryID = badges.categoryID AND
//     earned.Level AND earned.DateReceived";
    
// }

require_once('includes/footer.php'); 

?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
function getName(val)
{
    $.ajax({
        type: "POST",
        url: "get_Name.php",
        data: 'MemberID=' + val,
        success: function(data){
            $("#name").html(data);
        }
    });
}
</script>

<div class="container">

    <div class="row">
        <div class="col">
            <div class="card bg-dark text-white mt-3">
             
                <h3 class="text-center py-3" id="name" >Leader View </h3>
              
            </div>
        </div>
    </div>

    <div class="row">
  
        <div class="col-lg-3">
            <div class="card mt-3">
                <div class="card-title bg-secondary text-white py-2 rounded-top">
                    <select class="form-control mb-2" id="sections" onChange="getMember(this.value);">
                        <option value="null">Select Section</option>
                    <?php
                    $query = "SELECT * FROM sections ";
                    $result = mysqli_query($con, $query);   
                    while($row=mysqli_fetch_assoc($result))
                        { 
                    ?>
                            <option value = "<?php echo $row["SectionID"]; ?>"> <?php echo $row["SectionName"]; ?> </option>
                    <?php    
                        }
                    ?>                   
                    </select>
                    <select class="form-control mb-2" id="members" onChange="getDetail(this.value); getName(this.value)">
                    <option value="null">Select Member</option>               
                    </select>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
        
        <div class=col-lg-9>
            <div class="card mt-3">
                <table class="text-center table table-striped bg-info text-white" id="details" value ="getName(this.value);" >    
                    <tr>                        
                        <td>Member Color</td>
                        <td>Badge Name</td>
                        <td>Badge Category</td>
                        <td>Badge Level</td>
                        <td>Date Received</td>
                    </tr>     
                </table>
            </div >         
        </div>    
    </div>
</div>

