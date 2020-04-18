<?php require_once('includes/header.php'); ?>
<?php require_once('includes/function.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 m-auto">
        <div class="mt-5">
            <img src="images/scout.png" width="150" height="150" class="d-flex m-auto">
        </div>
        <div class="card">
          <div class="card-title bg-dark rounded-top">
            <h3 class="text-center text-white py-3">Group 33 Leader Login</h3>
          </div>

          <?php            
            LoginFunction();
          ?>

          <div class="card-body">

            <form action="loginphp.php" method="POST">
              <input type="text" name="email_user" placeholder="Email or User Name" value="" class="form-control mb-2">
              <input type="password" name="password" placeholder="Password" value="" class="form-control mb-3">
              <button name="login" class="btn btn-success">Leader Login</button>
              <a href="admin-login.php" class="btn btn-danger">Administrator Login</a>
              <a href="RegisterFrontEnd.php" class="card-link float-right">Leader Register</a>              
            </form>
            

          </div>
        </div>
      </div>
    </div>
  </div>
<?php require_once('includes/footer.php'); ?>
