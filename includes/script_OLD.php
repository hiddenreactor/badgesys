<?php 
require_once('includes/connection.php'); 

// Code check user name
// if(!empty($_POST["username"])) {
// 	echo $_POST["username"];
// 	$result1 = mysqli_query($con,"SELECT count(*) FROM user_data WHERE UName='" . $_POST["username"] . "'");
// 	$row1 = mysqli_fetch_row($result1);
// 	echo $row1;
// 	$user_count = $row1[0];
// 	echo $user_count; 
// 	echo "Hello";
// }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.0/dist/jquery-input-mask-phone-number.js"></script>
<script>
function checkemailAvailability() {
    $("#loaderIcon").show();
        jQuery.ajax({
        url: "RegisterBackEndTest.php",
        data:'emailid='+$("#emailid").val(),
        type: "POST",
            success:function(data){
            $("#email-availability-status").html(data);
            $("#loaderIcon").hide();
            },
            error:function(){}
            });
}
function checkusernameAvailability() {
    $("#loaderIcon").show();
        jQuery.ajax({
        url: "RegisterBackEndTest.php",
        data:'username='+$("#username").val(),
        type: "POST",
            success:function(data){
            $("#username-availability-status").html(data);
            $("#loaderIcon").hide();
            },
            error:function (){}
            });
}
</script>

<script type="text/javascript">

	$(document).ready(function(){
		// set initially button state hidden
        $("#regbtn").hide();
		// use focusout event on fname field
		$("#fname").focusout(function(){
			if(validateFName()){
				return true;
			}		
			buttonState();
        });
        // use focusout event on lname field
		$("#lname").focusout(function(){
            if (validateLName()) {
                return true;
            }
			buttonState();
		});
		// use focusout event on lname field
		$("#username").focusout(function(){
            if (validateUName()) {
                return true;
            }
			buttonState();
		});
		// use focusout event on email field
		$("#emailid").focusout(function(){
            if (validateEmail()) {
                return true;
            }
			buttonState();
		});
		// use focusout event on password field
		$("#pass").focusout(function(){
            if (validatePassword()) {
                return true;
            }
			buttonState();
		});
		// use focusout event on confirmpassword field
		$("#confpass").focusout(function(){
            if (validateConfirmPassword()) {
                return true;
            }
			buttonState();
		});
        // use focusout event on accesscode field
		$("#access").focusout(function(){
			// check
			if(validateAccess()){
				// set input password border green
				$('#accesssuccess').css('display','block');
				  $('#access').css('border','2px solid green');
				  $('#accesserror').css('display','none');
				  $('#accessspanerr').css('display','none');
				  $('#accessspanwarn').css('display','none');
				  $('#accesswarning').css('display','none');
			}else{
				// 	// set input password border red
				$('#accesserror').css('display','block');
				  $('#access').css('border','2px solid red');
				  $('#accesssuccess').css('display','none');
				  $('#accessspanerr').css('display','block');
				  $('#accessspanwarn').css('display','none');
				  $('#accesswarning').css('display','none');
			}
			buttonState();
		});
	
		
	});

		
	function buttonState(){
		if(validateFName() && validateLName() && validateUName() && validateEmail() && validatePassword() && validateConfirmPassword() && validateAccess()){
			// if the both email and password are validate
			// then button should show visible
			$("#regbtn").show();
		}else{
			// if both email and pasword are not validated
			// button state should hidden
			$("#regbtn").hide();
		}
	}
	
    function validateFName(){
		// get value of input email
		var fname=$("#fname").val();
		// use reular expression
		 var regfname = /^[A-Za-z]+$/
		 if(fname !== ''){
			if(regfname.test(fname)){			 
				  $('#fnamesuccess').css('display','block');
				  $('#fname').css('border','2px solid green');
				  $('#fnameerror').css('display','none');
				  $('#fnamespanerr').css('display','none');
				  $('#fnamespanwarn').css('display','none');
				  $('#fnamewarning').css('display','none');
				  return true;
		 	}else{			 
				  $('#fnameerror').css('display','block');
				  $('#fname').css('border','2px solid red');
				  $('#fnamesuccess').css('display','none');
				  $('#fnamespanerr').css('display','block');
				  $('#fnamespanwarn').css('display','none');
				  $('#fnamewarning').css('display','none');
				  return false;
		 		}
		 	}else{
				$('#fnamespanwarn').css('display','block');
				$('#fname').css('border','2px solid orange'); 
				$('#fnameerror').css('display','none');
				$('#fnamesuccess').css('display','none');
				$('#fnamewarning').css('display','block');
				$('#fnamespanerr').css('display','none');
				return;
		 	}
		 	buttonState();
    }
    function validateLName(){
		// get value of input email
		var lname=$("#lname").val();
		// use reular expression
		 var reglname = /^[A-Za-z]+$/
		 if(lname !== ''){
			if(reglname.test(lname)){			 
				$('#lnamesuccess').css('display','block');
				$('#lname').css('border','2px solid green');
				$('#lnameerror').css('display','none');
				$('#lnamespanerr').css('display','none');
				$('#lnamespanwarn').css('display','none');
				$('#lnamewarning').css('display','none');
				  return true;
		 }else{			 
				$('#lnameerror').css('display','block');
				$('#lname').css('border','2px solid red');
				$('#lnamesuccess').css('display','none');
				$('#lnamespanerr').css('display','block');
				$('#lnamespanwarn').css('display','none');
				$('#lnamewarning').css('display','none');
				  return false;
		 }
		 } else{
			$('#lnamespanwarn').css('display','block');
			$('#lname').css('border','2px solid orange'); 
			$('#lnameerror').css('display','none');
			$('#lnamesuccess').css('display','none');
			$('#lnamewarning').css('display','block');
			$('#lnamespanerr').css('display','none');
			return;
		 }
		 buttonState();
	}

	function validateUName(){
		// get value of input username
		var username=$("#username").val();
		if(username !== ''){
		 if(username.length > 3){	
			$('#unamesuccess').css('display','block');
				$('#username').css('border','2px solid green');
				$('#unameerror').css('display','none');
				$('#unamespanerr').css('display','none');
				$('#unamespanwarn').css('display','none');
				$('#unamewarning').css('display','none');	
				  return true;
		 }else{			 
			$('#unameerror').css('display','block');
				$('#username').css('border','2px solid red');
				$('#unamesuccess').css('display','none');
				$('#unamespanerr').css('display','block');
				$('#unamespanwarn').css('display','none');
				$('#unamewarning').css('display','none');
				  return false;
		 }
		 } else{
			$('#namespanwarn').css('display','block');
			$('#username').css('border','2px solid orange'); 
			$('#unameerror').css('display','none');
			$('#unamesuccess').css('display','none');
			$('#unamewarning').css('display','block');
			$('#unamespanerr').css('display','none');
			return;
		 }
		 buttonState();
	}
	
	function validateEmail(){
		// get value of input email
		var email=$("#emailid").val();
		// use reular expression
		 var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
		 if(email !== ''){
         if(reg.test(email)){
			$('#emailsuccess').css('display','block');
				$('#emailid').css('border','2px solid green');
				$('#emailerror').css('display','none');
				$('#emailspanerr').css('display','none');
				$('#emailspanwarn').css('display','none');
				$('#emailwarning').css('display','none');
				  return true;
		 }else{			 
				$('#emailerror').css('display','block');
				$('#emailid').css('border','2px solid red');
				$('#emailsuccess').css('display','none');
				$('#emailspanerr').css('display','block');
				$('#emailspanwarn').css('display','none');
				$('#emailwarning').css('display','none');
				  return false;
		 }
		 } else{
			$('#emailspanwarn').css('display','block');
			$('#emailid').css('border','2px solid orange'); 
			$('#emailerror').css('display','none');
			$('#emailsuccess').css('display','none');
			$('#emailwarning').css('display','block');
			$('#emailspanerr').css('display','none');
			return;
		 }
		 buttonState();
    }
	function validatePassword(){
		//get input password value
        var pass=$("#pass").val();
        // use reular expression
		var reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
		// check it s length
		if(pass !== '') {
			if(reg.test(pass)){
				$('#passsuccess').css('display','block');
				$('#pass').css('border','2px solid green');
				$('#passerror').css('display','none');
				$('#passspanerr').css('display','none');
				$('#passspanwarn').css('display','none');
				$('#passwarning').css('display','none');
				  return true;
		 }else{			 
				$('#passerror').css('display','block');
				$('#pass').css('border','2px solid red');
				$('#passsuccess').css('display','none');
				$('#passspanerr').css('display','block');
				$('#passspanwarn').css('display','none');
				$('#passwarning').css('display','none');
				  return false;
		 }
		 } else{
			$('#passspanwarn').css('display','block');
			$('#pass').css('border','2px solid orange'); 
			$('#passerror').css('display','none');
			$('#passsuccess').css('display','none');
			$('#passwarning').css('display','block');
			$('#passspanerr').css('display','none');
			return;
		 }
		 buttonState();
	}
	function validateConfirmPassword(){
		//get input password value
        var pass=$("#pass").val();
        // use reular expression
		var confpass=$("#confpass").val();
		// check it s length
		if(pass !== '') {
			if(pass === confpass){
				$('#confpasssuccess').css('display','block');
				$('#confpass').css('border','2px solid green');
				$('#confpasserror').css('display','none');
				$('#confpassspanerr').css('display','none');
				$('#confpassspanwarn').css('display','none');
				$('#confpasswarning').css('display','none');
				  return true;
		 }else{			 
				$('#confpasserror').css('display','block');
				$('#confpass').css('border','2px solid red');
				$('#confpasssuccess').css('display','none');
				$('#confpassspanerr').css('display','block');
				$('#confpassspanwarn').css('display','none');
				$('#confpasswarning').css('display','none');
				  return false;
		 }
		 } else{
			$('#confpassspanwarn').css('display','block');
			$('#confpass').css('border','2px solid orange'); 
			$('#confpasserror').css('display','none');
			$('#confpasssuccess').css('display','none');
			$('#confpasswarning').css('display','block');
			$('#confpassspanerr').css('display','none');
			return;
		 }
		 buttonState();
    }
    function validateAccess(){
		//get input password value
        var accessCode = "1234";
        var access=$("#access").val();
		// check it s length
		if(access !== '') {
		if(access === accessCode){
			$('#accesssuccess').css('display','block');
				$('#access').css('border','2px solid green');
				$('#access').css('background-color','#DFF0D8');
				$('#accesserror').css('display','none');
				$('#accessspanerr').css('display','none');
				$('#accessspanwarn').css('display','none');
				$('#accesswarning').css('display','none');
				  return true;
		 }else{			 
				$('#accesserror').css('display','block');
				$('#access').css('border','2px solid red');
				$('#access').css('background-color','#F2DEDE');
				$('#accesssuccess').css('display','none');
				$('#accessspanerr').css('display','block');
				$('#accessspanwarn').css('display','none');
				$('#accesswarning').css('display','none');
				  return true;
		 }
		 } else{
			$('#accessspanwarn').css('display','block');
			$('#access').css('border','2px solid orange');
			$('#access').css('background-color','#F2DEDE'); 
			$('#accesserror').css('display','none');
			$('#accesssuccess').css('display','none');
			$('#accesswarning').css('display','block');
			$('#accessspanerr').css('display','none');
			return;
		 }
		 buttonState();
	}
	// function validateAccess(){
	// 	var accessCode = "asdf";
	// 	//get input password value
	// 	var access=$("#access").val();
	// 	// check it s length
	// 	if(access === accessCode){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}

	// }
</script>