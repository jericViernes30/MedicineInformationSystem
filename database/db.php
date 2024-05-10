<?php

$server = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'medicine_information_system';

$con = mysqli_connect($server, $user, $pass, $dbname); 

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}