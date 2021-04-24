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
        
        //add auto generate username with two or more words including special character of ',.-
        $Pass = "$2y$10$7Dm9Lq0NexGJKpsF.NBVV.neW.B4fQEupObrHXaZYdTtbdST6Mqyy";  // Aa321321321!!
        // $str = $membername;
        // $array = explode(" ",$str);
        // $first_word = strtoLower($array[0]);
        // $first_cat_word = strtoLower($first_word[0]);
        // $last_word  = strtoLower($array[count($array)-1]);
        // $catword = $first_cat_word.$last_word;

         // Get username from email address
        $string = $email;
        $email_username = strstr($string, '@', true);
                
        // $last_word_start = strrpos($str, ' ') + 1; // +1 so we don't include the space in our result
        // $last_word = substr($str, $last_word_start); // $last_word = PHP.
        // $lowerstr = strtoLower($last_word);

        
        // $str = preg_replace('/\s+/', '', $str);
        // $str = strtolower($str);

        $token = 0;
        date_default_timezone_set('America/Vancouver');
        $tokenExpire = date("Y-m-d H:i:s");  

        $newUser = "INSERT INTO members (MemberName, memberusername, Password, SectionID, ColorID, Email, Contact, Date, token, tokenExpire) 
        VALUES ('$membername', '$email_username', '$Pass', '$section', '$color', '$email', '$contact', '$datereg', '$token', '$tokenExpire')";
        if (mysqli_query($con, $newUser)) {
            echo "New member added";
      
        } else {
            echo "Error at adding new user, please check your email or name and try again!";
        }
    }
}
?>