<?php 
require_once('includes/header.php');
require_once('includes/function.php');
// require_once('includes/script.php');
require_once('style/parsley.php'); 
?>
<style>
input {
display: block;
box-sizing: border-box;
border-radius: 5px;
border: 5px solid #B6A754;
width: 100%;
}
</style>

<div class="container">
  <div class="row">
    <div class="col-lg-6 m-auto">

      <div class="mt-5">
      </div>

      <div class="card custom">
        <div class="card-title custom rounded-top">
          <h5 class="text-center custom py-3">Register as Leader</h5>
        </div>

        <?php          
          RegisterFunction();          
        ?>

        <div class="card-body custom">
          <form id="validate_form">
<!-- <input type="text" id="fname" class="form-control mb-2" placeholder="First Name" data-parsley-trigger="focusout" data-parsley-firstname data-parsley-firstname-message="Invalid Character"> -->
          <input type="text" id="fname" class="form-control mb-2" name="FName" placeholder="First Name" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="focusout" data-parsley-firstname data-parsley-firstname-message="Invalid Character">
          <input type="text" id="lname" class="form-control mb-2" name="LName" placeholder="Last Name" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="focusout" data-parsley-lastname data-parsley-lastname-message="Invalid Character">
          <input type="text" id="username" class="form-control mb-2" name="UName" placeholder="Username" data-parsley-trigger="focusout" required data-parsley-username data-parsley-username-message="Username already Exists">
          <input type="text" id="email" class="form-control mb-2" name="Email" required placeholder="Email" data-parsley-type="email" data-parsley-trigger="focusout" data-parsley-checkemail data-parsley-checkemail-message="Email Address already Exists">
          <input type="password" id="password"class="form-control mb-2" name="Password" placeholder="Password" required data-parsley-length="[8, 16]" data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" data-parsley-trigger="focusout" data-parsley-pattern-message="Password must contain 8 letters combine with numbers and special character">
          <input type="password" id="confpass"class="form-control mb-2" placeholder="Confirm Password" data-parsley-equalto="#password" data-parsley-trigger="focusout">
          <input type="password" id="access"class="form-control mb-2" name="Access" placeholder="Access Code" data-parsley-trigger="focusout">
          
            <a href="index.php" class="btn btn-outline-warning mb-1">Back</a>                  
              <div class="form-inline float-right">
              <button id="submit" name="submit" class="btn btn-warning" >Register</button>
              </div>                        
          </form>
        </div>
        
      </div>
    </div>
  </div>
</div>

<?php require_once('includes/footer.php'); ?>
         
<!--This validateEmail with Parsley without CSS-->
<script>
  window.ParsleyValidator
    .addValidator('checkemail', function (value, requirement) {
        var response = false;

        $.ajax({
            url: "RegisterBackEnd.php",
            data: {email: value},
            dataType: 'json',
            type: 'post',
            async: false,
            success: function(data) {
                response = true;
            }
        });
        return response;
    }, 32)
    .addMessage('en', 'checkemail', 'The email already exists.');

    $("#email").parsley({
    errorClass: 'is-invalid',
    successClass: 'is-valid',
    errorsWrapper: '<span class="invalid-feedback"></span>',
    errorTemplate: '<span></span>',
    trigger: 'change'

});
</script>

<script>
  window.ParsleyValidator
    .addValidator('username', function (value, requirement) {
        var response = false;

        $.ajax({
            url: "RegisterBackEnd.php",
            data: {username: value},
            dataType: 'json',
            type: 'post',
            async: false,
            success: function(data) {
                response = true;
            }
        });
        return response;
    }, 32)
    .addMessage('en', 'username', 'The username already exists.');

    $("#username").parsley({
    errorClass: 'is-invalid',
    successClass: 'is-valid',
    errorsWrapper: '<span class="invalid-feedback"></span>',
    errorTemplate: '<span></span>',
    trigger: 'change'

});
</script>

<script>  
$(document).ready(function(){  
    $('#validate_form').parsley();
 
 $('#validate_form').on('submit', function(event){
  event.preventDefault();
  if($('#validate_form').parsley().isValid())
  {
   $.ajax({
    url:"RegisterBackEnd.php",
    method:"POST",
    data:$(this).serialize(),
    beforeSend:function(){
     $('#submit').attr('disabled','disabled');
     $('#submit').val('Submitting...');
    },
    success:function(data)
    {
     $('#validate_form')[0].reset();
     $('#validate_form').parsley().reset();
     $('#submit').attr('disabled',false);
     $('#submit').val('Submit');
     window.location.href = 'index.php'; // want to post the data this in redirection
     alert(data);
    }
   });
  }
 });
});  
</script>
