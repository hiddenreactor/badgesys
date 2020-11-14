<?php
// require_once('includes/connection.php');


// $connect = new PDO("mysql:host=localhost; dbname=scout;", "root", "");
$connect = new PDO("mysql:host=us-cdbr-iron-east-01.cleardb.net; dbname=heroku_c1c6c2ef5faa08f;", "b8a2927a50099e", "8036e8df");
   
    if (isset($_SESSION['admin'])) {

        $query = "SELECT * FROM sections ORDER BY SectionID ASC";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchALL();

?>
<style>
.nav ul {
  list-style:none;
  text-align:center;
  padding:0;
  margin:0;
}
.nav li {
  display: inline-block;
}
.nav a {
  text-decoration:none;
  color:#fff;
  width: 180px;
  display: block;
  padding-top:8px;
  padding-bottom:8px;
  transition: 0.4s;
}
.nav a:hover {
  background:yellow;
  transition:0.6s;
  color:black;
}
.active, .btn:hover {
  background-color: darkgrey;
  color: white;
}
</style>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
 


<nav class="navbar navbar-expand-md navbar-dark bg-dark text-white mt-5">              
      <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="nav">
              <ul>
              <!-- <li><a href="AddMemberFrontEnd.php" class="btn btn-lg btn-outline-warning mb-3 float-left" >Index</a></li>  
              <li><a href="AdminPanelFrontEnd.php?success=<?php echo $_SESSION['admin'] ?>" class="nav-item nav-link">Member Record</a></li>
              <li><a href="InventoryDetailsFrontEnd.php?success=<?php echo $_SESSION['admin'] ?>"  class="nav-item nav-link">Badge Inventory Status</a></li> -->
              <li><a href="" class="btn active">Refresh Page</a></li>  
              <li><a href="AdminPanelFrontEnd.php?success=<?php echo $_SESSION['admin'] ?>" >Member Record</a></li>
              <li><a href="InventoryDetailsFrontEnd.php?success=<?php echo $_SESSION['admin'] ?>" >Badge Inventory Status</a></li>
              </ul>
          </div>
      </div>
  </nav>

  <?php
    }
  ?>
