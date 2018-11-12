<?php

$server = "localhost";
$user_name = "0326710";
$pass_word = "tanu181294";
$dbname = "payrollSys_CA";
$tblname = "admin";
$tblname2 = "employee";

// Createm a connection
$conn = new mysqli($server, $user_name, $pass_word, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

?>