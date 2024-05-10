<?php
session_start();
include('session.php');
$server = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'medicine_information_system';

$conn = mysqli_connect($server, $user, $pass, $dbname); 

if(isset($_POST['confirm'])){
    $name = $first_name. ' ' .$last_name;
    $medicine = $_POST['medicine'];
    $quantity = $_POST['quantity'];
    $note = $_POST['note'];
    $currentDateTime = new DateTime();
    $formattedDateTime = $currentDateTime->format('m-d-Y');
    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    $ticket = generateRandomString();
    $status = "Unclaimed";

    $insert = "INSERT INTO reserve (ticket, name, medicine, quantity, date_reserved, note, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = mysqli_prepare($conn, $insert);
    mysqli_stmt_bind_param($insertStmt, "sssssss", $ticket, $name, $medicine, $quantity, $formattedDateTime, $note, $status);
    if(mysqli_stmt_execute($insertStmt)){
        header("Location: qrcode.php?ticket=".$ticket);
    }

    $select = "SELECT * FROM medicines WHERE generic_name = ?";
    $selectStmt = mysqli_prepare($conn, $select);
    mysqli_stmt_bind_param($selectStmt, "s", $medicine);
    mysqli_stmt_execute($selectStmt);
    $result = mysqli_stmt_get_result($selectStmt);
    $row = mysqli_fetch_assoc($result);
    $stocks = $row['stocks'];
    $new_stocks = $stocks-$quantity;
}