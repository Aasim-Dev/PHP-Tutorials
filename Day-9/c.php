<?php 

echo "SELECT * FROM `employee` <br>
    UPDATE employee SET Name= 'Anirudhh' WHERE Employee_ID=1;<br>
    SELECT * FROM `employee`<br>
    SELECT Name, City, Age, Age + 10 AS justfun FROM employee;<br>
    SELECT Name, City, Age, Age + 10 FROM employee;<br>
    SELECT Name, City FROM employee WHERE LIKE 'M%';<br>
    SELECT Name, City FROM employee WHERE City LIKE 'M%'; <br>
    INSERT INTO client (Name, City, Age) SELECT Name, City, Age FROM employee;<br>
    SELECT * FROM `client`<br>
    DELETE FROM `client` WHERE `client`.`Client_ID` = 124<br>
    DELETE FROM `client` WHERE `client`.`Client_ID` = 125<br>
    DELETE FROM `client` WHERE `client`.`Client_ID` = 126<br>
    DELETE FROM `client` WHERE `client`.`Client_ID` = 127<br>
    DELETE FROM `client` WHERE `client`.`Client_ID` = 128<br>
    DELETE FROM `client` WHERE `client`.`Client_ID` = 129<br>
    DELETE FROM `client` WHERE `client`.`Client_ID` = 130<br>
    SELECT * FROM `client`<br>
    SELECT Name, City FROM employee WHERE City REGEXP '^M';<br>
    SELECT Name, City FROM employee WHERE City REGEXP 'D$';<br>
    SELECT * FROM employee LIMIT 2, 3;<br>
    SELECT * FROM employee JOIN client ON employee.Employee_ID = client.Employee_ID;<br>
    SELECT c.Name, c.Age, e.Name, e.Age FROM employee e JOIN client c ON e.Employee_ID = c.Employee_ID;<br>
    SELECT c.Name, e.Age FROM employee e INNER JOIN client c ON e.Employee_ID = c.Employee_ID;<br>
    SELECT c.Name, e.Age FROM employee e LEFT JOIN client c ON e.Employee_ID = c.Employee_ID;<br>
    SELECT c.Name, e.Age FROM employee e RIGHT JOIN client c ON e.Employee_ID = c.Employee_ID;<br>
    SELECT c.Name, e.Age FROM employee e FULL JOIN client c ON e.Employee_ID = c.Employee_ID;<br>
    SELECT c.Name, e.Age FROM employee e FULL OUTER JOIN client c ON e.Employee_ID = c.Employee_ID;<br>
    SELECT * FROM employee e FULL OUTER JOIN client c ON e.Employee_ID = c.Employee_ID;<br>
    SELECT * FROM employee e FULL OUTER JOIN client c ON e.Employee_ID = c.Employee_ID ORDER BY c.Name;<br>
    SELECT * FROM employee e JOIN client c ON e.Employee_ID = c.Employee_ID ORDER BY c.Name;<br>
    SELECT * FROM employee e JOIN client c ON e.Employee_ID = c.Employee_ID ORDER BY e.Employee_ID;<br>
    SELECT * FROM employee e FULL OUTER JOIN client c ON e.Employee_ID = c.Employee_ID ORDER BY e.Employee_ID;<br>
    SELECT * FROM `client`<br>
    SELECT * FROM `employee`<br>
    SELECT * FROM `client`<br>
    SELECT * FROM `client` ORDER BY `Employee_ID` DESC<br>
    SELECT * FROM `client` ORDER BY `client`.`Client_ID` ASC<br>
    SELECT * FROM client ORDER BY Client_ID DESC;<br>
    SELECT * FROM client ORDER BY Client_ID ASC;<br>
    SELECT e.Name, e.Age, e.City, c.Name from employee e LEFT JOIN client c ON e.Employee_ID = c.Employee_ID;<br>
    SELECT * FROM `client`<br>
    SELECT * FROM `salary`<br>
    SELECT * FROM `salary`<br>
    SELECT * FROM `employee`<br>
    SELECT * FROM `employee`<br>
    INSERT INTO employee (Employee_ID, Name, Age, City) VALUES (1, Aasim, 23, Kadi);<br>
    SELECT * FROM `employee`<br>
    SELECT * FROM `salary`<br>
    Collapse Requery Edit Bookmark Database : localstore Queried time : 11:59:7<br>
    INSERT INTO `salary` (`ID`, `Position`, `Salary`, `Status`, `Employee_ID`, `created_at`) VALUES ('1', 'Senior Software Developer', '40000.00', '1', '1', current_timestamp());<br>
    Collapse Requery Edit Explain Profiling Bookmark Database : localstore Queried time : 11:59:16<br>
    SELECT employee.Name, salary.Salary FROM employee JOIN salary ON employee.Employee_ID = salary.Employee_ID;<br>
    SELECT employee.Name, salary.Salary FROM employee INNER JOIN salary ON employee.Employee_ID = salary.Employee_ID;<br>
    SELECT * FROM `employee`<br>
    SELECT Salary FROM salary WHERE Employee_ID=12;<br>
    SELECT employee.Name, salary.Salary FROM employee JOIN salary ON employee.Employee_ID = salary.Employee_ID WHERE salary.Salary < 40000;<br>
    SELECT employee.Name, salary.Salary FROM employee JOIN salary ON employee.Employee_ID = salary.Employee_ID WHERE Position = 'Senior Software Developer';<br>
    UPDATE employee SET City = 'Delhi' WHERE City= 'Bihar';<br>
    UPDATE salary SET Salary = 50000 WHERE Employee_ID= 10 AND Salary = 40000;<br>
    SELECT Position, Salary  
    FROM salary  
    WHERE Salary = (  
        SELECT MAX(Salary)  
        FROM salary  
        WHERE Salary < (SELECT MAX(Salary) FROM employee)  
    );
    ALTER TABLE employee MODIFY City CHAR(100);
SELECT * FROM `employee`
ALTER TABLE employee MODIFY City CHAR(100) NOT NULL;
SELECT * FROM `employee`
SELECT employee.Name, salary.Salary FROM salary JOIN employee ON salary.Employee_ID = employee.Employee_ID WHERE Position = 'Senior Software Developer';
SELECT * FROM `salary`
SELECT * FROM `employee`
SELECT MAX(Salary) FROM salary WHERE Salary < (SELECT MAX(Salary) FROM salary);
SELECT * FROM salary;
SELECT * FROM `employee`
ALTER TABLE employee ADD CHECK(Age>=18);
SELECT * FROM `salary`
SELECT * FROM `employee`
INSERT INTO employee (Name, Age, City) Values ('Arhan', 17, 'Kolkata');
SELECT * FROM `employee`
INSERT INTO employee (Name, Age, City) Values ('Arhan', 18, 'Kolkata');
SELECT * FROM `employee`
DELETE FROM employee WHERE Employee_ID=16;
SELECT * FROM `employee`
CREATE VIEW KC AS SELECT Name, City FROM employee WHERE City='Kolkata';
SELECT * FROM `kc`
BACKUP DATABASE localstore filepath = 'C:\Users\Aasim\OneDrive\Desktop\8th Sem Internship'
BACKUP DATABASE localstore TO DISK = 'C:\Users\Aasim\OneDrive\Desktop\8th Sem Internship\localstore.bak'
SELECT * FROM `salary`;
SELECT * FROM `salary`;
SELECT * FROM `salary`;
BACKUP DATABASE localstore TO DISK = 'C:\Users\Aasim\OneDrive\Desktop\8th Sem Internship\localstore.bak'
SELECT Name, Age CASE WHEN Age > 30 THEN 'Age is greater than 30' WHEN Age < 30 THEN 'Age is Less Than 30' END AS NA FROM emplyee
Collapse Edit Explain Profiling Query failed
SELECT Name, Age
CASE
    WHEN Age > 30 THEN 'Age is greater than 30'
    WHEN Age < 30 THEN 'Age is Less Than 30'
    ELSE 'The Age is equals to 30'
END AS NA 
FROM employee
SELECT Name, Age, CASE WHEN Age > 30 THEN 'Age is greater than 30' WHEN Age < 30 THEN 'Age is Less Than 30' ELSE 'The Age is equals to 30' END AS na FROM employee;
SELECT * FROM `salary`
ALTER TABLE salary MODIFY Position VARCHAR(255) NULL;
ALTER TABLE salary MODIFY Salary DECIMAL(10,2) NULL;
ALTER TABLE salary MODIFY Status BOOLEAN(0) NULL;
ALTER TABLE salary MODIFY Status TINYINT(0) NULL;
ALTER TABLE salary MODIFY created_at TIMESTAMP NULL;
SELECT * FROM `employee`
SELECT * FROM `employee`
SELECT * FROM salary;
SELECT DISTINCT City FROM employee WHERE COUNT(City);
SELECT DISTINCT City FROM employee GROUP BY City;
SELECT DISTINCT City FROM employee GROUP BY Name;
SELECT DISTINCT City FROM employee GROUP BY Employee_ID;
Expand Requery Edit Explain Profiling Bookmark Database : localstore Queried time : 16:5:24
SELECT COUNT(DISTINCT City) FROM employee;<br>";

?>