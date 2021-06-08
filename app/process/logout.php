<?php
//Start session
session_start();

session_destroy();
header("location: http://localhost/peopleawards_voting2019/app/sandbox/index.php");
exit();