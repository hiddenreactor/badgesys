<?php
    require_once('includes/header.php');
    require_once('includes/connection.php');

    if(isset($_GET['edit']) || isset($_SESSION['admin']))
    {
        $GetID = $_GET['edit'];
        $query = "SELECT * FROM members, colors, sections, earned, badges, category WHERE 
        members.MemberID ='".$GetID."' AND 
        members.ColorID = colors.ColorID AND 
        sections.SectionID = members.SectionID AND
        badges.BadgeID = earned.BadgeID AND
        category.CategoryID = badges.CategoryID AND
        earned.MemberID = '".$GetID."'
        ";
        $result = mysqli_query($con,$query);

        if($row=mysqli_fetch_assoc($result))
        {
            $MemberName = $row['MemberName'];
            $MemberID = $row['MemberID'];
            $SectionName = $row['SectionName'];
            $Color = $row['Color'];
            // $DOB = $row['DOB'];
            // $Gen = $row['Gender'];
            // $Email = $row['Email'];
            // $Pass = $row['Password'];
        }

    }

?>


<div class="container">
    <div class="row">
      <div class="col-lg-6 m-auto">

        <div class="mt-5">
            <img src="images/10.png" width="150" height="150" class="d-flex m-auto">
        </div>

        <div class="card">
          <div class="card-title bg-dark rounded-top">
            <h3 class="text-center text-white py-3">Update <?php echo $MemberName ?>'s Profile</h3>
          </div>

          <div class="card-body">

            <form action="update.php?S_ID=<?php echo $MemberID ?>" method="POST" enctype="multipart/form-data">
              
              <input type="text" name="MemberName" placeholder="Member Name" class="form-control mb-2" value="<?php echo $MemberName ?>">
              
              <select name="SectionID" class="form-control mb-2" id="sections" value="<?php echo $SectionName ?>">
                <option value="<?php echo $SectionName ?>"><?php echo $SectionName ?></option>
                <?php
                  $query = "SELECT * FROM sections ";
                  $result = mysqli_query($con, $query);   
                  while($row=mysqli_fetch_assoc($result))
                  { 
                ?>
                <option value ="<?php echo $SectionName ?>"> <?php echo $row["SectionName"]; ?> </option>
                <?php    
                  }
                ?>                   
                </select>
               
               <select name="color" class="form-control mb-2" id="colors" value="<?php echo $Color ?>">
                <option value="<?php echo $Color ?>"><?php echo $Color ?></option>
                <?php
                  $query = "SELECT * FROM colors ";
                  $result = mysqli_query($con, $query);   
                  while($row=mysqli_fetch_assoc($result))
                                    { 
                ?>
                <option value ="<?php echo $Color ?>"> <?php echo $row["Color"]; ?> </option>
                <?php    
                  }
                ?>                   
              </select>  
              
              <button name="update" class="btn btn-success">Update Now</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

<?php require_once('includes/footer.php'); ?>