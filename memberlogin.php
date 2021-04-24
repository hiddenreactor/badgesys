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
      <h5 class="text-center custom py-3">Kerrisdale Group 33rd Member Login</h5>
    </div>
<?php  
MemberLoginFunction();
?>
    <div class="card-body custom">
      <form action="memberloginbackend.php" method="POST">
        <input type="text" name="memberusername" placeholder="User Name" value="" class="form-control mb-2"> 
        <input type="password" name="memberpass" placeholder="Password" value="" class="form-control mb-3">
          <table style="width:100%">
            <tr>
              <th>
                <a href="index.php" class="btn btn-outline-light">Back</a>  
                <button name="memberlogin" class="btn btn-outline-info">Login</button>
              </th>              
              <th>
                <a href="memberregister.php" class="btn btn-outline-info" style="float: right; pointer-events: none">Member Register</a>
              </th>              
            </tr> 
              <td><a href="./passwordmember/enter_email.php" style="font-size: 11px; color:white;">Forgot Password</a></td>           
          </table>
      </form>
    </div> 
  </div>
</div>

<?php require_once('includes/footer.php'); ?>