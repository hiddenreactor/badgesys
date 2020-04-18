<?php
    require_once('includes/header.php');
    require_once('includes/connection.php');
    require_once('includes/function.php');

    if(isset($_GET['MemberID']) || isset($_SESSION['admin']))
    {
        // $GetID = $_GET['addBadge'];
        $query = "SELECT * FROM members, colors, sections, earned, badges, category WHERE 
       
        members.ColorID = colors.ColorID AND 
        members.SectionID = sections.SectionID AND
        badges.BadgeID = earned.BadgeID AND
        category.CategoryID = badges.CategoryID
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
            $CategoryName = $row['CategoryName'];
            $CategoryID = $row['CategoryID'];
            $BadgeName = $row['BadgeName'];
            $BadgeID = $row['BadgeID'];
        }

    }

?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.0/dist/jquery-input-mask-phone-number.js"></script>

        <script>

            $(document).ready(function () {
                $('#yourphone').usPhoneFormat({
                    format: '(xxx) xxx-xxxx',
                });
                
                $('#yourphone2').usPhoneFormat();
            });

        </script>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 m-auto">


        <div class="card mt-5">
          <div class="card bg-dark text-white">
            <h3 class="text-center text-white py-3">Add New Member</h3>
          </div>

          <?php
            
            RegisterFunction();
            
          ?>

          <div class="card-body">

            <form action="AddMemberBackEnd.php" method="POST" enctype="multipart/form-data">
                <div class="form-inline float-left">
                    <a href="admin-panel.php" class="btn btn-primary mb-3">Back</a>
                </div>
              <input type="text" name='MemberName' placeholder="Member Name" value="" class="form-control mb-2">
                <select name='SectionID' id='SectionID' class="form-control mb-2">
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
              
              <input type="email" name='Email' placeholder="Email" value="" class="form-control mb-2">
              <input type="text" id='yourphone' name='Contact' placeholder=" Contact Number" value="" class="form-control mb-3">
              

              <button name="addMember" class="btn btn-success">Add Member</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php require_once('includes/footer.php'); ?>
