<?php

    require_once('includes/connection.php');
    if(isset($_GET['Del']))
    {
            $DelID = $_GET['Del'];
            $query = "Select * FROM badge_data WHERE ID='".$DelID."'";
            $result = mysqli_query($con, $query);    
            
            while($row=mysqli_fetch_assoc($result))
            {
                $Img = $row['Img'];
            }

            $DelQuery = "Delete FROM parent_data WHERE ID='".$DelID."'";
            $ResultQuery = mysqli_query($con, $DelQuery);

            if($ResultQuery)
            {
                unlink("images/$Img");
                header("location:admin-panel.php");
            }
            else
            {
                echo 'Something is wrong';
            }
    }

?>