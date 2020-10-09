<script>
    $(document).ready(function() {
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;       
    $("#DateReg").attr("value", today);
});
</script>

<!-- Modal -->
<div class="modal fade" id="addMemberModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal with Dynamic Content</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="validate_form">
                <label>Member Name</label> 
                    <input type="text" id="fname" class="form-control input-value" name="MemberName" placeholder="Full Name" required data-parsley-pattern="^[A-Z][a-z]{3,30}(\s[A-Z](\.|[a-z]{1,30})?)*$" data-parsley-trigger="focusout" data-parsley-pattern-message="Must contain First and Last name beginning with a capital letter and seprate by a space" data-parsley-checkmember="membername"  data-parsley-checkmember>
                </br>
                <label>Member Section</label>  
                    <select name='SectionID' id='SectionID' class="form-control input-value" >
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
                    <select name='ColorID' id='ColorID' class="form-control input-value">
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
                    <input type="text" id="email" class="form-control mb-2" name="Email" required placeholder="Email" data-parsley-type="email" data-parsley-trigger="focusout" data-parsley-checkemail >
                    </br>
                <label>Contact</label>  
                    <input type="text" id='Contactme' name='Contact' placeholder="Contact Number" value="" class="form-control mb-3">
                    </br>
                <label>Date Registered</label>  
                    <!-- <input type="date" name="Date" id="Date" class="form-control date" /> -->
                    <input type='date' id="DateReg" name="Date" placeholder="YYYY-MM-DD" class="form-control date">   
                    </br>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" name="action" id="action" class="btn btn-success" value="Add Member" />
            </div>

                </form>
        </div>
    </div>
</div>