
 <?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "scout");  
 if(isset($_POST["m_id"]))  
 {  
      $query = "SELECT * FROM members WHERE members.MemberID = '".$_POST["m_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
 