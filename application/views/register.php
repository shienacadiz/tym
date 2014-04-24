<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8"/>
		<title><?php echo TYM_TITLE; ?></title>
		<script src="<?php echo "$base/$jquery"; ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo "$base/$css"; ?>"/>
		<script>
			function validate_form() {
				var error_message = "";
				var submit = true;
				var existing_users = <?php echo json_encode($existing_users); ?>;
				
				if($("#reg_username").val() == "") {
					error_message = "Username is required";
					$("#reg_username").focus();
					submit = false;
				}
				else {
					var username = $("#reg_username").val();
					for(x=0 ; x<existing_users.length && submit == true ; x++) {
						if(existing_users[x].username == username) {
							error_message = "Username already exist";
							$("#reg_username").focus();
							submit = false;
						}
					}	
				}
				if(submit){		//check if no error yet
					if($("#reg_password").val() == "") {
						error_message = "Password is required";
						$("#reg_password").focus();
						submit = false;
					}
					else if($("#reg_full_name").val() == "") {
						error_message = "Full Name is required";
						$("#reg_full_name").focus();
						submit = false;
					}
					else if($("#reg_mail").val() == "") {
						error_message = "E-mail is required";
						$("#reg_mail").focus();
						submit = false;
					}
				}
				
				if(submit) {
					$(".message").fadeOut("slow");
					$("#register_form").submit();
				}
				else {
					$("#error_message").text(error_message);
					$(".message").fadeIn("slow");
					return false;
				}
			}
		</script>
	</head>
	<body>
		<div id="tym_common_invisible_box">
			<a href='index' class="blue_link"><-Back</a>
        </div>
        <div id="tym_common_box">
            <h1 class="header">Registration</h1>
			<form name='register_form' id='register_form' method="POST" action="register">
                <table class="center">
                    <tr>
                        <td class='left blue bold' colspan='2'>Login Information</td>
                    </tr>
                    <tr>
                        <td class="left blue">Username</td>
                        <td><input type='text' id='reg_username' name='reg_username'/></td>
                    </tr>
                    <tr>
                        <td class="left blue">Password</td>
                        <td><input type='password' id='reg_password' name='reg_password'/></td>
                    </tr>
                    <tr>
                        <td class='left blue bold' colspan='2'>Contact Information</td>
                    </tr>
                        <td class="left blue">Full Name</td>
                        <td><input type='text' id='reg_full_name' name='reg_full_name'/></td>
                    </tr>
                    <tr>
                        <td class="left blue">Email Address</td>
                        <td><input type='text' id='reg_mail' name='reg_mail'/></td>
                    </tr>
                </table>
				<div id="tym_error_wrapper">
					<div class='message'><label id='error_message' name='error_message'></label></div>
				</div>
                <div id="tym_register_button">
                    <a href="javascript:validate_form();">Register</a>
                </div>
                <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" onclick="return validate_form();"/>
            </form>
        </div>
        <br/>
		<div id="tym_login_blue_box" class="center">
            Site still under construction.<br/>
            For personal use only.<br/>
            For inquiries, email me at soundofsilence04@yahoo.com
		</div>
	</body>
</html>