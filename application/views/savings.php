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
				<li id="menu_home"><a href='<?php echo $base."home"; ?>'></a></li>
				<li id="menu_reports"><a href='<?php echo $base."reports"; ?>'></a></li>
				<li id="menu_savings"><a class="active" href='<?php echo $base."savings"; ?>'></a></li>
				<li id="menu_settings"><a href='<?php echo $base."useraccount"; ?>'></a></li>
				<li id="menu_logout"><a href='<?php echo $base."logout"; ?>'></a></li>
			</div>
			<div id="tym_content_wrapper">
				<?php include_once("sidebar.php"); ?>
				<div id="tym_right_content_wrapper" class="center">
					<div id="tym_right_content">
						<h2>Savings</h2>
						<table width='400' class='center'>
							<tr>
								<td width='250' class='left'><b>Cycle span date</b></td>
								<td width='150' class='center'><b>Savings amount</b></td>
							</tr>
							<?php
							if(empty($savings_array)) {
								?>
								<tr>
									<td colspan='2'><b>No Savings Yet!</b></td>
								</tr>
								<?php
							}
							else {
								foreach($savings_array AS $savings) {
									if($savings['to_year'] == 0) {
										$cycle_span = format_month($savings['from_month'])." ".$savings['from_day'].", ".$savings['from_year']." - PRESENT";
									}
									else {
										$cycle_span = format_month($savings['from_month'])." ".$savings['from_day'].", ".$savings['from_year']." - ".
										format_month($savings['to_month'])." ".$savings['to_day'].", ".$savings['to_year'];
									}
									$savings['amount'] = number_format($savings['amount'],2);
									?>
									<tr>
										<td class='left'><?php echo $cycle_span; ?></td>
										<td><?php echo $savings['amount']; ?></td>
									<?php
								}
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