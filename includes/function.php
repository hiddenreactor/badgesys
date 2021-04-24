<?php

        function addBadgeFunction() {

          $Message = "";
          if (isset($_GET['empty'])) {
            $Message = "Please enter all fields";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

            if (isset($_GET['addSuccess'])) {
              $Message = "Badge added successfully";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if (isset($_GET['ValidEmail'])) {
              $Message = "Please enter valid Email";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if (isset($_GET['UserTaken'])) {
              $Message = "User name already taken";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if (isset($_GET['date'])) {
              $Message = "Incorrect date format";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if (isset($_GET['EmailTaken'])) {
              $Message = "Email already taken";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if (isset($_GET['InvalidFormat'])) {
              $Message = "Invalid image format";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if (isset($_GET['UnsuccessInsert'])) {
              $Message = "Data Insert Unsuccessfully";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if (isset($_GET['success'])) {
              $Message = "You have successfully Register";
              echo '<div class="alert alert-success text-center">'.$Message.'
              <a href="login.php">Login Now</a>
              </div>';
            }

        }

        function RegisterFunction() {

          $Message = "";

          if (isset($_GET['empty'])) {
            $Message = "Please enter all fields";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['code'])) {
            $Message = "Please enter valid access code";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['character'])) {
            $Message = "Please enter valid character";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['ValidEmail'])) {
            $Message = "Please enter valid Email";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['UserTaken'])) {
            $Message = "User name already taken";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['phone'])) {
            $Message = "Incorrect phone format";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['EmailTaken'])) {
            $Message = "Email already taken";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['InvalidFormat'])) {
            $Message = "Invalid image format";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['InvalidSize'])) {
            $Message = "Image size too large";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['success'])) {
            $Message = "You have successfully Register";
            echo '<div class="alert alert-success text-center">'.$Message.'
            <a href="login.php">Login Now</a>
            </div>';
          }

      }

        function updateFunction() {

          $Message = "";
          if (isset($_GET['empty'])) {
            $Message = "Please enter all fields";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }


          if (isset($_GET['addSuccess'])) {
            $Message = "Badge added successfully";
            echo '<div class="alert alert-success text-center">'.$Message.'</div>';
          }

          if (isset($_GET['success'])) {
            $Message = "You have successfully Updated";
            echo '<div class="alert alert-success text-center">'.$Message.'
            <a href="login.php">Login Now</a>
            </div>';
          }

      }
        
        function LoginFunction() {
          $Message = "";
            if(isset($_GET['empty']))
            {
              $Message = " Please fill in the blanks ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_GET['invalid']))
            {
              $Message = " User name Not Match ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_GET['pass_invalid']))
            {
              $Message = " Password Incorrect ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_GET['status']))
            {
              $Message = " User not exist ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_SESSION['MemberID']))
            {
              header("location:index.php");
            }
        }

        function AdminLoginFunction() {
          $Message = "";
            if(isset($_GET['empty']))
            {
              $Message = " Please fill in the blanks ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_GET['invalid']))
            {
              $Message = " User name Not Match ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_GET['leader_password_invalid']))
            {
              $Message = " Password Incorrect ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_GET['status']))
            {
              $Message = " User not exist ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_SESSION['MemberID']))
            {
              header("location:index.php");
            }
        }

        function MemberLoginFunction() {
          $Message = "";
            if(isset($_GET['empty']))
            {
              $Message = " Please fill in the blanks ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_GET['invalid']))
            {
              $Message = " User name Not Match ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_GET['member_password_invalid']))
            {
              $Message = " Password Incorrect ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_GET['member_status']))
            {
              $Message = " User not exist ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

            if(isset($_SESSION['memberlogin']))
            {
              header("location:memberlogin.php");
            }
        }

        function AddMemberFunction() {

          $Message = "";

          if (isset($_GET['empty'])) {
            $Message = "Please enter all fields";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['character'])) {
            $Message = "Please enter First Name and Last Name seprate with space";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['ValidEmail'])) {
            $Message = "Please enter valid Email";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['phone'])) {
            $Message = "Pleae enter valid phone number";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['MemberTaken'])) {
            $Message = "Member already exist";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if (isset($_GET['EmailTaken'])) {
            $Message = "Email already taken";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

          if(isset($_GET['status']))
            {
              $Message = " User not exist ";
              echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
            }

          if (isset($_GET['success'])) {
            $Message = "You have successfully added a member";
            echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
          }

      }

      function AdminLogin() {
        $Message = "";

        if(isset($_GET['empty'])) {
          $Message = " Enter Valid User Name and password ";
          echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
        }

        if(isset($_GET['invalid']))
        {
          $Message = " User name Not Match ";
          echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
        }

        if(isset($_GET['passord_invalid']))
        {
          $Message = " Password Incorrect ";
          echo ' <div class="alert text-center" style="background:#D7D7D7; color:#7B7B7B">'.$Message.'</div> ';
        }

        if(isset($_SESSION['AdminID']))
        {
          header("location:index.php");
        }
   
        if (isset($_SESSION['admin'])) {
            header("location:AdminPanelFrontEnd.php");
        }
    }
    
?>