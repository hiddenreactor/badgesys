<?php  
require_once('includes/connection.php');
      //export.php  
 if(isset($_POST["detailcsv"]))  
 {   
     $LeaderID = $_GET['success'];
     echo "Export Report in CSV.";
     echo "\n";
     echo "Report requested by: ";
     $query1 = "SELECT FName, LName from user_data WHERE user_data.ID = $LeaderID";
     $result = mysqli_query($con, $query1);
     $row = mysqli_fetch_assoc($result);
     echo $row["FName"];
     echo " ";
     echo $row["LName"];
     echo "\n";
      $connect = mysqli_connect('us-cdbr-east-03.cleardb.com','b9cd122ae5026e','287b0048','heroku_d1dabaaefc9d538');
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=member_detail.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Member Name', 'Register Date', 'Current Section', 'Email', 'Contact'));  
      $query = "SELECT MemberName, Date, SectionName, Email, Contact FROM members, sections WHERE 
      members.SectionID = sections.SectionID  ORDER BY members.MemberID
                    "; 
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  
