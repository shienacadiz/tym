<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title><?php echo TYM_TITLE; ?></title>
		<link rel='stylesheet' type='text/css' href="<?php echo "$base"."$css"; ?>"/>
		<script src="<?php echo "$base"."$jquery"; ?>"></script>
		<script>
			function validate_form() {
				var submit = true;
				var error_message = "";
				var existing_code = <?php echo json_encode($code_array); ?>;
				$(".notice").fadeOut("slow");
				
				if($("#resource_code").val() == "") {
					error_message = "Enter a resource code";
					$("#resource_code").focus();
					submit = false;
				}
				else {
					var id = $("#resource_id").val();
					var code = $("#resource_code").val();
					for(x=0 ; x<existing_code['code'].length && submit == true ; x++) {
						if(((id != null && existing_code['id'][x] != id) || (id==null)) && existing_code['code'][x].toLowerCase() == code.toLowerCase()) {
							error_message = "Code already exists";
							$("#resource_code").focus();
							submit = false;
						}
					}	
				}
				if (submit && ($("#resource_desc").val() == "")) {
					error_message = "Enter a resource description";
					$("#resource_desc").focus();
					submit = false;
				}
				
				if(submit) {
					$(".error").fadeOut("slow");
					$("#resource_form").submit();
				}
				else {
					$("#error_message").text(error_message);
					$(".error").fadeIn("slow");
					return false;
				}
			}
			$( document ).ready(function() {
				if($("#success_message").text() != "") {
					$(".notice").fadeIn("slow");
				}
				else if($("#error_message").text() != "") {
					$(".error").fadeIn("slow");
				}
				$("input:submit").click(function() {
					$("tr").removeAttr('style');
					return validate_form();
				});
			});
		</script>
	</head>
	<body>
		<div id="tym_wrapper">
			<div id="tym_header"></div>
			<div id="tym_menubar">
				<?php include_once("menubar.php"); ?>
			</div>
			<div id="tym_content_wrapper">
				<div id="tym_sidebar">
					<div id="tym_sidebar_holder">
						<div id="tym_sidebar_transactions"></div>
						<div id="tym_sidebar_menu_box">
							<ul class="menu_list">
								<li class="first"><a href='<?php echo $base."expenses"; ?>'>Expenses</a></li>
								<?php
								if($this->session->userdata('banking_flag')) {
									?>
									<li><a href='<?php echo $base."withdraw"; ?>'>Withdraw Money</a></li>
									<?php
								}
								?>
								<li><a href='<?php echo $base."money"; ?>'>Add Cycle Money</a></li>
								<li class="last"><a href='<?php echo $base."cycle"; ?>'>Next Cycle</a></li>
							 </ul>
						</div>
					</div>
					<div id="tym_sidebar_holder">
						<div id="tym_sidebar_setup"></div>
						<div id="tym_sidebar_menu_box">
							<ul class="menu_list">
								<li class="first"><a href='<?php echo $base."category"; ?>'>Categories</a></li>
								<li class="last"><a class='active' href='<?php echo $base."resources"; ?>'>Resources</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div id="tym_right_content_wrapper">
					<div id="tym_right_content" class="center">
						<h2>List of Money Resources</h2>
						<table width='500' class='center'>
							<tr>
								<td class='left'><b>Name</b></td>
								<td class='left'><b>Description</b></td>
							</tr>
							<?php
							$ctr = 0;
							foreach($resources_array AS $resource) {
								if(isset($active) AND $active == $resource['resource_id']) {
									echo "<tr style='background-color:#7CA6BA;'>";
								}
								else {
									echo "<tr>";
								}
								?>
									<td class='left' width='150'><?php echo stripslashes($resource['resource_code']); ?></td>
									<td class='left' width='290'><?php echo stripslashes($resource['resource_desc']); ?></td>
									<td width='30'><a href="<?php echo $base."resources/edit/".$resource['resource_id']; ?>">Edit</a></td>
									<td width='40'><a href="<?php echo $base."resources/del/".$resource['resource_id']; ?>" onclick="return confirm('Are you sure you want to delete: <?php echo stripslashes($resource['resource_code']); ?>')">Delete</a></td>							
								</tr>
								<?php
								$ctr++;
							}
							?>
							<tr>
								<td colspan='4'><?php echo $ctr; ?> resources found.</td>
							</tr>
						</table>
						<br/><br/>		
						<form action='<?php echo $base."resources"; ?>' method='POST' name='resource_form' id='resource_form'>
						<table width='500' class='center'>
							<tr>
								<td colspan='5'><?php echo $label_title; ?></td>
							</tr>
							<tr>
								<td>Code</td>
								<td><input type='text' name='resource_code' id='resource_code' size='10' value="<?php if(isset($edit['resource_code'])) echo stripslashes($edit['resource_code']); ?>"/></td>
								<td>Description</td>
								<td><input type='text' name='resource_desc' id='resource_desc' size='25' value="<?php if(isset($edit['resource_desc'])) echo stripslashes($edit['resource_desc']); ?>"/></td>
								<td width='65'><input type='submit' value='<?php echo $label_button	; ?>' name='submit_button'/></td>
							</tr>
						</table>
						<div id="tym_msg_wrapper">
							<div class="notice">
								<label id='success_message' name='success_message'><?php if(isset($success_message)) echo $success_message; ?></label>
							</div>
							<div class='error'>
								<label id='error_message' name='error_message'><?php if(isset($error_message)) echo $error_message; ?></label>
							</div>
						</div>
						<input type='hidden' name='resource_id' id='resource_id' value='<?php if(isset($edit['resource_id'])) echo $edit['resource_id']; ?>'/>
						</form>
					</div>
				</div>
			</div>
			<?php include_once("footer.php"); ?>
		</div>
	</body>
</html>