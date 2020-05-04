<?php require_once('includes/header.php'); ?>
<?php require_once('includes/function.php'); ?>

<?php
    if(isset($_SESSION['MemberID']) || isset($_SESSION['admin']) || $_POST['logout'])
    {
        session_start();
        session_unset();
        session_destroy();
        header("location:index.php");
    }
?>