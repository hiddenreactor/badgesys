<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>

function getBadge(val)
{
    $.ajax({
        type: "POST",
        url: "get_badge.php",
        data: 'CategoryID=' + val,
        success: function(data){
            $("#badges").html(data);
        }
    });
}
function getLevel(val)
{
    $.ajax({
        type: "POST",
        url: "get_level.php",
        data: 'CategoryID=' + val,
        success: function(data){
            $("#levels").html(data);
        }
    });
}
    $(document).ready(function() {
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;       
    $("#restockdate").attr("value", today);
});


$(function(){
  $('#contact').inputmask("(999) 999-9999");
});

</script>

<!-- Modal -->
<div class="modal fade" id="AddInventoryModals" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal with Dynamic Content</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="add_inventory_form">
                </br>
                <label>Badge Category</label>  
                <select name='category' class="form-control mb-2" id="category" onChange="getLevel(this.value);">
                    <option value="">Select Category</option>
                        <?php
                         require_once('includes/connection.php');
                            $query = "SELECT * FROM category ";
                            $result = mysqli_query($con, $query);   
                            while($Section_row=mysqli_fetch_assoc($result))
                            { 
                        ?>
                        <option value ="<?php echo $Section_row['CategoryID']; ?>"><?php echo $Section_row['CategoryName']; ?></option>
                        <?php    
                            }
                        ?>                  
                    </select> 
                    </br>
                    <label>Badge</label>  
                          <input type="text" name="badge" id="badge" class="form-control" /> 
                          <br /
                <label>Level</label>       
                <select name='levels' class="form-control mb-2" id="levels"> 
                          <option value = "Select Level">Select Level</option> 
                          <option value = "<?php echo $row["LevelID"]; ?>"> <?php echo $row["Levels"]; ?> </option> 
                           
                            </select></br>
                            <label>Quantity</label>  
                          <input type="text" name="quantity" id="quantity" class="form-control" /> 
                          <br /> 
                <label>Date Re-stock</label>  
                    <!-- <input type="date" name="Date" id="Date" class="form-control date" /> -->
                    <input type='date' id="restockdate" name="restockdate" placeholder="YYYY-MM-DD" class="form-control restockdate">   
                    </br>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" name="action" data-id="action" class="btn btn-success" value="Add Badge" />
            </div>

                </form>
        </div>
    </div>
</div>