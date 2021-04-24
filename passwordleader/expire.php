<?php
require_once('../includes/header.php');
require_once('../includes/function.php');
include('../passwordleader/app_logic.php');
?>
<style>
    .msg {
        margin: 5px auto;
        border-radius: 5px;
        border: 1px solid red;
        background: pink;
        text-align: left;
        color: brown;
        padding: 10px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="mt-5">
        </div>

        <div class="card custom">
            <div class="card-title custom rounded-top">
                <h3 class="text-center custom py-3"></h3>
            </div>
            <div class="card-body custom">
                <form class="login-form" action="login.php" method="post" style="text-align: center;">
                    <p>We have sent an email to  <b><?php echo $_GET['email'] ?></b> 24 hours ago.</p>
                    <p>This password request has expired or completed.</p>
                    <p>Please resend if needed.</p>
                </form>   
            </div>             
        </div>
    </div>
</div>

<?php require_once('../includes/footer.php'); ?>



