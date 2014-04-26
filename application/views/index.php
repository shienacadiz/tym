<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8" />
		<title><?php echo TYM_TITLE; ?></title>
		<script src="<?php echo "$base"."$jquery"; ?>"></script>
		<script type="text/javascript">
			function delayer(){
				window.location = "home"
			}
			function validate_form() {
				var submit = true;
				var error_message = "";
				
				if($("#login_username").val() == "") {
					error_message = "Enter a username";
					$("#login_username").focus();
					submit = false;
				}
				else if ($("#login_password").val() == "") {
					error_message = "Enter a password";
					$("#login_password").focus();
					submit = false;
				}
				
				if(submit) {
					$(".error").fadeOut("slow");
					$("#login_form").submit();
				}
				else {
					$("#error_message").text(error_message);
					$(".error").fadeIn();
					return false;
				}
			}
			$( document ).ready(function() {
				if($("#error_message").text() != "") {
					$(".error").fadeIn();
				}
			});
		</script>
        <link rel="stylesheet" type="text/css" href="<?php echo "$base"."$css"; ?>"/>
	</head>
	<body>
		<?php 
			if($login_success) {
				?>
				<body onLoad="setTimeout('delayer()', 3000)">
				<div id='tym_common_box'>
					<h2>Welcome back!</h2>
					<h3>Please wait while I redirect you..</h3>
				</div>
				<?php
				die();
			}
		?>
        <div id="tym_login_logo">
            <img src="<?php echo "$base"."assets/img/TYM_Logo_resized.png";?>"/>
        </div>
        <div id="tym_common_box">
            <form action='<?php echo $base."index"; ?>' method='POST' name='login_form' id='login_form'>
                <table class="center">
                    <tr>
                      <td class="blue_label">USERNAME :</td>
                        <td><input type='text' name='login_username' id='login_username' value="<?php if(isset($username)) echo $username;?>"/></td>
                    </tr>
                        <td class="blue_label">PASSWORD :</td>
                        <td><input type='password' name='login_password' id='login_password' value="<?php if(isset($password)) echo $password;?>"></td>
                        <input type='hidden' value='Login' name='submitted'/>
                    </tr>
                </table>
                <div id="tym_msg_wrapper">
					<div class='error'>
						<label id='error_message' name='error_message'><?php if(isset($error_message)) echo $error_message; ?></label>
					</div>
				</div>
                <div id="tym_login_button">
                    <a href="javascript:validate_form();">Login</a>
                </div>
                <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" onclick="return validate_form();"/>
            </form>
        </div>
        <div class="center">Not yet a member? <a href='<?php echo $base."register"; ?>' class="blue_link">Register here</a>!</div>
		<br/>
		<div id="tym_login_blue_box" class="center">
			(c) Shiena Kaye Cadiz. 2014.
		</div>
	</body>
</html>