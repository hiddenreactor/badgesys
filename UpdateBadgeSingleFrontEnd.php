
 <?php  
 //fetch.php  
 $connect = mysqli_connect('us-cdbr-east-03.cleardb.com','b9cd122ae5026e','287b0048','heroku_d1dabaaefc9d538');
 if(isset($_POST["badge_id"]))  
 {  
      $query = "SELECT * FROM inventorys, badges, category, badgelevel WHERE 
      inventorys.InventoryID = '".$_POST["badge_id"]."' AND
      inventorys.BadgeID = badges.BadgeID AND
      inventorys.CategoryID = category.CategoryID AND
      inventorys.LevelID = badgelevel.LevelID
      ";  
     //  $query = "SELECT * FROM inventory WHERE inventory.inventoryid = '".$_POST["badge_id"]."'";
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
 
