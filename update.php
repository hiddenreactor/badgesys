<?php

    require_once('includes/connection.php');
    if(isset($_POST['update']))
    {

                   
        // $Image = $_FILES['image']['name'];
        // $Type = $_FILES['image']['type'];
        // $Temp = $_FILES['image']['tmp_name'];
        // $Size = $_FILES['image']['size'];

        // $Ext = explode('.',$Image);
        // $TrueExt = (strtolower(end($Ext)));
        // $AllowImg = array('jpg', 'jpeg', 'png');
        // $Target = "images/".$Image;

        //print_r($Target);

        $Member = mysqli_real_escape_string($con, $_POST['MemberName']);
        $SID = mysqli_real_escape_string($con, $_POST['SectionID']);
        //$ID = mysqli_real_escape_string($con, $_POST['ColorID']);
        // $LastName = mysqli_real_escape_string($con, $_POST['LName']); 
        // $UserName = mysqli_real_escape_string($con, $_POST['UName']);
        // $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
        // $Gender = mysqli_real_escape_string($con, $_POST['Gender']);
        // $Email = mysqli_real_escape_string($con, $_POST['Email']);
        // $Password = mysqli_real_escape_string($con, $_POST['Password']);

        $GetID = $_GET['S_ID'];
        //$query = "UPDATE members SET MemberName='".$MemberName."' WHERE MemberID='".$GetID."'";
        $query = "UPDATE members SET MemberName='".$Member."', SectionID=".$SID." WHERE MemberID=".$GetID."";
           echo $query;                                 
        $query_run = mysqli_query($con, $query); 
        if($query_run)
        {
            echo '<script type="text/javascript">alert("Updated")</script>'; 
            //header("location:admin-panel.php");
            //exit();       
        } else
        {
            echo '<script type="text/javascript">alert("Not Updated")</script>';
        }   
        // $QueryImg = "SELECT * FROM parent_data WHERE ID='".$GetID."'";
        // $ResultImg = mysqli_query($con, $QueryImg);

        // if(empty($Image) || empty($FirstName) || empty($LastName) || empty($UserName) || empty($DOB) || empty($Gender) || empty($Email) || empty($Password))
        // {
        //     echo 'Please fill in the blanks';
        // }   
        // else
        // {
        //     if(!preg_match("/^[a-z,A-Z]*$/",$FirstName) || !preg_match("/^[a-z,A-Z]*$/",$LastName) || !preg_match("/^[a-z,A-Z]*$/",$UserName))
        //     {
        //         echo 'Please enter valid characters';
        //     }
        //     else
        //     {
        //         if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
        //         {
        //             echo 'Please enter valid email';
        //         }
        //         else
        
        //         {
        //             $HashPass = password_hash($Password, PASSWORD_DEFAULT);
                    
        //             while($row = mysqli_fetch_assoc($ResultImg))
        //             {
        //                 $OldImage = $row['Img'];
        //             }

        //             if(in_array($TrueExt, $AllowImg))
        //             {
        //                 if($Size < 1000000)
        //                 {
        //                     unlink("images/$OldImage"); //remove old images from directory
        //                     $query = "UPDATE parent_data SET Img='".$Image."', FName='".$FirstName."', LName='".$LastName."', UName='".$UserName."', DOB='".$DOB."', Gender='".$Gender."', Email='".$Email."', Password='".$HashPass."' WHERE ID='".$GetID."'";
                                            
        //                     mysqli_query($con, $query);
        //                     move_uploaded_file($Temp, $Target);

        //                     header("location:admin-panel.php");
        //                     exit();
        //                     }
        //                 else
        //                 {
        //                 echo ' Image Size is too large';
        //                 }
        //             }
                    
        //         }
        //     }
        // }
    } 
?>