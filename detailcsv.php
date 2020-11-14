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
      $connect = mysqli_connect("us-cdbr-iron-east-01.cleardb.net", "b8a2927a50099e", "8036e8df", "heroku_c1c6c2ef5faa08f"); 
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
