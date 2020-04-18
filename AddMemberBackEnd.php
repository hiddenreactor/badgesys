<?php

require_once('includes/connection.php');

if (isset($_POST['addMember'])) {

  //print_r($Target);

    $MemberName = mysqli_real_escape_string($con, $_POST['MemberName']);
    $SectionID = mysqli_real_escape_string($con, $_POST['SectionID']);
    $ColorID = mysqli_real_escape_string($con, $_POST['ColorID']);
    $Email = mysqli_real_escape_string($con, $_POST['Email']);
    $Contact = mysqli_real_escape_string($con, $_POST['Contact']);
  
    $ID = '';
    $phone = "(000) 000-0000";
                                 
  
    if (empty($MemberName) || empty($SectionID) || empty($ColorID) || empty($Email) || empty($Contact)) {
        header("location:AddMemberFrontEnd.php?empty");
        exit();
    } else {
        if (!preg_match('/[^A-Za-z0-9_-\s]/', $MemberName)) {
            header("location:AddMemberFrontEnd.php?character");
            exit();
        } else {
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                header("location:AddMemberFrontEnd.php?ValidEmail");
                exit();
            } else {
                $query = "SELECT * FROM members WHERE Email='".$Email."'";
                $result = mysqli_query($con, $query);

                if (mysqli_fetch_assoc($result)) {
                    header("location:AddMemberFrontEnd.php?EmailTaken");
                    exit();
                } else {
                    if (!preg_match('/^[0-9\-]|[\+0-9]|[0-9\s]|[0-9()]*$/', $phone)) {
                        header("location:AddMemberFrontEnd.php?phone");
                        exit();
                    } else {
                        // $HashPass = password_hash($Password, PASSWORD_DEFAULT);
                        date_default_timezone_set('America/Vancouver');
                        $date = date("d/m/y");

                        $query = "INSERT INTO members (MemberName, SectionID, ColorID, Email, Contact, Date) VALUES ('$MemberName', '$SectionID', '$ColorID', '$Email', '$Contact', '$date')";
                        
                        echo $query;

                        mysqli_query($con, $query);
                        header("location:AddMemberFrontEnd.php?success");
                        exit();
                    }
                }
            }
        }
    }
}


 ?>
