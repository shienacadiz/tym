<?php
//returns the string equivalent of numerical month (1 return 'Jan')
function format_month($var){
	if ($var == '1'){
		$formatted = 'Jan';
	}
	elseif ($var == '2'){
		$formatted = 'Feb';
	}
	elseif ($var == '3'){
		$formatted = 'Mar';
	}
	elseif ($var == '4'){
		$formatted = 'Apr';
	}
	elseif ($var == '5'){
		$formatted = 'May';
	}
	elseif ($var == '6'){
		$formatted = 'June';
	}
	elseif ($var == '7'){
		$formatted = 'July';
	}
	elseif ($var == '8'){
		$formatted = 'Aug';
	}
	elseif ($var == '9'){
		$formatted = 'Sept';
	}
	elseif ($var == '10'){
		$formatted = 'Oct';
	}
	elseif ($var == '11'){
		$formatted = 'Nov';
	}
	elseif ($var == '12'){
		$formatted = 'Dec';
	}
	return $formatted;
}

//populate the dropdown for month and automatically set the dropdown according to the parameter
function show_month_dropdown($month) {
	if($month == NULL) {
		echo "<option value=''>----</selected>";
		$month = 0;
	}
	if($month == 1) {
		echo "<option value='1' selected>JAN</option>";
	}
	else {
		echo "<option value='1'>JAN</option>";
	}
	if($month == 2) {
		echo "<option value='2' selected>FEB</option>";
	}
	else {
		echo "<option value='2'>FEB</option>";
	}
	if($month == 3) {
		echo "<option value='3' selected>MAR</option>";
	}
	else {
		echo "<option value='3'>MAR</option>";
	}
	if($month == 4) {
		echo "<option value='4' selected>APR</option>";
	}
	else {
		echo "<option value='4'>APR</option>";
	}
	if($month == 5) {
		echo "<option value='5' selected>MAY</option>";
	}
	else {
		echo "<option value='5'>MAY</option>";
	}
	if($month == 6) {
		echo "<option value='6' selected>JUNE</option>";
	}
	else {
		echo "<option value='6'>JUNE</option>";
	}
	if($month == 7) {
		echo "<option value='7' selected>JULY</option>";
	}
	else {
		echo "<option value='7'>JULY</option>";
	}
	if($month == 8) {
		echo "<option value='8' selected>AUG</option>";
	}
	else {
		echo "<option value='8'>AUG</option>";
	}
	if($month == 9) {
		echo "<option value='9' selected>SEPT</option>";
	}
	else {
		echo "<option value='9'>SEPT</option>";
	}
	if($month == 10) {
		echo "<option value='10' selected>OCT</option>";
	}
	else {
		echo "<option value='10'>OCT</option>";
	}
	if($month == 11) {
		echo "<option value='11' selected>NOV</option>";
	}
	else {
		echo "<option value='11'>NOV</option>";
	}
	if($month == 12) {
		echo "<option value='12' selected>DEC</option>";
	}
	else {
		echo "<option value='12'>DEC</option>";
	}
}

//populate the dropdown for year and automatically set the dropdown according to the parameter
function show_year_dropdown($year) {
	if($year == NULL) {
		echo "<option value=''>----</selected>";
		$year = 0;
	}
	if($year == 2009) {
		echo "<option value='2009' selected>2009</selected>";
	}
	else {
		echo "<option value='2009'>2009</selected>";
	}
	if($year == 2010) {
		echo "<option value='2010' selected>2010</selected>";
	}
	else {
		echo "<option value='2010'>2010</selected>";
	}
	if($year == 2011) {
		echo "<option value='2011' selected>2011</selected>";
	}
	else {
		echo "<option value='2011'>2011</selected>";
	}
	if($year == 2012) {
		echo "<option value='2012' selected>2012</selected>";
	}
	else {
		echo "<option value='2012'>2012</selected>";
	}
	if($year == 2013) {
		echo "<option value='2013' selected>2013</selected>";
	}
	else {
		echo "<option value='2013'>2013</selected>";
	}
	if($year == 2014) {
		echo "<option value='2014' selected>2014</selected>";
	}
	else {
		echo "<option value='2014'>2014</selected>";
	}
	if($year == 2015) {
		echo "<option value='2015' selected>2015</selected>";
	}
	else {
		echo "<option value='2015'>2015</selected>";
	}
	if($year == 2016) {
		echo "<option value='2016' selected>2016</selected>";
	}
	else {
		echo "<option value='2016'>2016</selected>";
	}
	if($year == 2017) {
		echo "<option value='2017' selected>2017</selected>";
	}
	else {
		echo "<option value='2017'>2017</selected>";
	}
}

function show_day_dropdown($day) {
	if($day == NULL) {
		echo "<option value=''>--</option>";
	}
	if($day == 1) {
		echo "<option value='1' selected>1</option>";
	}
	else {
		echo "<option value='1'>1</option>";
	}
	if($day == 2) {
		echo "<option value='2' selected>2</option>";
	}
	else {
		echo "<option value='2'>2</option>";
	}
	if($day == 3) {
		echo "<option value='3' selected>3</option>";
	}
	else {
		echo "<option value='3'>3</option>";
	}
	if($day == 4) {
		echo "<option value='4' selected>4</option>";
	}
	else {
		echo "<option value='4'>4</option>";
	}
	if($day == 5) {
		echo "<option value='5' selected>5</option>";
	}
	else {
		echo "<option value='5'>5</option>";
	}
	if($day == 6) {
		echo "<option value='6' selected>6</option>";
	}
	else {
		echo "<option value='6'>6</option>";
	}
	if($day == 7) {
		echo "<option value='7' selected>7</option>";
	}
	else {
		echo "<option value='7'>7</option>";
	}
	if($day == 8) {
		echo "<option value='8' selected>8</option>";
	}
	else {
		echo "<option value='8'>8</option>";
	}
	if($day == 9) {
		echo "<option value='9' selected>9</option>";
	}
	else {
		echo "<option value='9'>9</option>";
	}
	if($day == 10) {
		echo "<option value='10' selected>10</option>";
	}
	else {
		echo "<option value='10'>10</option>";
	}
	if($day == 11) {
		echo "<option value='11' selected>11</option>";
	}
	else {
		echo "<option value='11'>11</option>";
	}
	if($day == 12) {
		echo "<option value='12' selected>12</option>";
	}
	else {
		echo "<option value='12'>12</option>";
	}
	if($day == 13) {
		echo "<option value='13' selected>13</option>";
	}
	else {
		echo "<option value='13'>13</option>";
	}
	if($day == 14) {
		echo "<option value='14' selected>14</option>";
	}
	else {
		echo "<option value='14'>14</option>";
	}
	if($day == 15) {
		echo "<option value='15' selected>15</option>";
	}
	else {
		echo "<option value='15'>15</option>";
	}
	if($day == 16) {
		echo "<option value='16' selected>16</option>";
	}
	else {
		echo "<option value='16'>16</option>";
	}
	if($day == 17) {
		echo "<option value='17' selected>17</option>";
	}
	else {
		echo "<option value='17'>17</option>";
	}
	if($day == 18) {
		echo "<option value='18' selected>18</option>";
	}
	else {
		echo "<option value='18'>18</option>";
	}
	if($day == 19) {
		echo "<option value='19' selected>19</option>";
	}
	else {
		echo "<option value='19'>19</option>";
	}
	if($day == 20) {
		echo "<option value='20' selected>20</option>";
	}
	else {
		echo "<option value='20'>20</option>";
	}
	if($day == 21) {
		echo "<option value='21' selected>21</option>";
	}
	else {
		echo "<option value='21'>21</option>";
	}
	if($day == 22) {
		echo "<option value='22' selected>22</option>";
	}
	else {
		echo "<option value='22'>22</option>";
	}
	if($day == 23) {
		echo "<option value='23' selected>23</option>";
	}
	else {
		echo "<option value='23'>23</option>";
	}
	if($day == 24) {
		echo "<option value='24' selected>24</option>";
	}
	else {
		echo "<option value='24'>24</option>";
	}
	if($day == 25) {
		echo "<option value='25' selected>25</option>";
	}
	else {
		echo "<option value='25'>25</option>";
	}
	if($day == 26) {
		echo "<option value='26' selected>26</option>";
	}
	else {
		echo "<option value='26'>26</option>";
	}
	if($day == 27) {
		echo "<option value='27' selected>27</option>";
	}
	else {
		echo "<option value='27'>27</option>";
	}
	if($day == 28) {
		echo "<option value='28' selected>28</option>";
	}
	else {
		echo "<option value='28'>28</option>";
	}
	if($day == 29) {
		echo "<option value='29' selected>29</option>";
	}
	else {
		echo "<option value='29'>29</option>";
	}
	if($day == 30) {
		echo "<option value='30' selected>30</option>";
	}
	else {
		echo "<option value='30'>30</option>";
	}
	if($day == 31) {
		echo "<option value='31' selected>31</option>";
	}
	else {
		echo "<option value='31'>31</option>";
	}
}

function getTotalRemainingBudget($cycle_id) {
	$current_user = $_SESSION['us3rnAme'];
	$totalBudget = getOverallBudget($cycle_id);
	$serviceChargesOnWithdrawals = getAllServiceCharge($cycle_id);
	//get cycle from and to date
	$query = MYSQL_QUERY("	SELECT
					*
				FROM
					cycle
				WHERE
					user = '$current_user' AND
					cycle_id = '$cycle_id'
			");
	$from_month = MYSQL_RESULT($query, 0, 'from_month');
	$from_day = MYSQL_RESULT($query, 0, 'from_day');
	$from_year = MYSQL_RESULT($query, 0, 'from_year');
	$to_month = MYSQL_RESULT($query, 0, 'to_month');
	$to_day = MYSQL_RESULT($query, 0, 'to_day');
	$to_year = MYSQL_RESULT($query, 0, 'to_year');
	
	$totalExpenses = getAllExpenses($from_month, $from_day, $from_year, $to_month, $to_day, $to_year); 
	$serviceChargesOnWithdrawals = getAllServiceCharge($cycle_id);
	$totalRemainingBudget = $totalBudget - $totalExpenses - $serviceChargesOnWithdrawals;
	
	return $totalRemainingBudget;
}

function getRemainingOnBank($cycle_id) {
	$remainingOnBank = 0;
	//get from cycle first
	$query = MYSQL_QUERY("	SELECT
					*
				FROM
					cycle
				WHERE
					cycle_id = '$cycle_id' AND
					onHand_onBank = '2'
			");
	if(MYSQL_NUM_ROWS($query) > 0) {
		$remainingOnBank = MYSQL_RESULT($query, 0, 'starting_money');
	}
	
	//get the additional money
	$query = MYSQL_QUERY("	SELECT
					*
				FROM
					money
				WHERE
					cycle_id = '$cycle_id' AND
					onHand_onBank = '2'
			");
	while($row = MYSQL_FETCH_ARRAY($query)) {
		$remainingOnBank += $row['amount'];
	}
	//deducting any withdrawals + service charges
	$query = MYSQL_QUERY("	SELECT
					*
				FROM
					withdraw
				WHERE
					cycle_id = '$cycle_id'
			");
	while($row = MYSQL_FETCH_ARRAY($query)) {
		$remainingOnBank = $remainingOnBank - $row['amount'] - $row['service_charge'];
	}
	
	return $remainingOnBank;
}

function getRemainingOnHand($cycle_id) {
	$current_user = $_SESSION['us3rnAme'];
	$remainingOnHand = 0;
	//get from cycle first
	$query = MYSQL_QUERY("	SELECT
					*
				FROM
					cycle
				WHERE
					cycle_id = '$cycle_id' AND
					onHand_onBank = '1'
			");
	if(MYSQL_NUM_ROWS($query) > 0) {
		$remainingOnHand = MYSQL_RESULT($query, 0, 'starting_money');
	}
		
	//get the additional money
	$query = MYSQL_QUERY("	SELECT
					*
				FROM
					money
				WHERE
					cycle_id = '$cycle_id' AND
					onHand_onBank = '1'
			");
	while($row = MYSQL_FETCH_ARRAY($query)) {
		$remainingOnHand += $row['amount'];
	}
	
	//adding any withdrawals
	$query = MYSQL_QUERY("	SELECT
					*
				FROM
					withdraw
				WHERE
					cycle_id = '$cycle_id'
			");
	while($row = MYSQL_FETCH_ARRAY($query)) {
		$remainingOnHand += $row['amount'];
	}
	
	//get cycle from and to date
	$query = MYSQL_QUERY("	SELECT
					*
				FROM
					cycle
				WHERE
					user = '$current_user' AND
					cycle_id = '$cycle_id'
			");
	$from_month = MYSQL_RESULT($query, 0, 'from_month');
	$from_day = MYSQL_RESULT($query, 0, 'from_day');
	$from_year = MYSQL_RESULT($query, 0, 'from_year');
	$to_month = MYSQL_RESULT($query, 0, 'to_month');
	$to_day = MYSQL_RESULT($query, 0, 'to_day');
	$to_year = MYSQL_RESULT($query, 0, 'to_year');
	
	$totalExpenses = getAllExpenses($from_month, $from_day, $from_year, $to_month, $to_day, $to_year);
	
	$remainingOnHand -= $totalExpenses;

	return $remainingOnHand;
}

function getAllServiceCharge($cycle_id) {
	$query = MYSQL_QUERY("	SELECT
					*
				FROM
					withdraw
				WHERE
					cycle_id = '$cycle_id'
			");
	$serviceCharge = 0;
	while($row = MYSQL_FETCH_ARRAY($query)) {
		$serviceCharge += $row['service_charge'];
	}
	return $serviceCharge;
}
?>