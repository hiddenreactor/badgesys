<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="mt-5">
        </div>
                <div class="card">
                    <div class="card-title rounded-top">
                        <h3 class="text-center py-3">Reset Password</h3>
                    </div>
                    <div class="card-body">
                        <form action="new_password.php" method="POST">
                            <?php include('messages.php'); ?>
                            <div class="form-group">
                                <table>
                                    <tr>
                                        <td><label>New password</label></td>
                                        <td><input type="password" name="new_pass"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Confirm new password</label></td>
                                        <td><input type="password" name="new_pass_c"></td>
                                    </tr>                     
                                    <tr>
                                        <th>
                                            <button type="submit" name="new_password-password" class="btn btn-outline-info">Reset</button>
                                        </th>              
                                    </tr>          
                                </table>  
                            </div>             
                        </form>
                    </div> 
                </div>
            </div>
    </div>
</div>
