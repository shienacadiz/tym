<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo TYM_TITLE; ?></title>
		<script src="<?php echo "$base"."$jquery"; ?>"></script>
		<script>
			function validate_form() {
				var submit = true;
				
				if($("#this_month").val() == "") {
					error_message = "Please select the month";
					$("#this_month").focus();
					submit = false;
				}
				else if($("#this_day").val() == "") {
					error_message = "Please select the day";
					$("#this_day").focus();
					submit = false;
				}
				else if($("#this_year").val() == "") {
					error_message = "Please select the year";
					$("#this_year").focus();
					submit = false;
				}
				else if($("#this_resource").val() == "") {
					error_message = "Please select the resource of your money";
					$("#this_resource").focus();
					submit = false;
				}
				else if($("#this_amount").val() == "") {
					error_message = "Please enter the amount";
					$("#this_amount").focus();
					submit = false;
				}
				else if(!($.isNumeric($("#this_amount").val()))) {
					error_message = "Amount must only be numeric";
					$("#this_amount").focus();
					submit = false;
				}
				else if($("#this_amount").val() <= 0) {
					error_message = "Amount must be greater than 0";
					$("#this_amount").focus();
					submit = false;
				}
				
				if(submit) {
					$(".error").fadeOut("slow");
				}
				else {
					$("#error_message").text(error_message);
					$(".error").fadeIn("slow");
					event.preventDefault();
				}
			}
			$ ( document ).ready(function() {
				$("#filter").change(function() {
					$("#filter_form").submit();
				});
				$("#submit").click(function() {
					validate_form();
				});
				if($("#success_message").text() != "") {
					$(".notice").fadeIn("slow");
				}
				else if($("#error_message").text() != "") {
					$(".error").fadeIn("slow");
				}
			});
		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo "$base"."$css"; ?>"/>
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
								<li class="first"><a href='<?php echo $base.'expenses';?>'>Expenses</a></li>
								<li><a href='<?php echo $base.'withdraw';?>'>Withdraw Money</a></li>
								<li><a class='active' href='<?php echo $base.'money';?>'>Add Cycle Money</a></li>
								<li class="last"><a href='<?php echo $base.'cycle';?>'>Next Cycle</a></li>
							 </ul>
						</div>
					</div>
					<div id="tym_sidebar_holder">
						<div id="tym_sidebar_setup"></div>
						<div id="tym_sidebar_menu_box">
							<ul class="menu_list">
								<li class="first"><a href='<?php echo $base.'category';?>'>Categories</a></li>
								<li class="last"><a href='<?php echo $base.'resources';?>'>Resources</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div id="tym_right_content_wrapper">
					<div id="tym_right_content" class="center">
						<h2>Additional Money to current budget cycle</h2>
						<form action='<?php echo $base.'money';?>' id='filter_form' method='POST'>
							<table class='center'>
								<tr>
									<td><b>Select Cycle</b>
									<td>
										<select name='filter' id='filter'>
											<?php
											foreach($cycle_array AS $cycle) {
												$from_date = format_month($cycle['from_month'])." ".$cycle['from_day'].", ".$cycle['from_year'];
												if($cycle['cycle_id'] == $this->session->userdata('cycle_id')) {
													$to_date = "PRESENT";
												}
												else {
													$to_date = format_month($cycle['to_month'])." ".$cycle['to_date'].", ".$cycle['to_year'];
												}
												$full_date = $from_date." - ".$to_date;
												if($cycle['cycle_id'] == $filter_cycle) {
													echo "<option value=".$cycle['cycle_id']." selected>$full_date</option>";
												}
												else {
													echo "<option value=".$cycle['cycle_id'].">$full_date</option>";
												}
											}
											?>
										</select>
									</td>
								</tr>
							</table>
							<table width='530' class='center'>
								<tr>
									<td class='left bold blue' width='120'>Date</td>
									<td class='left bold blue' width='200'>Description</td>
									<td class='left bold blue' width='100'>Resource</td>
									<td class='left bold blue' width='100'>Amount</td>
									<td class='left bold blue' width='10'></td>
								</tr>
								<tr>
									<td class='left'><?php echo format_month($initial_money['from_month'])." ".$initial_money['from_day'].", ".$initial_money['from_year'];?></td>
									<td class='left'>Starting Money</td>
									<td class='left'><?php echo $initial_money['resource_code']; ?></td>
									<td class='left'><?php echo number_format($initial_money['starting_money'],2); ?></td>
									<?php
									$total_money = $initial_money['starting_money'];
									$total_on_bank = 0;
									if($initial_money['onHand_onBank'] == 1) {
										if($this->session->userdata('banking_flag')) {
											echo "<td>*</td>";
										}
									}
									else { // onHand_onBank == 2
										$total_on_bank += $initial_money['starting_money'];
									}
									?>
								</tr>
								<?php
								foreach($money_array AS $money) {
									$full_date = format_month($money['month'])." ".$money['day'].", ".$money['year'];
									?>
									<tr>
										<td class='left'><?php echo $full_date; ?></td>
										<td class='left'><?php echo $money['description']; ?></td>
										<td class='left'>
											<?php
											if($money['resource_id'] == 0) { // money that has been moved through cycle change. not manually entered
												if($money['onHand_onBank'] == 1) {
													$resource_code = "On Hand";
												}
												elseif ($money['onHand_onBank'] == 2) {
													$resource_code = "On Bank";
												}
											}
											else {
												$resource_code = $money['resource_code'];
											}
											echo $resource_code;
											?>
										</td>
										<td class='left'><?php echo number_format($money['amount'],2); ?></td>
										<?php
										if($money['onHand_onBank'] == 1) {
											if($this->session->userdata('banking_flag')) {
												echo "<td>*</td>";
											}
										}
										else { // onHand_onBank == 2
											$total_on_bank += $money['amount'];
										}
										$total_money += $money['amount'];
										?>
									</tr>
									<?php
								}
								?>
							</table>
						</form>
						<?php
						if($filter_cycle == $this->session->userdata('cycle_id')) { // allowed to add only if it is the current cycle
							?>
							<form action='<?php echo $base.'money';?>' id='money_form' method='POST'> 
								<table width='500' class='center'>
									<tr>
										<td><h3><b>+</b></h3></td>
									</tr>
									<tr>
										<td class='left'>Date</td>
										<td class='left'>:</td>
										<td class='left'>
											<select name='this_month' id='this_month'>
												<?php show_month_dropdown(0); ?>
											</select>
											<select name='this_day' id='this_day'>
												<?php show_day_dropdown(0); ?>
											</select>
											<select name='this_year' id='this_year'>
												<?php show_year_dropdown(0); ?>
											</select>
										</td>
										<td class='left'>Resource</td>
										<td class='left'>:</td>
										<td class='left'>
											<select name='this_resource' id='this_resource'>
												<option value=''>----</option>
												<?php
												foreach($resource_array AS $resource) {
													echo "<option value='".$resource['resource_id']."'>".$resource['resource_code']."</option>";
												}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td class='left'>Description</td>
										<td class='left'>:</td>
										<td class='left'><input type='text' name='this_description' id='this_description' size='22'/></td>
										<td class='left'>Amount</td>
										<td class='left'>:</td>
										<td class='left'><input type='text' name='this_amount' id='this_amount' size='8'/></td>
									</tr>
									<?php
									if($this->session->userdata('banking_flag') || $this->session->userdata('savings_flag')) {
										/* 
											addTo
											1 = to hand
											2 = to bank account
											3 = to savings account
										*/
										echo "	<tr>
													<td colspan='6' class='left'>
														Add to &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:
														<input type='radio' name='this_add_to' value='1' checked/>To Hand";
														if($this->session->userdata('banking_flag')) {
															echo "<input type='radio' name='this_add_to' value='2'/>To Bank";
														}
														if($this->session->userdata('savings_flag')) {
															echo "<input type='radio' name='this_add_to' value='3'/>To Savings account";
														}
														echo"	
													</td> 
												</tr>";
									}
									else {
										echo "<input type='hidden' name='this_add_to' value='1'/>"; //default to hand
									}
									if($this->session->userdata('savings_flag')){
										echo "	<tr>
													<td colspan='6' class='left'>*Savings money wouldn't be listed here</td>
												</tr>";
									}
									?>
									<tr>
										<td colspan='6'>
											<center><input type='submit' value='Submit' name='submit' id='submit'/></center>
										</td>
									</tr>
								</table>
							</form>
							<?php
						}
						?>
						<div id="tym_msg_wrapper">
							<div class="notice">
								<label id='success_message' name='success_message'><?php if(isset($success_message)) echo $success_message; ?></label>
							</div>
							<div class='error'>
								<label id='error_message' name='error_message'><?php if(isset($error_message)) echo $error_message; ?></label>
							</div>
						</div>						
					</div>
				</div>
			</div>
			<?php include_once("footer.php"); ?>
		</div>
	</body>
</html>