<?php 

require_once('includes/header.php');
require_once('includes/function.php');
?>

<div class="container">
  <div class="row">
    <div class="col-lg-6">
        <div class="card bg-dark text-white mt-5">
          <h3 class="text-center py-3"> Leader Login </h3>
        </div>
    </div>
  </div>
        
  <div class="row">
    <div class="col-lg-6">
      <div class="card"> 
          <div class="card-body">
            <form action="LoginBackEnd.php" method="POST">
              <input type="text" name="email_user" placeholder="Email or User Name" value="" class="form-control mb-2">
              <input type="password" name="password" placeholder="Password" value="" class="form-control mb-3">
              <button name="login" class="btn btn-success">Leader Login</button>
              <a href="AdminLoginFrontEnd.php" class="btn btn-danger">Administrator Login</a>
              <a href="RegisterFrontEnd.php" class="card-link float-right">Leader Register</a>              
            </form>
          </div> 
      <div>
    </div>
  </div>

</div>

    <?php require_once('includes/footer.php'); ?>