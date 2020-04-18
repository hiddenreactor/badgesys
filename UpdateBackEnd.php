<?php

    require_once('includes/connection.php');
    
    if(isset($_POST['update']))
    {


        $Member = mysqli_real_escape_string($con, $_POST['MemberName']);
        $SID = mysqli_real_escape_string($con, $_POST['SectionID']);
        $CID = mysqli_real_escape_string($con, $_POST['ColorID']);

        $GetID = $_GET['S_ID'];
        $query = "UPDATE members SET MemberName='".$Member."', SectionID=".$SID.", ColorID=".$CID." WHERE MemberID=".$GetID."";
        //echo $query;                                
        $query_run = mysqli_query($con, $query); 
        
        if($query_run)
        {
            echo '<script type="text/javascript">alert("Member Updated")</script>';  
            echo "<script>setTimeout(\"location.href = 'admin-panel.php';\",1000);</script>";
            //echo "<script type="text/javascript">alert("Updated")</script>";
            // header("location:admin-panel.php");
            exit(); 
                
        } else
        {
            echo '<script type="text/javascript">alert("Member Not Updated")</script>';
        }   
    } 
?>