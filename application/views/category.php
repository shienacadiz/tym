<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo TYM_TITLE; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo "$base"."$css"; ?>"/>
		<script src="<?php echo "$base"."$jquery"; ?>"></script>
		<script>
			function validate_form() {
				var submit = true;
				var error_message = "";
				var categories = <?php echo json_encode($code_array); ?>;
				$(".notice").fadeOut("slow");
				
				if($("#category_code").val() == "") {
					error_message = "Enter a category code";
					$("#category_code").focus();
					submit = false;
				}
				else {
					var id = $("#category_id").val();
					var code = $("#category_code").val();
					for(x=0 ; x<categories['code'].length && submit == true ; x++) {
						if(((id != null && categories['id'][x] != id) || (id==null)) && categories['code'][x].toLowerCase() == code.toLowerCase()) {
							error_message = "Code already exists";
							$("#category_code").focus();
							submit = false;
						}
					}	
				}
				if (submit && ($("#category_desc").val() == "")) {
					error_message = "Enter a category description";
					$("#category_desc").focus();
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
								<li><a href='<?php echo $base."withdraw"; ?>'>Withdraw Money</a></li>
								<li><a href='<?php echo $base."money"; ?>'>Add Cycle Money</a></li>
								<li class="last"><a href='<?php echo $base."cycle"; ?>'>Next Cycle</a></li>
							 </ul>
						</div>
					</div>
					<div id="tym_sidebar_holder">
						<div id="tym_sidebar_setup"></div>
						<div id="tym_sidebar_menu_box">
							<ul class="menu_list">
								<li class="first"><a class='active' href='<?php echo $base."category"; ?>'>Categories</a></li>
								<li class="last"><a href='<?php echo $base."resources"; ?>'>Resources</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div id="tym_right_content_wrapper">
					<div id="tym_right_content" class="center">
						<h2>List of Expenses Category</h2>
						<table width='500' class='center'>
							<?php
							if(empty($category_array)) {
								?>
								<tr><td><font color='red' style='bold'><center>No Records Found!</center></font></td></tr>
								<?php
							}
							else {
								?>
								<tr>
									<td class='left'><b>Code</b></td>
									<td class='left'><b>Description</b></td>
								</tr>
								<?php
								$ctr = 0;
								foreach($category_array AS $category) {
									if(isset($active) AND $active == $category['category_id']) {
										echo "<tr style='background-color:#7CA6BA;'>";
									}
									else {
										echo "<tr>";
									}
									?>
										<td class='left' width='150'><?php echo stripslashes($category['category_code']); ?></td>
										<td class='left' width='290'><?php echo stripslashes($category['category_desc']); ?></td>
										<td width='30'><a href="<?php echo $base."category/edit/".$category['category_id']; ?>">Edit</a></td>
										<td width='40'><a href="<?php echo $base."category/del/".$category['category_id']; ?>" onclick="return confirm('Are you sure you want to delete: <?php echo stripslashes($category['category_code']); ?>')">Delete</a></td>							
									</tr>
									<?php
									$ctr++;
								}
								?>
								<tr>
									<td colspan='4'><?php echo $ctr; ?> category found.</td>
								</tr>
								<?php
							}
							?>
						</table>
						<br/><br/>		
						<form action='<?php echo $base."category"; ?>' method='POST' name='category_form' id='category_form'>
							<table width='500' class='center'>
								<tr>
									<td colspan='5'><?php echo $label_title; ?></td>
								</tr>
								<tr>
									<td>Code</td>
									<td><input type='text' name='category_code' id='category_code'size='10' value="<?php if(isset($edit['category_code'])) echo stripslashes($edit['category_code']); ?>"/></td>
									<td>Description</td>
									<td><input type='text' name='category_desc' id='category_desc' size='25' value="<?php if(isset($edit['category_desc'])) echo stripslashes($edit['category_desc']); ?>"/></td>
									<td width='65'><input type='submit' value='<?php echo $label_button; ?>' name='submit_button'/></td>
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
							<input type='hidden' name='category_id' id='category_id' value='<?php if(isset($edit['category_id'])) echo $edit['category_id']; ?>'/>
						</form>
					</div>
				</div>
			</div>
			<?php include_once("footer.php"); ?>
		</div>
	</body>
</html>