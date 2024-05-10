<?php
$date_today = date('m-d-Y');
include('../database/db.php');
if(isset($_POST['cancel'])){
    // $ticket = $_POST['ticket'];
    
    // $update = "UPDATE reserve SET status = 'Cancelled' WHERE ticket = ?";
    // $updateStmt = mysqli_prepare($con, $update);
    // mysqli_stmt_bind_param($updateStmt, 's', $ticket);
    // mysqli_stmt_execute($updateStmt);
    // header("Location: all_reservations.php");
}

if(isset($_POST['claim'])){
    $new_stock = 0;
    $ticket = $_POST['ticket'];
    $quantity = $_POST['quantity'];
    $medicine = $_POST['medicine'];

    $select = "SELECT * FROM medicines WHERE generic_name = ?";
    $selectStmt = mysqli_prepare($con, $select);
    mysqli_stmt_bind_param($selectStmt, 's', $medicine);
    mysqli_stmt_execute($selectStmt);
    $res = mysqli_stmt_get_result($selectStmt);
    if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
            $stocks = $row['stocks'];
            $new_stock = $stocks - $quantity;
            // echo $new_stock;
        }
    } else {
        echo "No rows found";
    }
    
    $update = "UPDATE reserve SET status = 'Claimed', date_picked_up = ? WHERE ticket = ?";
    $updateStmt = mysqli_prepare($con, $update);
    mysqli_stmt_bind_param($updateStmt, 'ss', $date_today, $ticket);
    mysqli_stmt_execute($updateStmt);

    $updateStocks = "UPDATE medicines SET stocks = ? WHERE generic_name = ?";
    $stocksStmt = mysqli_prepare($con, $updateStocks);
    mysqli_stmt_bind_param($stocksStmt, 'ss', $new_stock, $medicine);
    mysqli_stmt_execute($stocksStmt);
    header("Location: all_reservations.php");
}