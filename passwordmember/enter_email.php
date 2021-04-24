<?php
require_once('../includes/header.php');
require_once('../includes/function.php');
include('../passwordmember/app_logic.php');
?>

<style>
.msg {
margin: 5px auto;
border-radius: 5px;
border: 2px solid #918543;
background: #B6A754;
text-align: left;
color: #6D6432;
padding: 10px;
}
input {
display: block;
box-sizing: border-box;
border-radius: 5px;
border: 2px solid #B6A754;
width: 100%;
}
</style>

<div class="container">
  <div class="row">
    <div class="col-lg-6 m-auto">
      <div class="mt-5">
    </div>
    <div class="card custom">
      <div class="card-title custom rounded-top">
        <h5 class="text-center custom py-3">Member Password Reset</h5>
        <?php include('../passwordmember/messages.php'); ?>
      </div>
      <div class="card-body custom">
        <form action="../passwordmember/enter_email.php" method="POST">
            <label>Your Email Address</label>
          <input type="email" name="email" value="" class="form-control mb-2"> 
            <table style="width:100%">
              <tr>
                <th><br>
                  <a href="../index.php" class="btn btn-secondary">Back</a>  
                  <button type="submit" name="reset-password" class="btn btn-outline-info">Reset</button>
                </th>              
              </tr>          
            </table>          
        </form>
      </div> 
    </div>
  </div>
</div>

<?php require_once('../includes/footer.php'); ?>