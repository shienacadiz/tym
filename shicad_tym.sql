DELIMITER $$
CREATE FUNCTION get_overall_budget (id int)
RETURNS DECIMAL(10,2)
BEGIN
	-- gets the total money based on the cycle_id as the parameter
	DECLARE _starting_money DECIMAL(10,2);
	DECLARE _topup_money DECIMAL(10,2);
	DECLARE _total_money DECIMAL(10,2);
	SET _starting_money = (SELECT starting_money FROM cycle WHERE cycle_id = id);
	SET _topup_money = (SELECT SUM(amount) FROM money WHERE cycle_id = id);
	SET _total_money = _starting_money + _topup_money;
	RETURN _total_money;
END $$
DELIMITER ;
---------------------------------------------------------------------------------------
DELIMITER $$
CREATE FUNCTION get_expenses_by_cycle 
(
username varchar(20),
from_month int,
from_day int,
from_year int,
to_month int,
to_day int,
to_year int
)
RETURNS decimal(10,2)
BEGIN
	-- This function has 6 params, first 3 are required and the rest were optional.
	-- But since technically, optional params are not allowed in SQL, pass 0 instead on 'optional' params.
	DECLARE _from_date varchar(20);
	DECLARE _total_expenses DECIMAL(10,2);
	SET _from_date = CONCAT(from_month,"-",from_day,"-",from_year);
	IF(to_month = 0 OR to_day = 0 OR to_year = 0) 
		THEN SET _total_expenses = (SELECT sum(amount) FROM expenses WHERE
					user = username AND
					STR_TO_DATE(_from_date,'%m-%d-%Y') <= STR_TO_DATE(CONCAT(month,'-',day,'-',year),'%m-%d-%Y'));
	ELSE BEGIN
		DECLARE _to_date varchar(20);
		SET _to_date = CONCAT(to_month,"-",to_day,"-",to_year);
		SET _total_expenses = (SELECT sum(amount) FROM expenses WHERE
					user = username AND
					STR_TO_DATE(_from_date,'%m-%d-%Y') <= STR_TO_DATE(CONCAT(month,'-',day,'-',year),'%m-%d-%Y') AND
					STR_TO_DATE(_to_date,'%m-%d-%Y') >= STR_TO_DATE(CONCAT(month,'-',day,'-',year),'%m-%d-%Y'));
	END;
	END IF;
RETURN _total_expenses;
END $$
DELIMITER ;
---------------------------------------------------
DELIMITER $$
CREATE FUNCTION get_service_charge_by_cycle (id INT)
RETURNS DECIMAL(10,2)
BEGIN
	DECLARE _service_charge DECIMAL(10,2);
	SET _service_charge = (SELECT SUM(service_charge) FROM withdraw WHERE cycle_id = id);
RETURN IFNULL(_service_charge, 0);
END $$
DELIMITER ;
------------------------------------------------------
DELIMITER $$
CREATE FUNCTION get_total_remaining_money (username varchar(20), id INT)
RETURNS DECIMAL(10,2)
BEGIN
	-- get the remaining money available for this cycle (cycle id as the parameter)
	-- regardless if the money is on hand or on bank
	DECLARE _from_month INT(2);
	DECLARE _from_day INT(2);
	DECLARE _from_year INT(4);
	DECLARE _to_month INT(2);
	DECLARE _to_day INT(2);
	DECLARE _to_year INT(4);
	DECLARE _total_budget DECIMAL(10,2);
	DECLARE _total_expenses DECIMAL(10,2);
	DECLARE _service_charge DECIMAL(10,2);
	DECLARE _total_remaining DECIMAL(10,2);
	SET _total_budget  = (SELECT get_overall_budget(id));
	SELECT from_month, from_day, from_year, to_month, to_day, to_year
		INTO _from_month, _from_day, _from_year, _to_month, _to_day, _to_year
		FROM cycle WHERE user = username AND cycle_id = id;
	SET _total_expenses = (SELECT get_expenses_by_cycle(username, _from_month, _from_day, _from_year, _to_month, _to_day, _to_year));
	SET _service_charge = (SELECT get_service_charge_by_cycle(id));
	SET _total_remaining = _total_budget - _total_expenses - _service_charge;
	RETURN _total_remaining;
END $$
DELIMITER ;
-----------------------------------------------------------------
DELIMITER $$
CREATE FUNCTION get_remaining_on_bank (id INT)
RETURNS DECIMAL(10,2)
BEGIN
	-- this will get the remaining money on bank (ie. onHand_onBank flag = 2)
	DECLARE _remaining_on_bank DECIMAL(10,2);
	DECLARE _starting_money DECIMAL(10,2);
	DECLARE _additional_money DECIMAL(10,2);
	DECLARE _withdrawals_service_charge DECIMAL(10,2);
	-- get the initial money on start cycle first
	SET _starting_money = IFNULL((SELECT starting_money FROM cycle WHERE cycle_id=id AND onHand_onBank=2),0);
	-- get the addition money
	SET _additional_money = IFNULL((SELECT SUM(amount) FROM money WHERE cycle_id=id AND onHand_onBank=2),0);
	-- deducting any withdrawals and service charges
	SET _withdrawals_service_charge = IFNULL((SELECT SUM(amount + service_charge) FROM withdraw WHERE cycle_id=id),0);
	SET _remaining_on_bank = IFNULL(((_starting_money + _additional_money) - _withdrawals_service_charge),0);
	RETURN _remaining_on_bank;
END $$
DELIMITER ;
-----------------------------------------------------------------
DELIMITER $$
CREATE FUNCTION get_remaining_on_hand (username varchar(20), id INT)
RETURNS DECIMAL(10,2)
BEGIN
	-- this will get the remaining money on hand (ie. onHand_onBank flag = 1)
	DECLARE _remaining_on_hand DECIMAL(10,2);
	DECLARE _starting_money DECIMAL(10,2);
	DECLARE _additional_money DECIMAL(10,2);
	DECLARE _withdrawals DECIMAL(10,2);
	DECLARE _all_expenses DECIMAL(10,2);
	DECLARE _from_month INT(2);
	DECLARE _from_day INT(2);
	DECLARE _from_year INT(4);
	DECLARE _to_month INT(2);
	DECLARE _to_day INT(2);
	DECLARE _to_year INT(4);
	-- get the initial money on start cycle first
	SET _starting_money = IFNULL((SELECT starting_money FROM cycle WHERE cycle_id=id AND onHand_onBank=1),0);
	-- get the top up (additional) money
	SET _additional_money = IFNULL((SELECT SUM(amount) FROM money WHERE cycle_id=id AND onHand_onBank=1),0);
	-- adding any withdrawals
	SET _withdrawals = IFNULL((SELECT SUM(amount) FROM withdraw WHERE cycle_id=id),0);
	-- getting the cycle date
	SELECT from_month, from_day, from_year, to_month, to_day, to_year
		INTO _from_month, _from_day, _from_year, _to_month, _to_day, _to_year
		FROM cycle WHERE cycle_id = id;
	-- getting all the expenses for this cycle
	SET _all_expenses = IFNULL((SELECT get_expenses_by_cycle(username, _from_month, _from_day, _from_year, _to_month, _to_day, _to_year)),0);
	SET _remaining_on_hand = _starting_money + _additional_money + _withdrawals - _all_expenses;
	RETURN _remaining_on_hand;
END $$
DELIMITER ;
