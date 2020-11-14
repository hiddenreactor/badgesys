<?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "scout");  
 if(isset($_POST["user_id"]))  
 {  
      $query = "SELECT * FROM members, sections, colors WHERE members.MemberID = '".$_POST["user_id"]."' AND
      members.SectionID = sections.SectionID AND
      members.ColorID = colors.ColorID
      ";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>

 