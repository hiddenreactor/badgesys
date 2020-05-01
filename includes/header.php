<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    
  
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" href="bootstrap/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
    
  <title>Group 33 Badge Tracking Portal</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
      <div class="container">
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar" type="button" name="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a href="login.php" class="navbar-brand"><h3>Group 33 Badge Tracking Portal</h3></a>
        <div class="collapse navbar-collapse" id ="Navbar">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <?php 
                if(isset($_SESSION['MemberID']) || isset($_SESSION['admin']))
                {
                  echo '<form action="logout.php" method="POST">
                        <button class=btn btn-link name="logout">Logout</button>
                        </form>';
                }
                else
                {
                  echo '<a href="login.php" style="color:black; class="bg-light topnav-right">Login</a>';
                }
              ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
