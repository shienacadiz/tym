DELIMITER $$
CREATE FUNCTION get_overall_budget 
(id int)
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