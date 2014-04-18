<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8"/>
		<title><?php echo TYM_TITLE; ?></title>
		<script type="text/javascript">
			function delayer(){
				window.location = "index"
			}
		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo "$base/$css"; ?>"/>
	</head>
	<body>
		<div id="tym_common_box">
			<br/>
			Your application has been sent for approval.<br/>
			Please get back again soon. Thank you.<br/>
			Redirecting to home page...
		</div>
		<body onLoad="setTimeout('delayer()', 3000)">
	</body>
</html>