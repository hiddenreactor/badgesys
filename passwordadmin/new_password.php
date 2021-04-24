<?php
require_once('../includes/header.php');
require_once('../includes/function.php');
include('../passwordadmin/app_logic.php');
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
                <h3 class="text-center custom py-3">Reset Password</h3>
                <?php include('../passwordadmin/messages.php'); ?>
            </div>
            <div class="card-body custom">    
                <table>
                    <form action="../passwordadmin/new_password.php" method="POST">
                        <div class="form-group">
                            <label>New password</label>
                                <input type="password" name="new_pass">                                                     
                            <label>Confirm new password</label>
                                <input type="password" name="new_pass_c">
                                <br>
                            <button type="submit" name="new_password" class="btn btn-outline-info">Reset</button>
                        </div>             
                    </form>
                </table> 
            </div>  
        </div> 
    </div> 
</div> 

<?php require_once('../includes/footer.php'); ?>