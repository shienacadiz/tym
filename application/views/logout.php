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
		<link rel="stylesheet" type="text/css" href="<?php echo "$base/$css";?>"/>
	</head>
	<body>
		<center>
        	<div id="tym_common_box">
                <h1>Logging Out...</h1>
                <h3>Please wait</h3>
			</div>
			<body onLoad="setTimeout('delayer()', 3000)">
		</center>
	</body>
</html>