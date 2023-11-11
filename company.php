<?php
    session_start();
    include ('database/db.php');
    include ('session.php');

    if(isset($_GET['manufacturer'])){
        $manufacturer = $_GET['manufacturer'];
        $query = "SELECT * FROM manufacturer WHERE name = '$manufacturer'";
        $result = mysqli_query($con, $query);
        
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
        } else {
            echo 'No rows found';
        }

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
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Find Drugs | MediGuide</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <div class="w-full flex flex-col bg-slate-50 border-b-4 border-b-blue-600">
        <div class="container flex justify-end px-10 py-1 gap-x-24 text-sm">
            <div class="flex gap-1 items-center"><i class="fa-solid fa-location-dot text-blue-500"></i><?php echo $region; ?></div>
            <div class="flex gap-1 items-center"><i class="fa-solid fa-magnifying-glass text-blue-500"></i>Search</div>
            <button class="flex gap-1 items-center"><i class="fa-solid fa-user text-blue-500"></i><?php echo $last_name; ?>,</button>
            <form class="flex gap-1 items-center" action="logout.php" method="POST"><i class="fa-solid fa-arrow-right-from-bracket text-blue-500"></i><input type="submit" name="logout" value="Logout" class="hover:cursor-pointer"></form>
        </div>
        <div class="w-full flex items-center justify-center p-2">
            <img src="img/logo.png" alt="" class="max-w-[2%]">
            <p class="font-semibold">MediGuide</p>
        </div>
    </div>
    <div class="w-full bg-slate-700 mb-5">
        <div class="container w-2/3 mx-auto flex justify-center gap-12 text-slate-50 py-2">
            <div><button onclick="window.location.href='home.php'" class="hover:text-blue-500 ease-out duration-200">Home</button></div>
            <div><button onclick="window.location.href='find-drugs.php'" class="hover:text-blue-500 ease-out duration-200">Find Drugs</button></div>
            <div><button onclick="window.location.href='find-company.php'" class="hover:text-blue-500 ease-out duration-200">Find Drug Company</button></div>
        </div>
    </div>
    <div class="w-4/5 mx-auto mb-4 flex gap-5">
        <div class="w-3/12">
            <button onclick="window.location.href='manufacturer.php'" class="w-full py-2 border-b-2 border-b-gray-300">Products</button>
            <button class="w-full py-2 border-b-2 border-b-gray-300 bg-gray-100 text-red-500">About</button>
        </div>
        <div class="w-3/4">
            <div class="w-full flex flex-col p-2">
                <img class="mb-5" src="img/manufacturer/<?php echo $row['image'] ?>.png" alt="" width="200px">
                <p class="uppercase font-semibold mb-5 text-xl"><?php echo $row['name'] ?></p>
                <p class="mb-5">Featured products of <span class="text-blue-500 underline italic"><?php echo $row['name'] ?></span></p>
            </div>
        </div>
    </div>
</body>
</html>