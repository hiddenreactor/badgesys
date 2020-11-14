<?php  
require_once('includes/connection.php');
//export.php  
$connect = mysqli_connect("us-cdbr-iron-east-01.cleardb.net", "b8a2927a50099e", "8036e8df", "heroku_c1c6c2ef5faa08f");
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
