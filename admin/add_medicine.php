<?php
    include ('../database/db.php');
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
    <title>Edit Drug Information | MediGuide</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <div class="w-full flex flex-col bg-slate-50 border-b-4 border-b-green-500 mb-5">
        <div class="container flex justify-end px-10 py-1 gap-x-14 text-sm">
            <button class="flex gap-1 items-center"><i class="fa-solid fa-user text-green-500"></i>Admin: <span class="font-bold uppercase"><?php echo 'Viernes'; ?></span></button>
            <form class="flex gap-1 items-center" action="logout.php" method="POST"><i class="fa-solid fa-arrow-right-from-bracket text-green-500"></i><input type="submit" name="logout" value="Logout" class="hover:cursor-pointer"></form>
        </div>
        <div class="w-full flex items-center justify-center p-2">
            <img src="../img/logo.png" alt="" class="max-w-[2%]">
            <p class="font-semibold">MontiCasa Drugstore</p>
        </div>
    </div>
    <div class="w-[80%] mx-auto">
        <a href="admin.php" class="flex items-center gap-2 mb-2"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg><p>Back</p></a>
    </div>
    <div class="w-full">
        <p class="text-center uppercase text-2xl font-semibold">Add Medicine</p>
    </div>
    <div class="w-4/6 mx-auto mb-10">
        <img src="img/ads2.jpg" alt="">
    </div>
    <form action="save_medicine_prompt.php" method="POST">
        <div class="w-[80%] mx-auto border-b-2 border-black mb-4">
            <div class="mb-1">
                <div class="flex gap-5 items-center text-sm mb-5">
                    <p>Visibile to customers: </p>
                    <div class="flex gap-2">
                        <div class="flex gap-2 items-center">
                            <input type="radio" name="visible" value="True">
                            <label for="">Yes</label>
                        </div>
                        <div class="flex gap-2 items-center">
                            <input type="radio" name="visible" value="False">
                            <label for="">No</label>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-sm mb-5">
                    <p>On stocks:</p>
                    <input type="number" name="stocks" required class="w-[5%] p-1 border-2 text-xs">
                </div>
                <div class="flex gap-2 mb-1">
                    <input class="border-2 px-2 py-1" type="text" name="name">
                </div>
                <div class="flex gap-2">
                    <input class="border-2 px-2 py-1" type="text" name="generic_name">
                </div>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="flex gap-2 items-center">
                    <p>Manufacturer: </p><input class="border-2 px-2 py-1 text-blue-500 w-2/4" type="text" name="manufacturer">
                </div>
                <div class="flex gap-2 items-center">
                    <p>Distributor: </p><input class="border-2 px-2 py-1 text-blue-500 w-2/4" type="text" name="distributor">
                </div>
            </div>
        </div>
        <div class="w-[80%] mx-auto mb-4 flex gap-5">
            <div class="w-1/4">
                <button class="w-full bg-slate-200 text-green-500 text-left py-2 font-semibold pl-2">Full Prescribing Info</button>
            </div>
            <div class="w-1/2">
                <p class="text-xl font-bold mb-5">Full Prescribing Information</p>
                <div class="mb-6">
                    <p class="font-semibold text-lg mb-1">Description</p>
                    <textarea class="border-2 px-2 py-2" name="description" id="" cols="70" rows="10"></textarea>
                </div>
                <div class="mb-6">
                    <p class="font-semibold text-lg">Indications/Uses</p>
                    <textarea class="border-2 px-2 py-2" name="indications" id="" cols="70" rows="10"></textarea>
                </div>
                <div class="mb-6">
                    <p class="font-semibold text-lg">Dosage/Directions for Use</p>
                    <textarea class="border-2 px-2 py-2" name="dosage" id="" cols="70" rows="10"></textarea>
                </div>
                <div class="mb-6">
                    <p class="font-semibold text-lg">Contraindications</p>
                    <textarea class="border-2 px-2 py-2" name="contraindications" id="" cols="70" rows="10"></textarea>
                </div>
                <div class="mb-6">
                    <p class="font-semibold text-lg">Special Precautions</p>
                    <textarea class="border-2 px-2 py-2" name="special_precautions" id="" cols="70" rows="10"></textarea>
                </div>
                <div class="mb-6">
                    <p class="font-semibold text-lg">Adverse Reactions</p>
                    <textarea class="border-2 px-2 py-2" name="adverse_reactions" id="" cols="70" rows="10"></textarea>
                </div>
                <div class="mb-6">
                    <p class="font-semibold text-lg">Drug Interactions</p>
                    <textarea class="border-2 px-2 py-2" name="drug_interactions" id="" cols="70" rows="10"></textarea>
                </div>
                <div class="mb-6">
                    <p class="font-semibold text-lg">Classification</p>
                    <textarea class="border-2 px-2 py-2" name="classification" id="" cols="70" rows="1"></textarea>
                </div>
            </div>
        </div>
        <div class="w-full mb-10">
            <div class="w-[42%] mx-auto flex justify-end items-center"><button name="save" class="bg-green-500 px-4 py-2 text-white rounded-md">Save Information</button></div>
        </div>
    </form>
    <div class="w-full bg-slate-700 flex items-center justify-around">
        <img src="../img/logo.png" alt="" class="max-w-[3%]">
        <p class="text-white text-xs">Copyright © 2023 MediGuide Pte Ltd. All rights reserved. </p>
    </div>
</body>
</html>

