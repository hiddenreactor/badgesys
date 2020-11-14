
 <?php  
 //fetch.php  
 $connect = mysqli_connect("us-cdbr-iron-east-01.cleardb.net", "b8a2927a50099e", "8036e8df", "heroku_c1c6c2ef5faa08f");
 if(isset($_POST["user_id"]))  
 {  
      $query = "SELECT * FROM members WHERE members.MemberID = '".$_POST["user_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
 
