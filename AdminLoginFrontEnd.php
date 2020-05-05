<?php require_once('includes/header.php'); ?>
<?php require_once('includes/function.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-6">
        <div class="card bg-dark text-white mt-5">
          <h3 class="text-center py-3"> Administrator Login </h3>
        </div>
    </div>
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
                header("location:AdminPanelFrontEnd.php");
            }
          ?>
        
  <div class="row">
    <div class="col-lg-6">
      <div class="card"> 
          <div class="card-body">
          <form action="AdminLoginBackEnd.php" method="POST">
              <input type="text" name="email" placeholder="Email" value="" class="form-control mb-2">
              <input type="password" name="password" placeholder="Password" value="" class="form-control mb-3">
              <a href="index.php" class="btn btn-primary mb-1">Back</a>                  
                <div class="form-inline float-right">
                  <button name="login" class="btn btn-danger">Administrator Login</button>
                </div> 
            </form>
          </div> 
      <div>
    </div>
  </div>

</div>

