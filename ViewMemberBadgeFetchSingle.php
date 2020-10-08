<?php  
 if(isset($_POST["user_id"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "scout");  
    //   $query = "SELECT * FROM members WHERE MemberID = '".$_POST["user_id"]."'"; 
      

      $query = "SELECT * FROM members WHERE members.MemberID = '".$_POST["user_id"]."' ORDER BY members.MemberName DESC";
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result); 
      $output .= '
      <p>Badge Detail for <b>'.$row["MemberName"].'</b></p>
      <div class="table-responsive">  
           <table class="table table-bordered table-striped">
           <tr>  
                    <td>Section</td>
                    <td>Member Color</td>
                    <td>Badge Name</td>
                    <td>Badge Category</td>
                    <td>Badge Level</td>
                    <td>Date Tested</td>
                    <td>Tested By</td>
                </tr>            
           ';  

           $query = "SELECT * FROM members, colors, sections, earned, badges, badgelevel, admin, category WHERE 
           members.MemberID = '".$_POST["user_id"]."' AND 
           earned.ColorID = colors.ColorID AND 
           earned.SectionID = sections.SectionID AND
           earned.BadgeID = badges.BadgeID AND
           earned.LevelID = badgelevel.LevelID AND 
           earned.AdminID = admin.AdminID AND 
           category.CategoryID = badges.CategoryID AND
           earned.MemberID = '".$_POST["user_id"]."' ORDER BY earned.BadgeEarnedID DESC
           ";

$result = mysqli_query($connect, $query);  
$row = mysqli_fetch_array($result);
           while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
          
                <tr>  
                     <td>'.$row["SectionName"].'</td>
                     <td>'.$row["Color"].'</td> 
                     <td>'.$row["BadgeName"].'</td> 
                     <td>'.$row["CategoryName"].'</td> 
                     <td>'.$row["Levels"].'</td> 
                     <td>'.$row["DateReceived"].'</td> 
                     <td>'.$row["FName"].'</td> 

                </tr>  
               
           ';  
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;  
 }  
 ?>