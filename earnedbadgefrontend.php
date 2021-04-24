<?php  
 //fetch.php  
 $connect = mysqli_connect('us-cdbr-east-03.cleardb.com','b9cd122ae5026e','287b0048','heroku_d1dabaaefc9d538');
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

 
