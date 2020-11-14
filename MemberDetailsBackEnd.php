<?php

// include_once('includes/connection.php');
// sleep(1);
if (isset($_POST["membername"])) {
    $con = mysqli_connect("localhost", "root", "", "scout");
    $membername = mysqli_real_escape_string($con, $_POST["membername"]);
    $section = mysqli_real_escape_string($con, $_POST["section"]);
    $color = mysqli_real_escape_string($con, $_POST["color"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $contact = mysqli_real_escape_string($con, $_POST["contact"]);
    $datereg = mysqli_real_escape_string($con, $_POST["datereg"]);

    if (mysqli_connect_errno()) {
        echo "Error MySQL: " .mysqli_connect_errno();
    }
    $rsMatch = mysqli_query($con, "SELECT * FROM members WHERE MemberName = '".$membername."' AND Email = '".$email."'");
    // echo $rsMatch;
    // echo "\r\n";
    // $rsEmails = mysqli_query($con, "SELECT * FROM members WHERE Email = '".$email."'");
    $numMatch = mysqli_num_rows($rsMatch);
    // $numEmails = mysqli_num_rows($rsEmails);
    // echo $numMatch;
    // echo "\r\n";
    // exit();
    if ($numMatch > 0 ) {
        echo "This member has already registered.";
        echo "</br>"; 
        echo "Session Over.";
    } else {
        $newUser = "INSERT INTO members (MemberName, SectionID, ColorID, Email, Contact, Date) VALUES ('$membername', '$section', '$color', '$email', '$contact', '$datereg')";
        if (mysqli_query($con, $newUser)) {
            echo "New member added";
      
        } else {
            echo "Error at adding user";
        }
    }
}
?>