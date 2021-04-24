
 <?php  
 //fetch.php  
 $connect = mysqli_connect('us-cdbr-east-03.cleardb.com','b9cd122ae5026e','287b0048','heroku_d1dabaaefc9d538');
 if(isset($_POST["m_id"]))  
 {  
      $query = "SELECT * FROM members WHERE members.MemberID = '".$_POST["m_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
 
