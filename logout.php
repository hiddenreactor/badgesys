<?php require_once('includes/header.php'); ?>
<?php require_once('includes/function.php'); ?>
<?php
    if(isset($_SESSION['MemberID']) || isset($_SESSION['admin']) || isset($_SESSION['memberlogin']) || $_POST['logout'])
    {
        session_start(); // need to remove
        session_unset();
        session_destroy();
        header("location:index.php");
        // header( "refresh:5;url=login.php" );
    }
?>
