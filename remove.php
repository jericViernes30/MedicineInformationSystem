<?php
include ('database/db.php');
$ticket = $_GET['ticket'];
$quantity = $_GET['quantity'];
$medicine = $_GET['medicine'];
// echo $medicine;
// echo $quantity;
// echo $ticket;

$select = "SELECT stocks FROM medicines WHERE generic_name = ?";
$stmt2 = mysqli_prepare($con, $select);
mysqli_stmt_bind_param($stmt2, "s", $medicine);
mysqli_stmt_execute($stmt2);
$res = mysqli_stmt_get_result($stmt2);
$row = mysqli_fetch_assoc($res);

$stocks = $row['stocks'];
$new_stocks = $quantity + $stocks;

$update = "UPDATE medicines SET stocks = ? WHERE generic_name = ?";
$stmt1 = mysqli_prepare($con, $update);
mysqli_stmt_bind_param($stmt1, "ss", $new_stocks, $medicine);
mysqli_stmt_execute($stmt1);

$delete = "DELETE FROM reserve WHERE ticket = ?";
$stmt = mysqli_prepare($con, $delete);
mysqli_stmt_bind_param($stmt, 's', $ticket);

if(mysqli_stmt_execute($stmt)){
    header("Location: find-drugs.php");
} else {
    echo "NOT DELETED";
}