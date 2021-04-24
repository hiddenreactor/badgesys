<div id="accountModal" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">                        
                     <h4 class="modal-title">Update Profile  
                     </h4>  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="account_form">      
                          <label>Member Name</label>  
                          <!-- <input type="text" name="MemberName" id="MemberName" class="form-control validate" required>   -->
                          <input type="text" id="updatemember" class="form-control input-value" name="MemberName" disabled placeholder="Full Name" data-parsley-pattern="^[A-Z][a-z]+\s[A-Z][a-z]+$" data-parsley-trigger="focusout" data-parsley-pattern-message="Must contain First and Last name beginning with a capital letter and seprate by a space" data-parsley-member="membername"  data-parsley-updatemember>
                          <br />  
                          <label>User Name</label>  
                          <!-- <input type="text" name="MemberName" id="MemberName" class="form-control validate" required>   -->
                          <input type="text" id="updateuser" class="form-control input-value" name="memberusername" placeholder="User Name" data-parsley-length="[3, 16]" data-parsley-trigger="focusout" required data-parsley-pattern-message="Must contain at least 3 characters" data-parsley-member="memberusername"  data-parsley-memberusername>
                          <br />  
                         
                          <label>Update Email</label>                         
                         <input type="text" id="email" class="form-control mb-2" name="email" required placeholder="Email" data-parsley-type="email" data-parsley-trigger="focusout" data-parsley-checkemail >
                         <!-- <input type="text" name="email" id="email" class="form-control" /> -->
                         <span id="availability"></span>
                          <br />  
                          <!-- <label>Update Password</label>  
                          <input type="password" id="updatepassword" class="form-control mb-2" name="Password" required placeholder="Password" data-parsley-email="password" data-parsley-trigger="focusout" data-parsley-updateemail>
                          <br />  -->
                          <label>Update Contact</label>  
                          <input type="text" id='Contact' name='Contact' placeholder=" Contact Number" value="" class="form-control mb-3">
                          <!-- <input type="text" name="Contact" id="Contact" class="form-control" required data-parsley-trigger="focusout" data-parsley-pattern-message="Please enter a valid Australian mobile phone number." data-parsley-pattern="^\d{3} \d{3} \d{4}$" />  -->
                          <br />  
                          <label>Date Registered</label>  
                          <input type="text" name="Date" id="Date" class="form-control" disabled />  
                          <br />
                          <input type="hidden" name="m_id" id="m_id" />  
                          <input type="hidden" name="operation" id="operation" />
                          <input type="submit" name="action" id="action" class="btn btn-success" value="Confirm" />
                          <!-- <input type="submit" name="operation" id="operation" value="Update" class="btn btn-primary" />   -->
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
<script>
function isValidEmailAddress(email) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(email);
}
</script>
 <script>  
 $(document).ready(function(){  
   $('#email').blur(function(){
     var email = $(this).val();

     $.ajax({
      url:'check.php',
      method:"POST",
      data:{email:email},
      success:function(data)
      {      
       if(data != '0' || !isValidEmailAddress(email))
       {
        $('#email').css('background-color','#F2DEDE');
        $('#availability').html('<span class="text-danger">Email not available</span>');
        $('#action').attr("disabled", true);
       }
       else
       {
        $('#email').css('background-color','#DFF0D8');    
        $('#availability').html('<span class="text-success">Email Available</span>');
        $('#action').attr("disabled", false);
       }
      }
     })

  });
 });  
</script>