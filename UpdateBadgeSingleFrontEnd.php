
 <?php  
 //fetch.php  
 $connect = mysqli_connect("us-cdbr-iron-east-01.cleardb.net", "b8a2927a50099e", "8036e8df", "heroku_c1c6c2ef5faa08f");
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
 
