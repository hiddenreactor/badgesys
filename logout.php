<?php require_once('includes/header.php'); ?>
<?php require_once('includes/function.php'); ?>
<?php
    if(isset($_SESSION['MemberID']) || ($_POST['logout']))
    {
        session_start(); // need to remove
        session_unset();
        session_destroy();
        header("location:index.php");
        exit();          
    }
    elseif(isset($_SESSION['admin']) || ($_POST['logout']))
    {
        session_start(); // need to remove
        session_unset();
        session_destroy();
        header("location:admin.php"); 
        exit();         
    }
    elseif(isset($_SESSION['memberlogin']) || ($_POST['logout']))
    {
        session_start(); // need to remove
        session_unset();
        session_destroy();
        header("location:memberlogin.php"); 
        exit();           
    }
?>

