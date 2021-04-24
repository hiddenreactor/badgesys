<?php

session_start();
require_once('includes/connection.php');

    if(isset($_POST['memberlogin']))
    {
        if(empty($_POST['memberusername']) || empty($_POST['memberpass']))
        {
            header("location:memberlogin.php?empty");
            exit();
        }
        else
        {
            $Member_User = mysqli_real_escape_string($con, $_POST['memberusername']);
            $Password = mysqli_real_escape_string($con, $_POST['memberpass']);

            $query = "SELECT * FROM members WHERE memberusername='".$Member_User."' OR Email='".$Member_User."' ";
            $result = mysqli_query($con,$query);

            if($row = mysqli_fetch_assoc($result))
            {
                $Hash = password_verify($Password, $row['Password']);
                
                if($Hash==false)
                {
                header("location:memberlogin.php?member_password_invalid");
                exit();
                }
                elseif($Hash==true)
                {
                    $_SESSION['memberlogin']=$row['MemberID'];
                    $MemberID = $row['MemberID'];
                    header("location:memberviewfrontend.php?success=$MemberID");
                }
            }  
            else
            {
                header("location:memberlogin.php?member_status");
                exit();
            }  
        }        
    }
           
        
    
    // else
    // {
    //     header("location:login.php");
    //     exit();
    // }




?>