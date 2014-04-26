<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8"/>
		<title><?php echo TYM_TITLE; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo "$base"."$css";?>"/>
	</head>
	<body>
		<div id="tym_wrapper">
			<div id="tym_header"></div>
			<div id="tym_menubar">
				<li id="menu_home"><a class="active" href='<?php echo $base."home";?>'></a></li>
				<li id="menu_reports"><a href='<?php echo $base."reports";?>'></a></li>
				<li id="menu_savings"><a href='<?php echo $base."savings";?>'></a></li>
				<li id="menu_settings"><a href='<?php echo $base."useraccount";?>'></a></li>
				<li id="menu_logout"><a href='<?php echo $base."logout";?>'></a></li>
			</div>
			<div id="tym_content_wrapper">
				<?php include_once("sidebar.php"); ?>
				<div id="tym_right_content_wrapper" class="center">
					<div id="tym_right_content">
						<h3>SUMMARY</h3>
						<table class='center' width='320'>
							<tr>
								<td width='200' class='left'>Current Cycle Start Date</td>
								<td width='20'>:</td>
								<td width='100' class='left'><?php echo $start_date; ?></td>
							</tr>
							<tr>
								<td class='left'>Overall budget</td>
								<td>:</td>
								<td class='left'><?php echo number_format($overall_budget,2); ?></td>
							</tr>
							<tr>
								<td class='left'>Total Remaining</td>
								<td>:</td>
								<td class='left'><?php echo number_format($total_remaining,2); ?></td>
							</tr>
							<?php
							if($this->session->userdata('banking_flag')) {
							?>
								<tr>
									<td class='left'>On Bank</td>
									<td>:</td>
									<td class='left'><?php echo number_format($on_bank,2); ?></td>
								</tr>
								<tr>
									<td class='left'>On Hand</td>
									<td>:</td>
									<td class='left'><?php echo number_format($on_hand,2); ?></td>
								</tr>
							<?php
							}
							?>
							<tr>
								<td class='left'>Total Expenses</td>
								<td>:</td>
								<td class='left'><?php echo number_format($total_expenses,2); ?></td>
							</tr>
							<?php
							if($service_charges > 0) {
							?>
								<tr>
									<td class='left'>
										Service charges on withdrawals
									</td>
									<td>:</td>
									<td class='left'><?php echo number_format($service_charges,2); ?></td>
								</tr>
							<?php
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