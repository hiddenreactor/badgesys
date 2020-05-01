<?php

require_once('includes/connection.php');

$Access = "*Admin_Scout33#";	// Accesscode

if(isset($_POST['register']))
{

  $FirstName = mysqli_real_escape_string($con, $_POST['FName']);
  $LastName = mysqli_real_escape_string($con, $_POST['LName']); 
  $UserName = mysqli_real_escape_string($con, $_POST['UName']);
  $Email = mysqli_real_escape_string($con, $_POST['Email']);
  $Password = mysqli_real_escape_string($con, $_POST['Password']);
  $AccessCode = mysqli_real_escape_string($con, $_POST['AccessCode']);
  
  $ID = '';

 
        if(empty($FirstName) || empty($LastName) || empty($UserName) || empty($Email) || empty($Password))
        {
            header("location:RegisterFrontEnd.php?empty");
            exit();
        }
            else
            {
            if(!preg_match("/^[a-z,A-Z]*$/",$FirstName) || !preg_match("/^[a-z,A-Z]*$/",$LastName) || !preg_match("/^[a-z,A-Z]*$/",$UserName))
            {
                header("location:RegisterFrontEnd.php?character");
                exit();
            }
            else
            {
                if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
                {
                header("location:RegisterFrontEnd.php?ValidEmail");
                exit();
                }
                else
                {
                $query = "SELECT * FROM user_data WHERE UName='".$UserName."'";
                $result = mysqli_query($con,$query);

                if(mysqli_fetch_assoc($result))
                {
                    header("location:RegisterFrontEnd.php?UserTaken");
                    exit();
                }
                else
                {
                    $query = "SELECT * FROM user_data WHERE Email='".$Email."'";
                    $result = mysqli_query($con,$query);

                    if(mysqli_fetch_assoc($result))
                    {
                    header("location:RegisterFrontEnd.php?EmailTaken");
                    exit();
                    }

                        if($AccessCode !== $Access)
                        {
                        header("location:RegisterFrontEnd.php?code");
                        exit();
                        }
                    else
                    {
                        $HashPass = password_hash($Password, PASSWORD_DEFAULT);
                        date_default_timezone_set('America/Vancouver');
                        $Date = date("d/m/y");
                        
                        $query = "INSERT INTO user_data (FName, LName, UName, Email, Password, Date) VALUES ('$FirstName', '$LastName', '$UserName', '$Email', '$HashPass', '$Date')";
                                                                 
                        mysqli_query($con, $query);
                            header("location:RegisterFrontEnd.php?success");
                            exit();
                   
                    }
                }
                }
            }
            }
        }
                                 
  
else
{
  header("location:register.php");
}

 ?>
