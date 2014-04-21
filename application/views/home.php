<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8"/>
		<title><?php echo TYM_TITLE; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo "$base/$css";?>"/>
	</head>
	<body>
		<div id="tym_wrapper">
			<div id="tym_header"></div>
			<div id="tym_menubar">
				<li id="menu_home"><a class="active" href='home'></a></li>
				<li id="menu_reports"><a href='reports'></a></li>
				<li id="menu_savings"><a href='savings'></a></li>
				<li id="menu_settings"><a href='useraccount'></a></li>
				<li id="menu_logout"><a href='logout'></a></li>
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
								<td class='left'></td>
							</tr>
							<tr>
								<td class='left'>Total Remaining</td>
								<td>:</td>
								<td class='left'></td>
							</tr>
							<?php
							if($this->session->userdata('banking_flag')) {
							?>
								<tr>
									<td class='left'>On Bank</td>
									<td>:</td>
									<td class='left'></td>
								</tr>
								<tr>
									<td class='left'>On Hand</td>
									<td>:</td>
									<td class='left'></td>
								</tr>
							<?php
							}
							?>
							<tr>
								<td class='left'>Total Expenses</td>
								<td>:</td>
								<td class='left'></td>
							</tr>
							<tr>
								<td class='left'>
									Service charges on withdrawals
								</td>
								<td>:</td>
								<td class='left'></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<?php include_once("footer.php"); ?>
		</div>
	</body>
</html>