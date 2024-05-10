<?php
    session_start();
    include ('database/db.php');

    $sql = "SELECT * FROM manufacturer ORDER BY RAND() LIMIT 8";

    $result = mysqli_query($con, $sql);

    include ('session.php');
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
    <title>Find Company | MontiCasa Drugstore</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <div class="w-full flex flex-col bg-slate-50 border-b-4 border-b-green-500">
        <div class="container flex justify-end px-10 py-1 gap-x-24 text-sm">
            <button class="flex gap-1 items-center"><i class="fa-solid fa-user text-green-500"></i><?php echo $last_name; ?>,</button>
            <form class="flex gap-1 items-center" action="logout.php" method="POST"><i class="fa-solid fa-arrow-right-from-bracket text-green-500"></i><input type="submit" name="logout" value="Logout" class="hover:cursor-pointer"></form>
        </div>
        <div class="w-full flex items-center justify-center p-2">
            <img src="img/logo.png" alt="" class="max-w-[2%]">
            <p class="font-semibold text-blue-500">Monti<span class="text-green-500">Casa</span> Drugstore</p>
        </div>
    </div>
    <div class="w-full bg-slate-700">
        <div class="container w-2/3 mx-auto flex justify-center gap-12 text-slate-50 py-2">
            <div><button onclick="window.location.href='find-drugs.php'" class="hover:text-green-500 ease-out duration-200">Find Drugs</button></div>
            <div><button onclick="window.location.href='find-company.php'" class="ease-out duration-200 text-green-500">Find Drug Company</button></div>
        </div>
    </div>
    <div class="w-full bg-blue-600 mb-5">
        <div class="w-2/3 mx-auto flex flex-col py-10">
            <p class="text-2xl font-semibold text-white pb-2">Find Companies</p>
            <div class="w-2/3 flex">
                <div class="w-full relative">
                <input autocomplete="off" id="manufacturer_search" type="text" name="search" placeholder="Enter Manufacturer or Company Name" class="w-full py-2 pl-10 pr-4 bg-white rounded-sm text-gray-800 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 h-5 w-5 text-green-500"></i>
                </div>
                <p class="rounded-sm py-2 px-6 bg-green-500 text-white">Search</p>
            </div>
            <div id="search_result" class="w-2/3 relative mt-2 hidden">
                
            </div>
        </div>
    </div>
    <div class="w-2/3 mx-auto mb-5">
        <p class="text-lg font-semibold mb-5">Feature Companies</p>
        <div class="w-full flex flex-wrap gap-5 justify-evenly">
            <?php
                while($row = mysqli_fetch_assoc($result)){
            ?>
            <form action="manufacturer.php" method="GET" class="">
                <button name="selected" class="w-[200px] flex flex-col items-center border-2">
                    <div class="shadow-md w-full h-[200px] p-4 flex items-center justify-center">
                        <img src="img/manufacturer/<?php echo $row['image'];?>.png" alt="<?php echo $row['name'];?> Logo" class="w-full">
                    </div>
                    <p class="text-center bg-gray-200 w-full h-[70px] pt-2 text-sm"><?php echo $row['name'];?></p>
                    <input type="hidden" name="manufacturer" value="<?php echo $row['name'];?>">
                </button>
            </form>
            <?php } ?>

        </div>
    </div>

    <?php include 'footer.php' ?>
    <script>
        $(document).ready(function(){
            $("#manufacturer_search").keyup(function(){
                var searchResult = document.getElementById('search_result')
                var input = $(this).val();

                if(input != ''){
                    searchResult.style.display = 'block'
                    $.ajax({
                        url:"manufacturer_search.php",
                        method:'GET',
                        data:{input:input},

                        success:function(data){
                            $('#search_result').html(data)
                        }
                    })
                } else {
                    searchResult.style.display = 'none'
                }
            })
        })
    </script>
</body>
</html>