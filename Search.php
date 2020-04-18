<?php

    require_once('includes/header.php'); 
    require_once('includes/connection.php');

    if(isset($_POST['find']))
    {
        $Search = $_POST['search'];
        // $query = "SELECT * FROM members, sections, colors WHERE 
        // sections.SectionID = members.SectionID AND
        // sections.SectionName = '".$Search."' or
        // colors.ColorID = members.ColorID AND
        // colors.Color = '".$Search."'";

        $query ="SELECT * FROM members AS m 
        INNER JOIN sections AS s ON m.SectionID = s.SectionID
        INNER JOIN colors AS c on m.ColorID = c.ColorID WHERE
        m.MemberName = '".$Search."' OR
        s.SectionName = '".$Search."' OR
        c.Color = '".$Search."' OR
        m.Email = '".$Search."' ";

        //Try search with partial entry
        // $query ="SELECT * FROM members AS m 
        // INNER JOIN sections AS s ON m.SectionID = s.SectionID
        // INNER JOIN colors AS c on m.ColorID = c.ColorID WHERE
        // m.MemberName LIKE '%p' AND
        // m.MemberName LIKE '".$Search."'";
        // $result = mysqli_query($con, $query);
        
    }
    else
    {
        header("location:admin-login.php");
    }

    echo '<div class="container">
    <div class="row">
        <div class="col">
            <div class="card bg-dark text-white mt-5">
                <h3 class="text-center py-3"> Registered User </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-title">
                </div>                                
                <div class="card-body">
                    <table class="table table-striped">

                        <tr>
                        <a href="admin-panel.php" class="btn btn-primary mb-1">Back</a>  
                            <form action="search.php" method="POST">
                                <div class="form-inline float-right">
                                    <input type="text" placeholder="Search User" class="form-control" name="search">
                                    <button class="btn btn-success" name="find">Search</button>
                                </div>
                            </form>

                        </tr>

                        <tr class="bg-info text-white">
                            <td>Member Name</td>
                            <td>Section</td>
                            <td>Color</td>
                            <td>Email</td>
                            <td colspan="7">Operations</td>
                        </tr>';

?>
    

                        <?php 
                            while($row=mysqli_fetch_assoc($result))
                            {
                                $MemberID = $row['MemberID'];
                                $MemberName = $row['MemberName'];
                                $SectionName = $row['SectionName']; 
                                $Color = $row['Color']; 
                                $Email = $row['Email'];                                  
                                
                                
                                // echo "$MemberID";
                                // echo "\n";
                                // echo "$MemberName";
                                // echo "\n";
                                // echo "$SectionName";
                                // echo "\n";

                        ?>

                        

                            <tr>                             
                                <td><?php echo $MemberName ?></td> 
                                <td><?php echo $SectionName ?></td>
                                <td><?php echo $Color ?></td>
                                <td><?php echo $Email ?></td>
                                <td><a href="view.php?success=<?php echo $MemberID ?>" class="btn btn-success btn-sm">View</a></td>
                                <td><a href="adminedit.php?edit=<?php echo $MemberID ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                <td><a href="delete.php?Del=<?php echo $MemberID ?>" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                        <?php
                            }
                        ?>            
                        </table>
                    </div>
                <div>                
            </div>
        </div>
    </div>



<?php require_once('includes/footer.php'); ?>