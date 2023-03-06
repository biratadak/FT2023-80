CREATE DATABASE assignment2;
use assignment2;
CREATE TABLE employee_code_table(employee_code varchar(20), employee_code_name varchar(20), employee_domain varchar(20));
INSERT INTO employee_code_table (employee_code, employee_code_name, employee_domain)
VALUES
("su_john","ru_john","JAVA"),
("su_daenerys","du_daenerys","PHP"),
("su_cersel","ru_cersel","Java"),
("su_tyrion","tu_tyrion","Angular JS");

CREATE TABLE employee_salary_table(employee_id varchar(20) PRIMARY KEY, employee_salary varchar(10), employee_code varchar(20));
INSERT INTO employee_salary_table (employee_id, employee_salary, employee_code)
VALUES
("RU122","60k","su_john"),
("RU123","25k","su_daenerys"),
("RU124","44k","su_cersel"),
("RU125","85k","su_tyrion");

CREATE TABLE employee_details_table(employee_id varchar(20) PRIMARY KEY, employee_first_name varchar(20), employee_last_name varchar(20),Graduation_percentile VARCHAR(4));
INSERT INTO employee_details_table (employee_id, employee_first_name, employee_last_name,Graduation_percentile)
VALUES
("RU122","John","Snow","60%"),
("RU123","Daeneys","Targaryen","88%"),
("RU124","Cersei","su_cersel","72%"),
("RU125","Tyrion","su_tyrion","64%");



-- ALTER TABLE employee_salary_table
-- MODIFY COLUMN employee_salary VARCHAR(10) CHECK (employee_salary<"100k");
-- ALTER TABLE employee_salary_table
-- DROP CHECK employee_salary_table_chk_6;

-- /Q1 WAQ to list all employee first name with salary greater than 50k.
SELECT d.employee_first_name,s.employee_salary 
FROM employee_details_table as d JOIN employee_salary_table as s
ON d.employee_id=s.employee_id
WHERE s.employee_salary>50;

-- /Q2 WAQ to list all employee last name with graduation percentile greater than 70%.
SELECT d.employee_last_name,d.Graduation_percentile
FROM employee_details_table as d 
WHERE d.Graduation_percentile>"70%";

-- /Q3 WAQ to list all employee code name with graduation percentile less than 70%.
SELECT c.employee_code, d.Graduation_percentile FROM employee_details_table d 
JOIN employee_salary_table s
ON d.employee_id=s.employee_id
JOIN employee_code_table c
ON s.employee_code=c.employee_code
WHERE d.Graduation_percentile<"70%";

-- /Q4 WAQ to list all employee’s full name that are not of domain Java.
SELECT CONCAT(d.employee_first_name," ",d.employee_last_name) as "full_name" FROM employee_details_table d 
JOIN employee_salary_table s
ON d.employee_id=s.employee_id
JOIN employee_code_table c
ON s.employee_code=c.employee_code
WHERE NOT c.employee_domain = "Java";

-- /Q5  WAQ to list all employee_domain with sum of it's salary.
SELECT c.employee_domain as "Domain",CONCAT(SUM(s.employee_salary),"k") as "Salary" FROM employee_code_table c
JOIN employee_salary_table s
ON c.employee_code=s.employee_code
GROUP BY c.employee_domain;

-- /Q6  WAQ to list all employee_domain with sum of it's salary but dont include salaries which is less than 30k.
SELECT c.employee_domain as "Domain",CONCAT(SUM(s.employee_salary),"k") as "Salary" FROM employee_code_table c
JOIN employee_salary_table s
ON c.employee_code=s.employee_code
WHERE NOT s.employee_salary<"30k"
GROUP BY c.employee_domain;

-- /Q7  WAQ to list all employee id which has not been assigned employee code.
SELECT * FROM employee_salary_table s
WHERE  s.employee_code=NULL;



--FOR MANUAL DELETION
-- SELECT * from employee_code_table;
-- SELECT * from employee_salary_table;
-- SELECT * from employee_details_table;
--  DELETE FROM employee_code_table WHERE employee_code="cgfgfg";
--  DELETE FROM employee_salary_table WHERE employee_id>"RU125";
--  DELETE FROM employee_details_table WHERE employee_id>"RU125";


