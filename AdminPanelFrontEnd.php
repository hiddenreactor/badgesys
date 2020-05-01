<?php

    require_once('includes/header.php'); 
    require_once('includes/connection.php');

    if(isset($_SESSION['admin']))
    {
        $query = "SELECT * FROM members";
        $result = mysqli_query($con, $query);
    }
    else
    {
        header("location:AdminPanelFrontEnd.php");
    }

?>
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
function load_data(SectionID)
{
    $.ajax({
        type: "POST",
        url: "AdminPanelBackEnd.php",
        data: 'SectionID=' + SectionID,
        success: function(data){
            $("#details").html(data);
        }
    });
}
</script>
<!-- <script>  
 
 //     load_data();  
       function load_data(page)  
       {  
            $.ajax({  
                 url:"SectionDetailsBackend.php",  
                 method:"POST",  
                 data:{page:page},  
                 success:function(data){  
                      $('#pagination_data').html(data);  
                 }  
            })  
       }  
       $(document).on('click', '.pagination_link', function(){  
            var page = $(this).attr("id");  
            load_data(page);  
       });  
   
  </script>  -->

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card bg-dark text-white mt-5">
                    <h3 class="text-center py-3"> Member Summary </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">                              
                    <div class="card-body">
                        <table class="table table-striped bg-info text-white" id="details" >

                            <tr>
                                <a href="AddMemberFrontEnd.php" class="btn btn-lg btn-secondary mb-3 float-left">Add Member</a>  

                                <div class="form-inline float-left ml-1">
                                <select class="form-control mb-2" id="section" onChange="load_data(this.value);">
                                    <option value="null">Select Section</option>
                                        <?php
                                        $query = "SELECT * FROM sections ";
                                        $result = mysqli_query($con, $query);   
                                        while($row=mysqli_fetch_assoc($result))
                                            { 
                                        ?>
                                    <option value = "<?php echo $row["SectionID"]; ?>"> <?php echo $row["SectionName"]; ?> </option>
                                        <?php    
                                            }
                                        ?>                   
                                </select>
                                </div> 
                                
                                <form action="Search.php" method="POST">
                                    <div class="form-inline float-right">
                                        <input type="text" placeholder="Search" class="form-control" name="search">
                                        <button class="btn btn-lg btn-success" name="find">Search</button>
                                    </div>
                                </form>

                            </tr>

                            <tr class="bg-info text-white">                           
                                <td>Member Name</td>                    
                                <td>Member Email</td>
                                <td>Member Contact</td>
                                <td colspan="3" align="center">Operations</td>
                            </tr>

                        </table>
                    </div>
                <div>                
            </div>
        </div>
    </div>



<?php require_once('includes/footer.php'); ?>