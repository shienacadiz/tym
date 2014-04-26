<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo TYM_TITLE; ?></title>
		<script src="<?php echo "$base"."$jquery"; ?>"></script>
		<script>
			$( document ).ready(function() {
				if($("#success_message").text() != "") {
					$(".notice").fadeIn();
				}
			});
		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo "$base"."$css";?>"/>
	</head>
	<body>
		<div id="tym_wrapper">
			<div id="tym_header"></div>
			<div id="tym_menubar">
				<li id="menu_home"><a href='<?php echo $base."home"; ?>'></a></li>
				<li id="menu_reports"><a href='<?php echo $base."reports"; ?>'></a></li>
				<li id="menu_savings"><a href='<?php echo $base."savings"; ?>'></a></li>
				<li id="menu_settings"><a class="active" href='<?php echo $base."useraccount"; ?>'></a></li>
				<li id="menu_logout"><a href='<?php echo $base."logout"; ?>'></a></li>
			</div>
			<div id="tym_content_wrapper">
				<?php include_once("sidebar.php"); ?>
				<div id="tym_right_content_wrapper" class="center">
					<div id="tym_right_content">
						<h2>User Account Settings</h2>
						<form action="<?php echo $base."useraccount"; ?>" method="POST">
							<table width='260' class='center'>
								<tr>
									<td width='210' class='left'>Enable Banking</td>
									<td width='20'>:</td>
									<td width='30'>
										<?php
										if($this->session->userdata('banking_flag'))
											echo "<input type='checkbox' name='banking_flag' CHECKED/>";
										else
											echo "<input type='checkbox' name='banking_flag'/>";
										?>
									</td>
								</tr>
								<tr>
									<td class='left'>Enable Savings</td>
									<td>:</td>
									<td>
										<?php
										if($this->session->userdata('savings_flag'))
											echo "<input type='checkbox' name='savings_flag' CHECKED/>";
										else
											echo "<input type='checkbox' name='savings_flag'/>";
										?>
									</td>
								</tr>
								<tr>
									<td colspan='3' align='center'>
										<input class='blue_button' type='submit' name='submit' value='Update'/>
									</td>
								</tr>
							</table>
							<div id="tym_msg_wrapper">
								<div class="notice">
									<label id='success_message' name='success_message'><?php if(isset($message)) echo $message; ?></label>
								</div>
							</div>
						</form>
						<b>Other functions and setup coming up soon!</b>
					</div>
				</div>
			</div>
			<?php include_once("footer.php"); ?>
		</div>
	</body>
</html>