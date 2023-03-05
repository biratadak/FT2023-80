<?php
include("dbconnection.php");
$db= new Database();
$emp=$db->connect("assignment2");

// for employee code table (code,code_name,domain)
$emp->query();

// for employee detail table (id,fname,lname,grad_percent)
$emp->query();

// for employee salary table (id,salary,code)
$emp->query();

?>