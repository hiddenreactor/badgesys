<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>
    $(document).ready(function() {
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;       
    $("#datereg").attr("value", today);
});


$(function(){
  $('#contact').inputmask("(999) 999-9999");
});

</script>

<!-- Modal -->
<div class="modal fade" id="addMemberModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal with Dynamic Contentasdf</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="member_form">
                <label>Member Name</label> 
                    <!-- <input type="text" id="membername" class="form-control input-value" name="membername" placeholder="Full Name" required data-parsley-pattern="^[A-Z][a-z]{1,30}(\s[A-Z](\.|[a-z]{1,30})?)*$" data-parsley-trigger="focusout" data-parsley-pattern-message="Invalid name.  Full name must contain first and last name with capital." data-parsley-checkmember="membername"  data-parsley-checkmember> -->
                    <input type="text" id="membername" class="form-control input-value" name="membername" placeholder="Full Name" required data-parsley-pattern="^[a-zA-Z_@'.-\s]+$" data-parsley-trigger="focusout" data-parsley-pattern-message="Invalid name.  Full name must contain first and last name with capital." data-parsley-checkmember="membername"  data-parsley-checkmember>
                </br>
                <label>Member Section</label>  
                    <select name='section' id='section' class="form-control input-value" >
                    <option value="">Select Section</option>
                        <?php
                         require_once('includes/connection.php');
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
                    </br>
                <label>Member Color</label>  
                    <select name='color' id='color' class="form-control input-value">
                    <option value="">Select Color</option>
                        <?php
                         require_once('includes/connection.php');
                            $query = "SELECT * FROM colors ";
                            $result = mysqli_query($con, $query);   
                            while($Section_row=mysqli_fetch_assoc($result))
                            { 
                        ?>
                        <option value ="<?php echo $Section_row['ColorID']; ?>"><?php echo $Section_row['Color']; ?></option>
                        <?php    
                            }
                        ?>                  
                    </select>
                    </br>
                <label>Member Email</label>       
                    <input type="text" id="email" class="form-control mb-2" name="email" required placeholder="Email" data-parsley-type="email" data-parsley-trigger="focusout" data-parsley-checkemail >
                    </br>
                <label>Contact</label>  
                    <input type="text" id='contact' name='contact' placeholder="Contact Number" value="" class="form-control mb-3">
                    </br>
                <label>Date Registered</label>  
                    <!-- <input type="date" name="Date" id="Date" class="form-control date" /> -->
                    <input type='date' id="datereg" name="datereg" placeholder="YYYY-MM-DD" class="form-control datereg">   
                    </br>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" name="action" data-id="action" class="btn btn-success" value="Add Member" />
            </div>

                </form>
        </div>
    </div>
</div>

<script type="text/javascript" charset="utf-8">
function toTitleCase( str ) 
{
   return str.split(/\s+/).map( s => s.charAt( 0 ).toUpperCase() + s.substring(1).toLowerCase() ).join( " " );
}
$('#membername').on('keyup', function(event) {
    var $t = $(this);
    $t.val( toTitleCase( $t.val() ) );
});

</script>


