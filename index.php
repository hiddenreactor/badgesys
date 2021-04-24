<?php
require_once('includes/header.php');
require_once('includes/function.php');
?>


<div class="container">
  <div class="row">
    <div class="col-lg-6 m-auto">
      <div class="mt-5">
    </div>

    <div class="card custom">
        <div class="card-title custom rounded-top">
          <h5 class="text-center custom py-3">Kerrisdale Group 33rd Leader Login</h5>
        </div>       
<?php
  LoginFunction();
?>   
        <div class="card-body custom">
          <form action="LoginBackEnd.php" method="POST">
            <input type="text" name="email_user" placeholder="Email or User Name" value="" class="form-control mb-2">
            <input type="password" name="password" placeholder="Password" value="" class="form-control mb-3">
              <table style="width:100%">                
                <tr>
                  <button name="login" class="btn btn-xs btn-outline-info" style="margin-right:3px;">Leader Login</button>
                  <a href="admin.php" class="btn btn-xs btn-outline-light" style="margin-right:3px;">Admin Login</a>
                  <a href="memberlogin.php" class="btn btn-xs btn-outline-warning">Member Login</a>
                  <a href="RegisterFrontEnd.php" class="btn btn-xs btn-info" style="float:right; margin-top:5px; margin-right:1px;">Sign up as Register</a>
                </tr>
                <tr>                
                  <td><a href="./passwordleader/enter_email.php" style="font-size: 11px; color:white;">Forgot Password</a></td>  
                  <td><a href="AdminFrontEnd.php" class="btn btn-xs btn-light" style="float:right; width:92px; margin-top:3px;">Sign up as Admin</a></td>                    
                </tr>                
              </table>          
          </form>
        </div> 
      </div>
  </div>
</div>

<?php require_once('includes/footer.php'); ?>