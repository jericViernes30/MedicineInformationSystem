<?php

$server = "localhost";
$user = "root";
$password = "";
$dbName = "otcmedicineis";

$con = mysqli_connect($server, $user, $password, $dbName);

if(!$con){
    echo 'Not connected to Database';
}
?>