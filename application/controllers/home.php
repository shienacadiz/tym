<?php include_once("public_functions/verify_session.php");?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8"/>
		<?php
		include_once("public_functions/window_title.php");
		include_once("public_functions/functions.php");
		?>
		<script type="text/javascript">
			function delayer(){
				window.location = "home.php"
			}
			function hideOnBanking() {
				var enableBanking = document.getElementById('enableBanking');
				var starting_money_bank = document.getElementById('starting_money_bank');
				if (enableBanking.checked) {
					starting_money_bank.disabled = false;
				}
				else {
					starting_money_bank.value = "";
					starting_money_bank.disabled = true;
				}
			}
			function validateRemaining() {
				var starting_money_bank = document.getElementById('starting_money_bank');
				var starting_money_hand = document.getElementById('starting_money_hand');
				if(parseFloat(starting_money_hand.value) <= 0) {
					alert('Starting money on hand must be greater than zero');
					starting_money_hand.focus();
					return false;
				}
				else if (starting_money_bank.disabled == false) {
					if(starting_money_bank.value == "") {
						alert('Please enter a valid amount for money on bank');
						starting_money_bank.focus();
						return false;
					}
					else if (isNaN(starting_money_bank.value)) {
						alert('Money on bank must be numeric');
						starting_money_bank.focus();
						return false;
					}
					else if (parseFloat(starting_money_bank.value) <= 0) {
						alert('Money on bank must be greater than zero');
						starting_money_bank.focus();
						return false;					
					}
				}
			}
		</script>
		<script src="public_functions/gen_validatorv4.js" type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" href="resources/tym_stylesheet.css"/>
	</head>
	<body>
		<?php
		include_once("public_functions/db_connection.php");
		if (isset($_POST['submit'])) {
			$add_from_month = $_POST['from_month'];
			$add_from_day = $_POST['from_day'];
			$add_from_year = $_POST['from_year'];
			$add_starting_money_hand = $_POST['starting_money_hand'];
			$add_starting_money_bank = $_POST['starting_money_bank'];
			$add_resource_code = $_POST['resource_code'];
			$add_enable_banking = $_POST['enableBanking'];
			$add_enable_savings = $_POST['enableSavings'];
			
			//inserts resource first
			$query = MYSQL_QUERY("	INSERT INTO resources
							(
								user,
								resource_code
							)
						VALUES
							(
								'$user',
								'$add_resource_code'
							)
						");
			$add_resource_id = MYSQL_INSERT_ID();
			
			//insert the data
			//check which is higher - bank or in hand. Higher will be put in cycle table. lower would be in money table
			if($add_starting_money_hand > $add_starting_money_bank) {	//on hand money is higher
				$query_toCycle = MYSQL_QUERY("	INSERT INTO cycle
									(
										user,
										from_month,
										from_day,
										from_year,
										starting_money,
										resource_id,
										onHand_onBank
									)
								VALUES
									(
										'$user',
										'$add_from_month',
										'$add_from_day',
										'$add_from_year',
										'$add_starting_money_hand',
										'$add_resource_id',
										'1'
									)
								");
				$add_cycle_id = MYSQL_INSERT_ID();
				$query_toMoney = MYSQL_QUERY("	INSERT INTO money
									(
										user,
										cycle_id,
										resource_id,
										month,
										day,
										year,
										description,
										amount,
										onHand_onBank
									)
								VALUES
									(
										'$user',
										'$add_cycle_id',
										'$add_resource_id',
										'$add_from_month',
										'$add_from_day',
										'$add_from_year',
										'Initial money',
										'$add_starting_money_bank',
										'2'
									)
								");
			}
			else {	//on bank money is higher
				$query_toCycle = MYSQL_QUERY("	INSERT INTO cycle
									(
										user,
										from_month,
										from_day,
										from_year,
										starting_money,
										resource_id,
										onHand_onBank
									)
								VALUES
									(
										'$user',
										'$add_from_month',
										'$add_from_day',
										'$add_from_year',
										'$add_starting_money_bank',
										'$add_resource_id',
										'2'
									)
								");
				$add_cycle_id = MYSQL_INSERT_ID();
				$query_toMoney = MYSQL_QUERY("	INSERT INTO money
									(
										user,
										cycle_id,
										resource_id,
										month,
										day,
										year,
										description,
										amount,
										onHand_onBank
									)
								VALUES
									(
										'$user',
										'$add_cycle_id',
										'$add_resource_id',
										'$add_from_month',
										'$add_from_day',
										'$add_from_year',
										'Initial money',
										'$add_starting_money_hand',
										'1'
									)
								");
			}
			//just put 0 to add_enable_banking if not checked, else just as is (existing value - 1)
			if($add_enable_banking == NULL) {
				$add_enable_banking = 0;
			}
			
			//updates the user table
			$query = MYSQL_QUERY("	UPDATE
							users
						SET
							cycle_id = '$add_cycle_id',
							banking_flag = '$add_enable_banking',
							savings_flag = '$add_enable_savings'
						WHERE
							username = '$user'
						");
			
			//finally adds a session variable for cycle_id/banking_flag to be used through out the system
			$_SESSION['cycle_id'] = $add_cycle_id;
			$_SESSION['banking_flag'] = $add_enable_banking;
			$_SESSION['savings_flag'] = $add_enable_savings;
		}
		$cycle_id = $_SESSION['cycle_id'];
		if ($cycle_id <= 0) {
			?>
			<div id="tym_common_invisible_box" style="width:600px">
				<a href='logout.php' class="blue_link right" style="display:block;">Log out→</a>
			</div>
			<div id="tym_common_box" style="width:600px">
				<div class="blue bold">To continue using this tracker, you are required to enter the following information:</div>
				<form action='home.php' method='POST' name='home_form'>
					<br/>
					<table width='350' class="center">
						<tr>
							<td width='150' class="left">Enable banking</td>
							<td width='20'>:</td>
							<td width='180'><input type='checkbox' name='enableBanking' id='enableBanking' value='1' onclick='hideOnBanking();'/></td>
						</tr>
						<tr>
							<td class="left">Enable savings</td>
							<td>:</td>
							<td><input type='checkbox' name='enableSavings' value='1'/></td>
						</tr>
						<tr>
							<td class="left">Start Date of cycle</td>
							<td>:</td>
							<td>
								<select name='from_month'>
									<?php show_month_dropdown(); ?>
								</select>
								<select name='from_day'>
									<?php show_day_dropdown(); ?>
								</select>
								<select name='from_year'>
									<?php show_year_dropdown(); ?>
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
							<td><input type='text' name='resource_code'/></td>
						</tr>
						<tr>
							<td colspan='3' class="center">
								<br/>
								<input type='submit' class="blue_button" value='Submit' name='submit' onclick="return validateRemaining();"/>
								<input type='reset' class="blue_button" value='Reset' onclick="document.getElementById('starting_money_bank').disabled = true;"/>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<script type="text/javascript">
				var frmvalidator = new Validator("home_form");
				frmvalidator.addValidation("from_month","req","Please select the month of start date");
				frmvalidator.addValidation("from_day","req","Please select the day of start date");
				frmvalidator.addValidation("from_year","req","Please select the year of start date");
				frmvalidator.addValidation("starting_money_hand","req","Please enter starting money on hand");
				frmvalidator.addValidation("starting_money_hand","numeric","Starting money on hand must be numeric");
				frmvalidator.addValidation("resource_code","req","Please enter your resource for the money");
			</script>
			<?php
			exit();
		}
		?>
		<div id="tym_wrapper">
			<div id="tym_header"></div>
			<div id="tym_menubar">
				<li id="menu_home"><a class="active" href='home.php'></a></li>
				<li id="menu_reports"><a href='reports.php'></a></li>
				<li id="menu_savings"><a href='savings.php'></a></li>
				<li id="menu_settings"><a href='useraccount.php'></a></li>
				<li id="menu_logout"><a href='logout.php'></a></li>
			</div>
			<div id="tym_content_wrapper">
				<?php include_once("sidebar.php"); ?>
				<div id="tym_right_content_wrapper" class="center">
					<div id="tym_right_content">
						<?php
						//GETTING THE SUMMARY
						
						//Cycle start date
						$query = MYSQL_QUERY("	SELECT
										*
									FROM
										cycle
									WHERE
										cycle_id = '$cycle_id'
									");
						$from_month = MYSQL_RESULT($query,0,"from_month");
						$formatted_from_month = format_month($from_month);
						$from_day = MYSQL_RESULT($query,0,"from_day");
						$from_year = MYSQL_RESULT($query,0,"from_year");
						$cycleStartDate = $formatted_from_month." ".$from_day.", ".$from_year;
						
						//getting the summaries
						$overallBudget = getOverallBudget($cycle_id);
						$totalExpenses = getAllExpenses($from_month, $from_day, $from_year, "", "", "");
						$totalRemaining = getTotalRemainingBudget($cycle_id);
						$remainingOnBank = getRemainingOnBank($cycle_id);
						$remainingOnHand = getRemainingOnHand($cycle_id);
						$serviceCharges = getAllServiceCharge($cycle_id);
						
						?>
						<h3>SUMMARY</h3>
						<table class='center' width='320'>
							<tr>
								<td width='200' class='left'>Current Cycle Start Date</td>
								<td width='20'>:</td>
								<td width='100' class='left'><?php echo $cycleStartDate; ?></td>
							</tr>
							<tr>
								<td class='left'>Overall budget</td>
								<td>:</td>
								<td class='left'><?php echo number_format($overallBudget,2); ?></td>
							</tr>
							<tr>
								<td class='left'>Total Remaining</td>
								<td>:</td>
								<td class='left'><?php echo number_format($totalRemaining,2); ?></td>
							</tr>
							<?php
							if($_SESSION['banking_flag'] == TRUE) {
								?>
								<tr>
									<td class='left'>On Bank</td>
									<td>:</td>
									<td class='left'><?php echo number_format($remainingOnBank,2); ?></td>
								</tr>
								<tr>
									<td class='left'>On Hand</td>
									<td>:</td>
									<td class='left'><?php echo number_format($remainingOnHand,2); ?></td>
								<?php
							}
							?>
							</tr>
							<tr>
								<td class='left'>Total Expenses</td>
								<td>:</td>
								<td class='left'><?php echo number_format($totalExpenses,2);?></td>
							</tr>
							<?php
							if($serviceCharges != 0) {
								echo "	<tr>
									<td>
										Service charges on withdrawals
									</td>
									<td>:</td>
										<td>".number_format($serviceCharges,2)."</td>
									</tr>";
							}	
							?>
						</table>
					</div>
				</div>
			</div>
			<?php include_once("footer.php"); ?>
		</div>
	</body>
</html>