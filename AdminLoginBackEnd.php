<?php

session_start();
require_once('includes/connection.php');

    if(isset($_POST['login']))
    {
        if(empty($_POST['email']) || empty($_POST['password']))
        {
            header("location:AdminPanelFrontEnd.php?empty");
        }
        else
        {
            $Email = mysqli_real_escape_string($con, $_POST['email']);
            $Password = mysqli_real_escape_string($con, $_POST['password']);

            $query = "SELECT * FROM admin WHERE AdminEmail='".$Email."' and AdminPassword=MD5('".$Password."') ";
            $result = mysqli_query($con, $query);

            if($row=mysqli_fetch_assoc($result))
            {
                $_SESSION['admin']=$row['AdminName'];
                header("location:AdminPanelFrontEnd.php");
            }
            else
            {
                header("location:AdminPanelFrontEnd.php?Admin_Invalid");
            }
        }
    }
    else
    {
        header("location:AdminPanelFrontEnd.php");
    }

?>