<?php
include('../database/db.php');
    $data = array();
    $ticket = $_GET['ticket'];

    $sql = "SELECT * from reserve WHERE ticket = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $ticket);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

   // Fetch rows and push them into the $data array
    while ($row = mysqli_fetch_assoc($res)) {
        $dataRow = array(
            'ticket' => $row['ticket'],
            'name' => $row['name'],
            'medicine' => $row['medicine'],
            'quantity' => $row['quantity'],
            'date_reserved' => $row['date_reserved']
        );

        // Push the associative array into the $data array
        $data[] = $dataRow;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <title>Reservations</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50">
    <!-- <button onclick="toggleScanner('scanner')">Open Scanner</button> -->
    <div class="w-full flex flex-col bg-slate-50 border-b-4 border-b-green-500 mb-5">
        <div class="container flex justify-end px-10 py-1 gap-x-24 text-sm">
            <button class="flex gap-1 items-center"><i class="fa-solid fa-user text-green-500"></i>Admin: <span class="uppercase font-bold"><?php echo 'Viernes' ?></span></button>
            <form class="flex gap-1 items-center" action="logout.php" method="POST"><i class="fa-solid fa-arrow-right-from-bracket text-green-500"></i><input type="submit" name="logout" value="Logout" class="hover:cursor-pointer"></form>
        </div>
        <div class="w-full flex items-center justify-center p-2">
            <img src="../img/logo.png" alt="" class="max-w-[2%]">
            <p class="font-semibold">MontiCasa Drugstore</p>
        </div>
    </div>
    <div class="bg-[#f4f4f4] w-1/4 absolute top-1/2 left-1/2 transfirm -translate-x-1/2 -translate-y-1/2 rounded-lg shadow-md border border-[#bebebe] p-4">
        <p class="text-center font-semibold text-lg mb-5">Details</p>
        <?php 
            foreach ($data as $d) {
        ?>
        <form action="" method="POST" class="text-sm">
            <div class="w-full flex items-center mb-3">
                <p class="w-3/5">Ticket #</p>
                <p class="text-left font-medium w-2/5"><?php echo $d['ticket']; ?></p>
            </div>
            <div class="w-full flex items-center mb-3">
                <p class="w-3/5">Name</p>
                <p class="text-left font-medium w-2/5"><?php echo $d['name']; ?></p>
            </div>
            <div class="w-full flex items-center mb-3">
                <p class="w-3/5">Medicine</p>
                <p class="text-left font-medium w-2/5"><?php echo $d['medicine']; ?></p>
            </div>
            <div class="w-full flex items-center mb-3">
                <p class="w-3/5">Quantity Reserved</p>
                <p class="text-left font-medium w-2/5"><?php echo $d['quantity']; ?></p>
            </div>
            <div class="w-full flex items-center mb-3">
                <p class="w-3/5">Date of Reservation</p>
                <p class="text-left font-medium w-2/5"><?php echo $d['date_reserved']; ?></p>
            </div>
            <div class="w-full flex gap-2">
                <button class="w-1/2 bg-red-500 rounded-md text-white py-1 hover:bg-red-600 transition duration-100 ease-in-out">Decline</button>
                <button name="completed" class="w-1/2 bg-emerald-500 rounded-md py-1 text-white hover:bg-emerald-600 transition duration-100 ease-in-out">Completed</button>
            </div>
            <input type="hidden" name="ticket" value="<?php echo $d['ticket']; ?>">
        </form>
        <?php
            }
        ?>
    </div>
</body>
</html>