<?php include_once("public_functions/verify_session.php");?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8"/>
	</head>
	<body>
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