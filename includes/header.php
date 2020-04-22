<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
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
