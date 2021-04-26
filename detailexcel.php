<?php  
require_once('includes/connection.php');
//export.php  
$output = '';
if(isset($_POST["detailexcel"]))
{
     $LeaderID = $_GET['success'];    
     $query1 = "SELECT FName, LName from user_data WHERE user_data.ID = $LeaderID";
     $result = mysqli_query($con, $query1);
     $row = mysqli_fetch_assoc($result);
     echo "Export Report in Excel.";
     echo "\n";
     echo "<br />";
     echo "Export Requested by: ";
     echo $row["FName"];
     echo "\r\n";
     echo $row["LName"];
    $query = "SELECT MemberName, Date, SectionName, Email, Contact FROM members, sections WHERE 
    members.SectionID = sections.SectionID  ORDER BY members.MemberID
                  ";
 $connect = mysqli_connect('us-cdbr-east-03.cleardb.com','b9cd122ae5026e','287b0048','heroku_d1dabaaefc9d538');  
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Member Name</th>  
                         <th>Member Register Date</th>  
                         <th>Current Section</th>  
                         <th>Email</th>  
                         <th>Contact</th> 
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
                    <tr>  
                         <td>'.$row["MemberName"].'</td>
                         <td>'.$row["Date"].'</td>   
                         <td>'.$row["SectionName"].'</td>  
                         <td>'.$row["Email"].'</td>  
                         <td>'.$row["Contact"].'</td> 
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xlm');
  header('Content-Disposition: attachment; filename=member_details.xls');
  echo $output;
 }
}
?>
