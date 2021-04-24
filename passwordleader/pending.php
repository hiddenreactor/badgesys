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
                <h3 class="text-center custom py-3">Reset Message</h3>
            </div>

            <div class="card-body custom">
                <form action="../passwordleader/enter_email.php" method="POST">
                    <?php include('../passwordleader/messages.php'); ?>
                        <p>
                            We sent an email to  <b><?php echo $_GET['email'] ?></b> to help you recover your account. 
                        </p>
                    <p>Please login into your email account and click on the link we sent to reset your password</p>
                </form>     
            </div> 
        </div>
    </div>
</div>
</div>

<?php require_once('../includes/footer.php'); ?>