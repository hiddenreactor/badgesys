<?php
require_once('includes/header.php');
require_once('includes/function.php');
?>


<div class="container">
  <div class="row">
    <div class="col-lg-6 m-auto">
      <div class="mt-5">
      </div>

      <div class="card">
        <div class="card-title bg-dark rounded-top">
          <h5 class="text-center text-white py-3">Kerrisdale Group 33rd User Login</h5>
        </div>
   
    
<?php
  LoginFunction();
?>
   
            <div class="card-body">
              <form action="LoginBackEnd.php" method="POST">
                <input type="text" name="email_user" placeholder="Email or User Name" value="" class="form-control mb-2">
                <input type="password" name="password" placeholder="Password" value="" class="form-control mb-3">
                <table style="width:100%">
                <tr>
                <th><button name="login" class="btn btn-outline-secondary">Login</button>
                <button name="admin" class="btn btn-outline-dark">Login as Admin</button>
                <!-- <a href="AdminLoginFrontEnd.php" class="btn btn-primary">Administrator Login</a> -->
                </th>
                <th><a href="RegisterFrontEnd.php" class="btn btn-sm btn-outline-secondary" style="float:right">Sign up as Register</a></th>
                </tr>
                <tr>      
                <td></td>
                <td><a href="AdminFrontEnd.php" class="btn btn-sm btn-outline-dark" style="float:right; width:136px;">Sign up as Admin</a></td>
                </tr>  
                </table>          
              </form>
            </div> 
        </div>
    </div>
</div>
</div>
</div>

<?php require_once('includes/footer.php'); ?>