<?php

require_once('includes/connection.php');

if(isset($_POST['addBadge2']))
{
  //print_r($Target);
//   $Member = mysqli_real_escape_string($con, $_POST['MemberName']);
  $MemberID = mysqli_real_escape_string($con, $_POST['MemberID']);
  $SectionID = mysqli_real_escape_string($con, $_POST['SectionID']);
  $ColorID = mysqli_real_escape_string($con, $_POST['ColorID']); 
  $CategoryID = mysqli_real_escape_string($con, $_POST['CategoryID']);
  $BadgeID = mysqli_real_escape_string($con, $_POST['BadgeID']);
  $Level = mysqli_real_escape_string($con, $_POST['Level']);
  $Date = mysqli_real_escape_string($con, $_POST['DateReceived']);
  
//   $ID = '';


                                 
  
  if(empty($SectionID) || empty($ColorID) || empty($BadgeID) || empty($Level) || empty($Date))
  {
      header("location:addBadge.php?Empty");
      exit();
  }    
    else
    {    
        //$query = "INSERT INTO earned (MemberID, SectionID, ColorID, CategoryID, BadgeID, Level, Date) VALUES ('$MemberID','$SectionID', '$ColorID', '$CategoryID', '$BadgeID', '$Level', '$Date')";
        $query = "INSERT INTO earned (MemberID, SectionID, ColorID, BadgeID, Level, DateReceived) VALUES ('$MemberID', '$SectionID', '$ColorID', '$BadgeID', '$Level', '$Date')";
                  
        mysqli_query($con, $query);
        echo $query;

        // if($query)
        // {
        //     echo '<script type="text/javascript">alert("Member Updated")</script>';  
        //     echo "<script>setTimeout(\"location.href = 'admin-panel.php';\",1000);</script>";
        //     //echo "<script type="text/javascript">alert("Updated")</script>";
        //     // header("location:admin-panel.php");
        //     exit(); 
                
        // }
        // header("location:addBadge.php?addSuccess");
        // exit();
        
    }
 
    //     }        
    //     else
    //     {
    //     header("location:addBadge.php?UnsuccessInsert");
    //     exit();
    //     }
    }

 ?>
