<?php
function print_table($result)
{
    echo '<table>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        foreach ($row as $data) {
            echo "<td>" . $data . "</td>";
        }
        echo '</tr>';
    }
    echo '</table>';
}
?>
<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css">
    <title>Query Runner</title>
</head>

<body>


    <div class="display">
        <div class="queries">
            <?php
            include("dbconnection.php");
            $db = new Database();
            $emp = $db->connect("assignment2");
            ?>


            <h4>Q1. WAQ to list all employee first name with salary greater than 50k.</h4>
            <?php
            $result = $emp->query("SELECT d.employee_first_name,s.employee_salary 
        FROM employee_details_table as d JOIN employee_salary_table as s
        ON d.employee_id=s.employee_id
        WHERE s.employee_salary>50");
            print_table($result);
            ?>

            <h4>Q2 WAQ to list all employee last name with graduation percentile greater than 70%.</h4>
            <?php
            $result = $emp->query('SELECT d.employee_last_name,d.Graduation_percentile
        FROM employee_details_table as d 
        WHERE d.Graduation_percentile>"70%"');
            print_table($result);
            ?>

            <h4>Q3 WAQ to list all employee code name with graduation percentile less than 70%.</h4>
            <?php
            $result = $emp->query('SELECT c.employee_code, d.Graduation_percentile FROM employee_details_table d 
        JOIN employee_salary_table s
        ON d.employee_id=s.employee_id
        JOIN employee_code_table c
        ON s.employee_code=c.employee_code
        WHERE d.Graduation_percentile<"70%"');
            print_table($result);
            ?>

            <h4>Q4 WAQ to list all employee’s full name that are not of domain Java.</h4>
            <?php
            $result = $emp->query('SELECT CONCAT(d.employee_first_name," ",d.employee_last_name) as "full_name" FROM employee_details_table d 
        JOIN employee_salary_table s
        ON d.employee_id=s.employee_id
        JOIN employee_code_table c
        ON s.employee_code=c.employee_code
        WHERE NOT c.employee_domain = "Java"');
            print_table($result);
            ?>

            <h4>Q5 WAQ to list all employee_domain with sum of it's salary.</h4>
            <?php
            $result = $emp->query('SELECT c.employee_domain as "Domain",CONCAT(SUM(s.employee_salary),"k") as "Salary" FROM employee_code_table c
        JOIN employee_salary_table s
        ON c.employee_code=s.employee_code
        GROUP BY c.employee_domain');
            print_table($result);
            ?>

            <h4>Q6 WAQ to list all employee_domain with sum of it's salary but dont include salaries which is less than
                30k.</h4>
            <?php
            $result = $emp->query('SELECT c.employee_domain as "Domain",CONCAT(SUM(s.employee_salary),"k") as "Salary" FROM employee_code_table c
        JOIN employee_salary_table s
        ON c.employee_code=s.employee_code
        WHERE NOT s.employee_salary<"30k"
        GROUP BY c.employee_domain');
            print_table($result);
            ?>

            <h4>Q7 WAQ to list all employee id which has not been assigned employee code.</h4>
            <?php
            $result = $emp->query('SELECT * FROM employee_salary_table s
        WHERE  s.employee_code=NULL');
            print_table($result);
            ?>

        </div>
    </div>
</body>



</html>