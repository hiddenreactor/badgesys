<?php

    require_once('includes/connection.php');

    if(isset($_POST['addBadge']))
    {
    $GetID = $_GET['M_ID'];   
    $SectionID = mysqli_real_escape_string($con, $_POST['SectionID']);
    $ColorID = mysqli_real_escape_string($con, $_POST['ColorID']); 
    $CategoryID = mysqli_real_escape_string($con, $_POST['CategoryID']);
    $BadgeID = mysqli_real_escape_string($con, $_POST['BadgeID']);
    $Level = mysqli_real_escape_string($con, $_POST['Level']);
    $Date = mysqli_real_escape_string($con, $_POST['DateReceived']);

    echo $SectionID;
    echo $ColorID;
              
  
  if(empty($SectionID) || empty($ColorID) || empty($BadgeID) || empty($Level) || empty($Date))
  {
    //   header("location:addBadge.php?Empty=$GetID");  
      header("location:message.php"); 
      exit();
  }    
    else
    {    
        $GetID = $_GET['M_ID'];
        $query = "INSERT INTO earned (MemberID, SectionID, ColorID, BadgeID, Level, DateReceived) VALUES ('$GetID', '$SectionID', '$ColorID', '$BadgeID', '$Level', '$Date')";
                  
        mysqli_query($con, $query);
        echo $query;

        if($query)
        {
            // echo '<script type="text/javascript">alert("Badge Added")</script>';  
            // echo "<script>setTimeout(\"location.href = 'admin-panel.php';\",1000);</script>";
            
            exit(); 
                
        }
        
    }
 
        }        
        else
        {
        header("location:addBadgeBackEnd.php?UnsuccessInsert");
        exit();
        }

 ?>
