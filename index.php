<?php
// Loaded all required libraries.
require("../vendor/autoload.php");
//Loading .env credentials.
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();



include("dbconnection.php");
$db = new Database();
$emp = $db->connect("assignment2");

$res = $emp->query("select employee_id from employee_salary_table order by employee_id DESC LIMIT 1");
$val = $res->fetch_assoc()['employee_id'];

// Data insertion for emp_code_table
if( isset($_POST['emp_code']) && isset($_POST['emp_cname']) && isset($_POST['emp_dom']) && $_POST['emp_code']!="" && $_POST['emp_cname']!="" && $_POST['emp_dom']!="" ){
    echo "inside code table if ";
    $sql='INSERT INTO employee_code_table (employee_code,employee_code_name,employee_domain) values ("'.$_POST["emp_code"].'","'.$_POST["emp_cname"].'","'.$_POST['emp_dom'].'")';
    $emp->query($sql);
}

// Data insertion for emp_salary_table
if( isset($_POST['emp_salary']) && isset($_POST['emp_code']) && $_POST['emp_salary']!="" && $_POST['emp_code']!="" ){
    echo "inside salary table if";

    $sql='INSERT INTO employee_salary_table (employee_id,employee_salary,employee_code) values ("'.(substr($val, 0, 2) . ((int) substr($val, 2) + 1)).'","'.$_POST["emp_salary"].'","'.$_POST['emp_code'].'")';
    $emp->query($sql);
}

// Data insertion for emp_details_table
if(isset($_POST['emp_fname']) && isset($_POST['emp_lname']) && isset($_POST['emp_gp']) && $_POST['emp_fname']!="" && $_POST['emp_lname']!="" && $_POST['emp_gp']!=""){
    echo "inside details table if";

    $sql='INSERT INTO employee_details_table (employee_id,employee_first_name,employee_last_name,Graduation_percentile) values ("'.substr($val, 0, 2) .((int) substr($val, 2) + 1).'","'.$_POST["emp_fname"].'","'.$_POST['emp_lname'].'","'.$_POST['emp_gp'].'")';
    $emp->query($sql);
}




?>
<html>

<head>
    <meta charset="UTF-8" />
    <title>SQL TASK</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action='<?php $_SERVER["PHP_SELF"] ?>' method="POST">
        <h3>Employee Details</h3>

        <label for="emp_id">ID:</label>
        <input type="text"  value='<?php echo substr($val, 0, 2) . ((int) substr($val, 2) + 1) ?>' name="emp_id" readonly>

        <label for="emp_fname">First Name:</label>
        <input type="text" placeholder="Tony" name="emp_fname">

        <label for="emp_lname">Last Name:</label>
        <input type="text" placeholder="Stark" name="emp_lname">

        <label for="emp_code_name">Code Name:</label>
        <input type="text" placeholder="ru_tony" name="emp_cname">

        <label for="emp_code">Code:</label>
        <input type="text" placeholder="su_tony" name="emp_code">

        <label for="emp_domain">Domain:</label>
        <input type="text" placeholder="PHP" name="emp_dom">

        <label for="emp_salary">Salary:</label>
        <input type="text" placeholder="100k" name="emp_salary">

        <label for="emp_percentile">Graduation Percentile:</label>
        <input type="text" placeholder="100k" name="emp_gp">
        <div>
            <input type="submit" value="SUBMIT" name="sub_btn">
            <input type="submit" value="Show Table" name="show_btn">
        </div>


    </form>
    <!-- tables section starts-->
    <div class="tables">
    <?php if (isset($_POST['show_btn'])) {
        echo '<h4>Employee Code Table</h5>';}?>
        <div class="Scrollable">
            
            <div class="grid code">
                
                
                <?php if (isset($_POST['show_btn'])) {
                $table = $emp->query("select * from employee_code_table");
                echo '<div class="grid_heads">CODE</div>
            <div class="grid_heads">CODE NAME</div>
            <div class="grid_Heads">DOMAIN</div>
            
            ';
                while ($res = $table->fetch_assoc()) {
                    foreach ($res as $r)
                        echo '<div class="grid_elements">' . $r . '</div>';
                }
            }
            ?>
        </div>
        </div>
        <?php if (isset($_POST['show_btn'])) {
        echo '<h4>Employee Salary Table</h5>';}?>
        <div class="Scrollable">
        <div class="grid salary">

            <?php if (isset($_POST['show_btn'])) {
                $table = $emp->query("select * from employee_salary_table");
                echo '<div class="grid_heads">ID</div>
            <div class="grid_heads">SALARY</div>
            <div class="grid_Heads">CODE</div>
            
            ';
                while ($res = $table->fetch_assoc()) {
                    foreach ($res as $r)
                        echo '<div class="grid_elements">' . $r . '</div>';
                }
            }
            ?>
        </div>
        </div>
        <?php if (isset($_POST['show_btn'])) {
        echo '<h4>Employee Detail Table</h5>';}?>
        <div class="Scrollable">
        <div class="grid detail">

                <?php if (isset($_POST['show_btn'])) {
                    $table = $emp->query("select * from employee_details_table");
                    echo '<div class="grid_heads">ID</div>
            <div class="grid_heads">FIRST NAME</div>
            <div class="grid_Heads">LAST NAME</div>
            <div class="grid_Heads">GRAD.(%)</div>
            
            ';
                    while ($res = $table->fetch_assoc()) {
                        foreach ($res as $r)
                            echo '<div class="grid_elements">' . $r . '</div>';
                    }
                }
                ?>
            </div>
        </div>

    </div>
    <!-- tables section ends-->

</body>


</html>