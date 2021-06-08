<?php
//Include database connection
require("../config/db.php");

//Include class EmployeeLogin
require("../classes/EmployeeLogin.php");

//Include ADCheck
require("ADCheck.php");

if(isset($_POST['submit'])) {
    $employee_id = trim($_POST['employee_id']);
    $password = trim($_POST['password']);

    $loginEmp = new EmployeeLogin($employee_id, $password);
    $rtnLogin = $loginEmp->EmpLogin();
}

$db->close();