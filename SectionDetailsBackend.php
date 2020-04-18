<?php 

require_once('includes/connection.php');

$query = "SELECT * FROM sections, members WHERE 
members.SectionID ='".$_POST["MemberID"]."' AND 
sections.SectionID = members.SectionID ORDER BY MemberName
";
$result = mysqli_query($con, $query);

?>


       

                <table class="text-center bg-info text-white">    
                            <tr>                           
                                <td>Member Name</td>                    
                                <td>Member Email</td>
                                <td>Member Contact</td>
                                <td colspan="3" align="center">Operations</td>
                            </tr> 
                            <?php 
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    $MemberID = $row['MemberID'];
                                    $Member = $row['MemberName'];
                                    $MemberEmail= $row['Email'];  
                                    $MemberContact = $row['Contact'];                                                 
                                ?>

                            <tr class="bg-light text-dark">
                                <td><?php echo $Member ?></td>
                                <td><?php echo $MemberEmail ?></td>
                                <td><?php echo $MemberContact ?></td>
                                <td><a href="view.php?success=<?php echo $MemberID ?>" class="btn btn-success btn-sm">View Badge History</a></td>
                                <td><a href="UpdateFrontEnd.php?update=<?php echo $MemberID ?>" class="btn btn-primary btn-sm">Update Member</a></td>
                                <td><a href="AddBadgeFrontEnd.php?addBadge=<?php echo $MemberID ?>" class="btn btn-danger btn-sm">Add Badge</a></td>
                            </tr>
                                <?php
                                    }
                                ?>     
                </table>
     

                        
          
     
     
            
                                          
                
                       

                          

                                      
                  
                              
            
        
 
