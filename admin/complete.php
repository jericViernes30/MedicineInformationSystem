<?php
include('../database/db.php');
if(isset($_POST['completed'])){
    $quantity = $_POST['quantity'];
    $ticket = $_POST['ticket'];
    $medicine = $_POST['medicine'];
    $update = "UPDATE reserve SET status = 'Completed' WHERE ticket = ?";
    $updateStmt = mysqli_prepare($con, $update);
    mysqli_stmt_bind_param($updateStmt, "s", $ticket);
    mysqli_stmt_execute($updateStmt);

    $select = "SELECT * FROM medicines WHERE generic_name = ?";
    $selectStmt = mysqli_prepare($con, $select);
    mysqli_stmt_bind_param($selectStmt, "s", $medicine);
    mysqli_stmt_execute($selectStmt);
    $res = mysqli_stmt_get_result($selectStmt);
    $row = mysqli_fetch_assoc($res);
    $stocks = $row['stocks'];
    $new_stocks = $stocks - $quantity;
    echo $new_stocks;

    $update1 = "UPDATE medicines SET stocks = $new_stocks WHERE generic_name = ?";
    $updateStmt1 = mysqli_prepare($con, $update1);
    mysqli_stmt_bind_param($updateStmt1, "s", $medicine);
    mysqli_stmt_execute($updateStmt1);
}