<?php

$server = "localhost";
$user = "root";
$password = "";
$dbName = "OTCMedicineIS";

$con = mysqli_connect($server, $user, $password, $dbName);

if(!$con){
    echo 'Not connected to Database';
}
?>