<?php require_once('includes/header.php'); ?>
<?php require_once('includes/function.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 m-auto">

        <div class="mt-5">
        </div>

        <div class="card">
          <div class="card-title bg-dark rounded-top">
            <h3 class="text-center text-white py-3">Leader Register</h3>
          </div>

          <?php
            
            RegisterFunction();
            
          ?>

          <div class="card-body">
            <form action="RegisterBackEnd.php" method="POST" enctype="multipart/form-data">
              <input type="text" name="FName" placeholder="First Name" value="" class="form-control mb-2">
              <input type="text" name="LName" placeholder="Last Name" value="" class="form-control mb-2">
              <input type="text" name="UName" placeholder="User Name" value="" class="form-control mb-2">
              <input type="email" name="Email" placeholder="Email" value="" class="form-control mb-2">
              <input type="password" name="Password" placeholder="Password" value="" class="form-control mb-3">
              <input type="password" name="AccessCode" placeholder="Access Code" value="" class="form-control mb-3">                                      
              <a href="login.php" class="btn btn-primary mb-1">Back</a>                  
                <div class="form-inline float-right">
                  <button name="register" class="btn btn-success">Register</button>
                </div>                        
            </form>
          </div>
          
        </div>
      </div>
    </div>
  </div>
<?php require_once('includes/footer.php'); ?>
