<?php  
require_once('includes/connection.php');
//export.php  
$connect = mysqli_connect("us-cdbr-iron-east-01.cleardb.net", "b8a2927a50099e", "8036e8df", "heroku_c1c6c2ef5faa08f");
$output = '';
if(isset($_POST["excel"]))
{
        $M_ID = $_GET['success'];    
        $query1 = "SELECT MemberName from members WHERE members.MemberID = $M_ID";
        $result = mysqli_query($con, $query1);
        $row = mysqli_fetch_assoc($result);
        echo "Export Report in Excel.";
        echo "\r\n";
        echo "\r\n";
        echo "\n";
        echo "Badges earned by ";
        echo $row["MemberName"];
        echo "\r\n";
    $query = "SELECT SectionName, BadgeName, CategoryName, Levels, DateReceived, FName FROM members, colors, sections, earned, badges, badgelevel, admin, category WHERE 
    earned.MemberID = members.MemberID   AND 
    earned.ColorID = colors.ColorID AND 
    earned.SectionID = sections.SectionID AND
    earned.BadgeID = badges.BadgeID AND
    earned.LevelID = badgelevel.LevelID AND 
    earned.AdminID = admin.AdminID AND 
    category.CategoryID = badges.CategoryID AND
    earned.MemberID = '".$M_ID."' ORDER BY earned.BadgeEarnedID DESC
                  ";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Section</th>  
                         <th>Badge</th>  
                         <th>Category</th>  
                         <th>Badge Level</th> 
                         <th>Date Tested</th> 
                         <th>Tested By</th> 
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
                    <tr>  
                         <td>'.$row["SectionName"].'</td>  
                         <td>'.$row["BadgeName"].'</td>  
                         <td>'.$row["CategoryName"].'</td>  
                         <td>'.$row["Levels"].'</td> 
                         <td>'.$row["DateReceived"].'</td> 
                         <td>'.$row["FName"].'</td> 
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xlm');
  header('Content-Disposition: attachment; filename=badge_earned.xls');
  echo $output;
 }
}
?>
