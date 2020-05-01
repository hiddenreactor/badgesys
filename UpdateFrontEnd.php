<?php
    require_once('includes/header.php');
    require_once('includes/connection.php');
    require_once('includes/function.php');

    if(isset($_GET['MemberID']) || isset($_SESSION['admin']))
    {
        $GetID = $_GET['update'];
        $query = "SELECT * FROM members, colors, sections, earned, badges, category WHERE 
        members.MemberID ='".$GetID."' AND 
        members.ColorID = colors.ColorID AND 
        members.SectionID = sections.SectionID AND
        badges.BadgeID = earned.BadgeID AND
        category.CategoryID = badges.CategoryID AND
        earned.MemberID = '".$GetID."' 
        ";
        $result = mysqli_query($con,$query);

        if($row=mysqli_fetch_assoc($result))
        {
            $MemberName = $row['MemberName'];
            $MemberID = $row['MemberID'];
            $SectionID = $row['SectionID'];
            $SectionName = $row['SectionName'];
            $ColorID = $row['ColorID'];
            $Color = $row['Color'];
        }
        else
        {
        header("location:message.php");
        exit();
        }
    }
    

?>


<div class="container">
    <div class="row">
      <div class="col-lg-6 m-auto">

        <div class="mt-5">
        </div>

        <div class="card">
          <div class="card-title bg-dark rounded-top">
            <h3 class="text-center text-white py-3">Update <?php echo $MemberName ?>'s Profile</h3>
          </div>

          <?php
            updateFunction();
          ?>

          <div class="card-body">

            <form action="UpdateBackEnd.php?S_ID=<?php echo $MemberID ?>" method="POST" enctype="multipart/form-data">
              
              <input type="text" name="MemberName" placeholder="Member Name" class="form-control mb-2" value="<?php echo $MemberName ?>">
              
              <select name='SectionID' id='SectionID' class="form-control mb-2">
                <option value ="<?php echo $row['SectionID']; ?>"><?php echo $row['SectionName']; ?></option>
                <?php
                  $query = "SELECT * FROM sections ";
                  $result = mysqli_query($con, $query);   
                  while($Section_row=mysqli_fetch_assoc($result))
                  { 
                ?>
                <option value ="<?php echo $Section_row['SectionID']; ?>"><?php echo $Section_row['SectionName']; ?></option>
                <?php    
                  }
                ?>                   
                </select>

              <select name='ColorID' id='ColorID' class="form-control mb-2">
                <option value ="<?php echo $row['ColorID']; ?>"><?php echo $row['Color']; ?> </option>
                <?php
                  $query = "SELECT * FROM colors ";
                  $result = mysqli_query($con, $query);   
                  while($Color_row=mysqli_fetch_assoc($result))
                  { 
                ?>
                <option value="<?php echo $Color_row['ColorID']; ?>"><?php echo $Color_row['Color']; ?></option>
                <?php    
                  }
                ?>                   
              </select>
              <div class="row">                                             
                        <div class="card-body">                          
                            <a href="AdminPanelFrontEnd.php" class="btn btn-primary mb-1">Back</a>                  
                                <div class="form-inline float-right">
                                <button name="update" class="btn btn-success" onclick = "Redirect();">Update Now</button>
                                </div>                            
                        </div>      
                    </div>   
              
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

<?php require_once('includes/footer.php'); ?>