<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8"/>
		<title><?php echo TYM_TITLE; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo "$base/$css";?>"/>
		<script src="<?php echo "$base/$jquery"; ?>"></script>
		<script>
			function onclick_banking() {
				if($("#enable_banking").is(':checked')) {
					$("#starting_money_bank").removeAttr('disabled');
				}
				else {
					$("#starting_money_bank").val("");
					$("#starting_money_bank").attr('disabled', 'disabled');
				}
			}
			function validate_form() {
				var submit = true;
				if($("#from_month").val() == "") {
					error_message = "Please select the month of start date";
					$("#from_month").focus();
					submit = false;
				}
				else if($("#from_day").val() == "") {
					error_message = "Please select the day of start date";
					$("#from_day").focus();
					submit = false;
				}
				else if($("#from_year").val() == "") {
					error_message = "Please select the year of start date";
					$("#from_year").focus();
					submit = false;
				}
				else if($("#starting_money_hand").val() == "") {
					error_message = "Please enter starting money on hand";
					$("#starting_money_hand").focus();
					submit = false;
				}
				else if(!($.isNumeric($("#starting_money_hand").val()))) {
					error_message = "Starting money on hand must be numeric";
					$("#starting_money_hand").focus();
					submit = false;
				}
				else if($("#starting_money_hand").val() <=  0) {
					error_message = "Starting money on hand must be greater than 0";
					$("#starting_money_hand").focus();
					submit = false;
				}
				else if($("#enable_banking").is(':checked')) {
					if($("#starting_money_bank").val() == "") {
						error_message = "Please enter a valid amount for money on bank";
						$("#starting_money_bank").focus();
						submit = false;
					}
					else if(!($.isNumeric($("#starting_money_bank").val()))) {
						error_message = "Starting money on bank must be numeric";
						$("#starting_money_bank").focus();
						submit = false;
					}
					else if($("#starting_money_bank").val() <=  0) {
						error_message = "Starting money on bank must be greater than 0";
						$("#starting_money_bank").focus();
						submit = false;
					}
				}
				if(submit == true && $("#resource_code").val() == "") {
					error_message = "Please enter your resource for the money";
					$("#resource_code").focus();
					submit = false;
				}
				
				if(submit) {
					$(".error").fadeOut("slow");
					return true;
				}
				else {
					$("#error_message").text(error_message);
					$(".error").fadeIn("slow");
					return false;
				}
			}
			
			$ ( document ).ready(function() {
				$("#enable_banking").click(function() {
					onclick_banking();
				});
				$("input:reset").click(function() {
					$('#starting_money_bank').attr('disabled', 'disabled');
					$('.error').fadeOut('slow');
				});
				$("input:submit").click(function() {
					return validate_form();
				});
			});
		</script>
	</head>
	<body>
		<div id="tym_wrapper">
			<div id="tym_common_invisible_box" style="width:600px">
				<a href='logout' class="blue_link right" style="display:block;">Log out-></a>
			</div>
			<div id="tym_common_box" style="width:600px">
				<div class="blue bold">To continue using this tracker, you are required to enter the following information:</div><br/>
				<form action='home' method='POST' name='home_ini_form' id='home_ini_form'>
					<table width='400' class="center">
						<tr>
							<td width='175' class="left">Enable banking</td>
							<td width='25'>:</td>
							<td width='200'><input type='checkbox' name='enable_banking' id='enable_banking'/></td>
						</tr>
						<tr>
							<td class="left">Enable savings</td>
							<td>:</td>
							<td><input type='checkbox' name='enable_savings'/></td>
						</tr>
						<tr>
							<td class="left">Start Date of cycle</td>
							<td>:</td>
							<td>
								<select name='from_month' id='from_month'>
									<?php show_month_dropdown(0); ?>
								</select>
								<select name='from_day' id='from_day'>
									<?php show_day_dropdown(0); ?>
								</select>
								<select name='from_year' id='from_year'>
									<?php show_year_dropdown(0); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td class="blue bold left">Starting Money</td>
						</tr>
						<tr>
							<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp To Hand</td>
							<td>:</td>
							<td><input type='text' name='starting_money_hand' id='starting_money_hand'/></td>
						</tr>
						<tr>
							<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp To Bank</td>
							<td>:</td>
							<td><input type='text' name='starting_money_bank' id='starting_money_bank' disabled/></td>
						</tr>
						<tr>
							<td class="left">Resource Name</td>
							<td>:</td>
							<td><input type='text' name='resource_code' id='resource_code'/></td>
						</tr>
						<tr>
					</table>
					<div id="tym_msg_wrapper">
						<div class='error'><label id='error_message' name='error_message'></label></div>
					</div>
					<center>
						<input type='submit' class="blue_button" value='Submit' name='submit'/>
						<input type='reset' class="blue_button" value='Reset'/>
					</center>
				</form>
			</div>
		</div>
	</body>
</html>