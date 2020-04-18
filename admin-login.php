<?php require_once('includes/header.php'); ?>
<?php require_once('includes/function.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 m-auto">
        <div class="mt-5">
            <img src="images/p.png" width="150" height="150" class="d-flex m-auto">
        </div>
        <div class="card">
          <div class="card-title bg-dark rounded-top">
            <h3 class="text-center text-white py-3">Administrator Login</h3>
          </div>

          <?php            
            $Message = "";
            if(isset($_GET['empty']))
            {
                $Message = "One of the field is blank.";
                echo '<div class="alert alert-danger text-center">'.$Message.'</div>';
            }
            if(isset($_GET['Admin_Invalid']))
            {
                $Message = "Please enter your Admin Email and Password.";
                echo '<div class="alert alert-danger text-center">'.$Message.'</div>';
            }
            if(isset($_SESSION['admin']))
            {
                header("location:admin-panel.php");
            }
          ?>

          <div class="card-body">

            <form action="adminphp.php" method="POST">
              <input type="text" name="email" placeholder="Email" value="" class="form-control mb-2">
              <input type="password" name="password" placeholder="Password" value="" class="form-control mb-3">
              <a href="login.php" class="btn btn-primary mb-1">Back</a>                  
                <div class="form-inline float-right">
                  <button name="login" class="btn btn-danger">Administrator Login</button>
                </div> 
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php require_once('includes/footer.php'); ?>
