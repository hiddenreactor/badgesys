<?php  
require_once('includes/connection.php');
      //export.php  
 if(isset($_POST["csv"]))  
 {
      echo "Get Success is ";
      echo $_GET['success'];
      echo " ";
      echo "\r\n";    
      $M_ID = $_GET['success'];
      echo "Export Report in Excel.";
        echo "\r\n";
        echo "\r\n";
        echo "\r\n";
        echo "Badges earned by ";
        $query1 = "SELECT MemberName from members WHERE members.MemberID = $M_ID";
        $result = mysqli_query($con, $query1);
        $row = mysqli_fetch_assoc($result);
        echo $row["MemberName"];
        echo "\r\n";      
      $connect = mysqli_connect("localhost", "root", "", "scout");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=member_earned.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Section', 'Badge', 'Category', 'Badge Level', 'Date Tested', 'Tested By'));  
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
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  

 ?>  


