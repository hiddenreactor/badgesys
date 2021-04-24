<?php

if (isset($_POST['resetPass'])) {
    
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/badgesys/resetPassword.php/create_newpass.php?selector=".$selector."&valiator=".bin2hex($token);

    $expires = date("U") + 30;

} else {
    header("location: ../index.php");
}
?>