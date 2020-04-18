
  else
  {
    if(!preg_match("/^[a-z,A-Z]*$/",$FirstName || !preg_match("/^[a-z,A-Z]*$/",$LastName || !preg_match("/^[a-z,A-Z]*$/",$UserName))
    {
      header("location:register.php?character");
      exit();
    }
    else
    {
      if(!filter_var($Email,FILTER_VALIDATE_EMAIL))
      {
        header("location:register.php?ValidEmail");
        exit();
      }
      else
      {
        $query = "select * from parent_data where UName='".$UserName."'";
        $result = mysqli_query($con, $query);

        if(mysqli_fetch_assoc($result))
        {
          header("location:register.php?UserTaken");
          exit();
        }
        else
        {
          $query = "select * from parent_data where UName='".$Email."'";
          $result = mysqli_query($con, $query);

          if(mysqli_fetch_assoc($result))
          {
            header("location:register.php?EmailTaken");
            exit();
          }
          else
          {
            $HashPass = password_hash($Pass, PASSWORD_DEFAULT);
            date_default_timezone_set("America/Vancouver");
            $date = date("d/m/y");

            if(in_array($TrueExt, $AllowImg))
            {
              if($Size < 1000000)
              {
                $query = "insert into parent_data (Img, FName, LName, UName, DOB, Gender, Email, Password, Date) values ('$Image', '$FirstName', '$LastName', '$UserName', '$DOB', '$Gender', '$Email', '$HashPass', '$date')";
                mysqli_query($con, $query);
                move_uploaded_file($Temp, $Target);
                header("location:register.php?success");
                exit();
              }
              else
              {
                header("location:register.php?InvalidSize");
                exit();
              }
            }
            else
            {
              header("location:register.php?InvalidFormat");
              exit();
            }
          }
        }
      }
    }
  }
