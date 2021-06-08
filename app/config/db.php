<?php
/**
 * Created by PhpStorm.
 * User: Ivor Szaniszló
 * Date: 09/04/2018
 * Time: 1:01 PM
 */

//This line of code connects to mysql database
define("HOST_NAME", "localhost");
define("HOST_USER", "root");
define("HOST_PASS", "");
define("HOST_DB", "peopleawards2019");

$db = new mysqli(HOST_NAME, HOST_USER, HOST_PASS, HOST_DB);
mysqli_set_charset( $db, 'utf8');



// // This line of code checks if connection error exists.
//
//if($db->connect_error) {
//    echo $db->connect_errno . " " . $db->connect_error;
//} else {
//    echo "Connection successful.";
//}
//