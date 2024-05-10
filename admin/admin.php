<?php
    include('../database/db.php');
    if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }

    $total_records_per_page = 10;
    $offset = ($page_no - 1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $result_count = mysqli_query($con, "SELECT COUNT(*) AS total_records FROM medicines") or die(mysqli_error($con));
    $records = mysqli_fetch_array($result_count);

    $total_records = $records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page)
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
    <div class="w-2/4 mx-auto hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50" id="scanner">
        <video class="mx-auto" id="preview" width="100%"></video><br>
    </div>
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
    <div class="w-full mb-10">
        <div class="w-2/3 mx-auto flex gap-2">
            <div class="w-2/4 mx-auto">
                <div class="w-full mx-auto">
                    <input autocomplete="off" id="medicine_search"  class="w-full py-2 pl-2 border-2" type="text" name="search" placeholder="Search for medicine">
                </div>
                <div id="medicine_result"  class="w-full mx-auto relative hidden">
                    <div class="absolute">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-3/4 flex justify-between gap-4 items-center mx-auto mb-1">
        <div>
            <button onclick="window.location.href='add_medicine.php'" class="px-10 py-2 bg-green-500 text-white">Add Medicine</button>
        </div>
        <div class="flex justify-end gap-4 items-center">
            <p class="font-medium text-sm text-gray-700">Page <?php echo $page_no .' of '. $total_no_of_pages; ?></p>
            <a class="flex items-center justify-center <?= ($page_no <= 1) ? 'disabled' : '';?>" <?= ($page_no > 1) ? 'href=?page_no=' . $previous_page : '';?>>
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
            </a>
            <a class="flex items-center justify-center" <?= ($page_no > 1) ? 'href=?page_no=' . ($page_no - 1) : 'href=?page_no=1' ?>><?= $page_no - 1 ?></a>
            <a class="flex items-center justify-center" href="?page_no=<?= $page_no; ?>"><?= $page_no; ?></a>
            <a class="flex items-center justify-center" <?= ($page_no < 13) ? 'href=?page_no=' . ($page_no + 1) : 'href=?page_no=13' ?>><?= $page_no + 1 ?></a>
            <a class="flex items-center justify-center<?= ($page_no >= $total_no_of_pages) ? 'disabled' : '';?>" <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' . $next_page : '';?>>
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/></svg>
            </a>
        </div>
        
    </div>
    <div class="w-3/4 mx-auto rounded-md shadow-md mb-5">
        <div class="p-5">
            <table class="w-full">
                <tr class="w-full justify-between border-collapse border-b-2 border-black">
                    <th class="text-left py-3">Generic Name</th>
                    <th class="text-left">Medicine Name</th>
                    <th class="text-left">Category</th>
                    <th class="text-left">Type</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    $sql = "SELECT * FROM medicines ORDER BY generic_name ASC LIMIT $offset, $total_records_per_page";
                    $query = mysqli_query($con, $sql);

                    while($row = mysqli_fetch_assoc($query)){
                    ?>
                        <tr class="w-full border-b border-collapse">
                            <td class="py-2">
                                <p><?php echo $row['name'] ?></p>
                            </td>
                            <td>
                                <p><?php echo $row['generic_name'] ?></p>
                            </td>
                            <td>
                                <p class="text-left"><?php echo $row['category'] ?></p>
                            </td>
                            <td>
                                <p class="text-left"><?php echo $row['type'] ?></p>
                            </td>
                            <td>
                                <div action="" class="flex items-center gap-2 justify-evenly">
                                    <a href="edit_medicine.php?medicine=<?php echo $row['generic_name'] ?>" class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg></a>
                                    <a href="" class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512" fill="red"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg></a>
                                </div>
                            </td>
                        </tr>        
                    <?php
                    }
                ?>
            </table>
            
        </div>
    </div>
    <div class="w-2/3 mx-auto flex justify-center gap-5 mb-24">
        <div class="w-2/6 flex flex-col items-center justify-center py-10 rounded-md shadow-lg">
            <?php
                $medicineCount = "SELECT COUNT(*) AS total_medicines FROM medicines";
                $medCountQuery = mysqli_query($con, $medicineCount);
                $medicineRow = mysqli_fetch_assoc($medCountQuery)
            ?>
            <p class="text-xl">Total Medicines</p>
            <p class="text-3xl text-blue-500  font-bold"><?php echo $medicineRow['total_medicines']; ?></p>
        </div>
        <div class="w-2/6 flex flex-col items-center justify-center py-10 rounded-md shadow-lg">
            <?php
                $userCount = "SELECT COUNT(*) AS total_users FROM usersss";
                $usersCountQuery = mysqli_query($con, $userCount);
                $usersRow = mysqli_fetch_assoc($usersCountQuery)
            ?>
            <p class="text-xl">Total Users</p>
            <p class="text-3xl text-blue-500  font-bold"><?php echo $usersRow['total_users']; ?></p>
        </div>
        <div class="w-2/6 flex flex-col items-center justify-center py-10 rounded-md shadow-lg">
            <?php
                $reserveCount = "SELECT COUNT(*) AS total_reservations FROM reserve WHERE status = 'Unclaimed'";
                $reserveCountQuery = mysqli_query($con, $reserveCount);
                $reserveRow = mysqli_fetch_assoc($reserveCountQuery)
            ?>
            <a href="all_reservations.php" class="flex flex-col text-center">
                <p class="text-xl">Total Reservations</p>
                <p class="text-3xl text-blue-500  font-bold"><?php echo $reserveRow['total_reservations']; ?></p>
            </a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const backgroundElement = document.getElementById("background");
            const scanner = new Instascan.Scanner({ video: document.getElementById('preview'), continuous: true });

            const audio = new Audio('../audio/beep-06.mp3');

            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    alert('No cameras found!');
                }
            }).catch(function (e) {
                console.error(e);
            });

            function playBeepSound() {
                // Play the preloaded beep sound
                audio.currentTime = 0;
                audio.play();
            }

            scanner.addListener('scan', function (qr) {
                playBeepSound();
                var url = 'reservations.php?ticket=' + encodeURIComponent(qr);
                
                // Delay the navigation by 1 second (1000 milliseconds)
                setTimeout(function() {
                    window.location.href = url;
                }, 700);
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'F9') {
                let openScanner = document.getElementById('scanner');
                openScanner.style.display = "block"
                console.log('Scanner Opened')
            }
        });
        $(document).ready(function(){
            $("#medicine_search").keyup(function(){
                var medicineResult = document.getElementById('medicine_result')
                var medinput = $(this).val();

                if(medinput != ''){
                    medicineResult.style.display = 'block'
                    $.ajax({
                        url:"../medicine_search_admin.php",
                        method:'GET',
                        data:{input:medinput},

                        success:function(data){
                            $('#medicine_result').html(data)
                        }
                    })
                } else {
                    medicineResult.style.display = 'none'
                }
            })
        })

        $(document).ready(function(){
            $("#manufacturer_search").keyup(function(){
                var manufacturerResult = document.getElementById('manufacturer_result')
                var maninput = $(this).val();

                if(maninput != ''){
                    manufacturerResult.style.display = 'block'
                    $.ajax({
                        url:"../manufacturer_search_admin.php",
                        method:'GET',
                        data:{input:maninput},

                        success:function(data){
                            $('#manufacturer_result').html(data)
                        }
                    })
                } else {
                    manufacturerResult.style.display = 'none'
                }
            })
        })
    </script>
</body>
</html>