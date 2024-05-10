<?php
    include('../database/db.php');

    $sql = "SELECT * FROM reserve WHERE status = 'Unclaimed'";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    $date_today = date('m-d-Y');
    
    $today = date_create_from_format('m-d-Y', $date_today);
    $today->modify('-3 days');
    // Format the modified date
    $reserved_date = $today->format('m-d-Y');
    $removeQuery = "UPDATE reserve SET status = 'Expired' WHERE status = 'Unclaimed' AND date_reserved = ?";
    $removeStmt = mysqli_prepare($con, $removeQuery);
    mysqli_stmt_bind_param($removeStmt, 's', $reserved_date);
    mysqli_stmt_execute($removeStmt);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <title>Admin Panel | MontiCasa Drugstore</title>
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
    <div class="w-11/12 mx-auto">
        <a href="admin.php" class="flex items-center gap-2 mb-2"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg><p>Back</p></a>
    </div>
    <div class="w-11/12 mx-auto text-sm">
        <p class="font-medium text-lg text-center mb-5">Reservation Lists</p>
        
        <p class="font-medium mb-2">Filter:</p>
        <div class="w-full flex items-center gap-5 mb-5">
            <input type="text" name="search" placeholder="Search here ticker #, name or medicine name" class="w-1/4 p-2 rounded-md outline-none border border-[#bebebe] focus:border-emerald-500 transition duration-100 ease-in-out">
            <div>
                <select name="status" id="status" class="px-4 py-1 border border-[#bebebe] rounded-md outline-none focus:border-emerald-500 transition duration-100 ease-in-out">
                    <option value="" disabled selected class="text-black">Select Status</option>
                    <option value="Unclaimed">Unclaimed</option>
                    <option value="Claimed">Completed</option>
                    <option value="Expired">Expired</option>
                </select>
            </div>
        </div>
        <div class="w-full flex py-2 bg-[#bebebe] px-2">
            <p class="w-[7.5%] font-medium">Ticket #</p>
            <p class="w-[14%] font-medium">Name</p>
            <p class="w-[14%] font-medium">Medicine</p>
            <p class="w-[5%] font-medium">Qty</p>
            <p class="w-[8%] font-medium">Date Requested</p>
            <p class="w-[8%] font-medium">Reserved Until</p>
            <p class="w-[10%] font-medium">Date Picked Up</p>
            <p class="w-[18.5%] font-medium">Note</p>
            <p class="w-[10%] font-medium">Status</p>
            <div class="w-[5%]"></div>
        </div>
        <?php
            if(mysqli_num_rows($res) > 0) {
                // Fetch the rows and send them as response
                while($row = mysqli_fetch_assoc($res)) {
                    ?>
        <script>
             document.addEventListener('DOMContentLoaded', function () {
            var button = document.getElementById('complete');
            var text = document.getElementById('status');
            let status = text.textContent.trim(); // Trim the text to remove leading/trailing whitespaces

            console.log("Status:", status); // Log the status to the console for debugging

            if (status === "Completed") {
                button.disabled = true;
                console.log("Button disabled"); // Log if the button is disabled
            }
        });
        </script>
        <div id="table" class="w-full h-[350px] overflow-auto">
            <div class="w-full flex py-2 border-b border-[#bebebe] px-2 hover:bg-[#ededed]"><p class="w-[7.5%]"><?php echo $row['ticket'] ?></p>
                <p class="w-[14%]"><?php echo $row['name'] ?></p>
                <p class="w-[14%]"><?php echo $row['medicine'] ?></p>
                <p class="w-[5%]"><?php echo $row['quantity'] ?></p>
                <p class="w-[8%]"><?php echo $row['date_reserved'] ?></p>
                <p class="w-[8%]">
                    <?php
                        $date_reserved = $row['date_reserved'];

                        // Parse the date string
                        $date = date_create_from_format('m-d-Y', $date_reserved);

                        if ($date === false) {
                            // Handle parsing failure
                            echo "Failed to parse the date string.<br>";
                            $errors = date_get_last_errors();
                            foreach ($errors['errors'] as $error) {
                                echo "Error: $error<br>";
                            }
                        } else {
                            // Add 3 days to the date
                            $date->modify('+3 days');

                            // Format the modified date
                            $reserved_until = $date->format('m-d-Y');
                            
                            echo $reserved_until;
                        }
                    ?>
                </p>
                <p class="w-[10%]">
                    <?php
                        $picked_up = $row['date_picked_up'];
                        if($picked_up == NULL){
                            echo "Not yet";
                        } else{
                            echo $row['date_picked_up'];
                        }
                    ?>
                </p>
                <p class="w-[18.5%]"><?php echo $row['note'] ?></p>
                <p id="status" class="w-[10%]">
                    <?php
                        $status = $row['status'];
                        if($status == 'Unclaimed'){
                            echo '<span class="text-red-500">'. $status .'</span>';
                        } elseif ($status == 'Claimed'){
                            echo '<span class="text-green-500">'. $status .'</span>';
                        } elseif ($status == 'Expired'){
                            echo '<span class="text-blue-900">'. $status .'</span>';
                        }
                    ?>
                </p>
                <div class="w-[5%] text-xs">
                    <?php
                        if($status == 'Unclaimed'){
                            ?>
                            <form action="action.php" method="POST" class="w-full flex gap-2 justify-evenly">
                                <button name="cancel" class="w-1/2 flex items-center justify-center bg-red-500 rounded-md text-white py-1 hover:bg-red-600 transition duration-100 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width='14' height='14' fill='white'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                                </button>
                                <button id="complete" name="claim" class="w-1/2 flex items-center justify-center bg-emerald-500 rounded-md py-1 text-white hover:bg-emerald-600 transition duration-100 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width='14' height='14' fill='white'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                                </button>
                                <input type="hidden" name="ticket" value="<?php echo $row['ticket'] ?>">
                                <input type="hidden" name="quantity" value="<?php echo $row['quantity'] ?>">
                                <input type="hidden" name="medicine" value="<?php echo $row['medicine'] ?>">
                            </form>
                            <?php
                        }
                    ?>
                </div>
            </div>
            
        

                    <?php
                }
            } else {
                // If no rows are returned, send a response indicating so
                echo "No rows found";
            }
        ?>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#status').change(function(){
                var selectedStatus = $(this).val();
                console.log(selectedStatus);
                $.ajax({
                    url: 'status.php',
                    method: 'POST',
                    data: {selectedStatus: selectedStatus},
                    success: function(response){
                        $('#table').html(response);
                    },
                    error: function(xhr, status, error){
                        console.error(xhr.responseText);
                    }
                });
            });
        });


        $(document).ready(function(){
            $('input[name="search"]').on('input', function(){
                var search = $(this).val().trim();

                // Perform AJAX request only if searchText is not empty
                if (search !== '') {
                    $.ajax({
                        url: 'status.php',
                        method: 'POST',
                        data: { search: search },
                        success: function(response){
                            // Update search results
                            $('#table').html(response);
                        },
                        error: function(xhr, status, error){
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    // Clear search results if search input is empty
                    $('#table').html('');
                }
            });
        });
    </script>
</body>
</html>

