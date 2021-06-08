<?php
//Create authentication

//Start session
session_start();

if(!isset($_SESSION['EMPLOYEE_ID']) || count($_SESSION['EMPLOYEE_ID']) == 0) {

    header("location: http://localhost/peopleawards_voting2019/app/sandbox/index.php");
    exit();
}