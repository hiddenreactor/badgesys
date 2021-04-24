
 <?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "scout");  
 if(isset($_POST["u_id"]))  
 {  
      $query = "SELECT * FROM members WHERE members.MemberID = '".$_POST["u_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
 