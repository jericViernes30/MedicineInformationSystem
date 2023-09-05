<?php
    include ('database/DBHelper.php');
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
    <title>Document</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <div class="w-full flex flex-col bg-slate-50 border-b-4 border-b-blue-600">
        <div class="container flex justify-end px-10 py-1 gap-x-24 text-sm">
            <div class="flex gap-1 items-center"><i class="fa-solid fa-location-dot text-blue-500"></i>Region</div>
            <div class="flex gap-1 items-center"><i class="fa-solid fa-magnifying-glass text-blue-500"></i>Search</div>
            <div class="flex gap-1 items-center"><i class="fa-solid fa-user text-blue-500"></i>Viernes,</div>
        </div>
        <div class="w-full flex items-center justify-center p-2">
            <img src="img/logo.png" alt="" class="max-w-[2%]">
            <p class="font-semibold">MediGuide</p>
        </div>
    </div>
    <div class="w-full bg-slate-700">
        <div class="container w-2/3 mx-auto flex justify-center gap-12 text-slate-50 py-2">
            <div><p class="hover:text-blue-500 ease-out duration-200">Home</p></div>
            <div><p class="hover:text-blue-500 ease-out duration-200">Find Drug</p></div>
            <div><p class="hover:text-blue-500 ease-out duration-200">Find Drug Company</p></div>
        </div>
    </div>
    <div class="w-full bg-blue-600">
        <div class="w-2/3 mx-auto flex flex-col py-10">
            <p class="text-2xl font-semibold text-white pb-2">Find Drugs</p>
            <div class="w-2/3 flex gap-10">
                <div class="w-full relative">
                <input type="text" name="search" placeholder="Enter Drug Name, Manufacturer, etc." class="w-full py-2 pl-10 pr-4 bg-white rounded-sm text-gray-800 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                <i class="fa-solid fa-magnifying-glass text-blue-500 absolute left-3 top-3 h-5 w-5 text-blue-500"></i>
                </div>
                <button class="rounded-sm py-2 px-6 bg-slate-50">Search</button>
            </div>
        </div>
    </div>
    <div class="w-4/6 mx-auto mb-3">
        <img src="img/ads.gif" alt="Ads">
    </div>
    <div class="w-2/3 mx-auto flex flex-col gap-3 p-1 mb-10">

        <p class="text-xl">Browse Drugs (A to Z)</p>
        <div class="flex mx-auto">
            <form action="" method="GET">
                <button name="browse_drugs_selected&button" class="border-2 w-8 h-8" value="A">A</button>
                <button name="browse_drugs_selected&button" class="border-2 w-8 h-8" value="B">B</button>
                <button class="border-2 w-8 h-8">C</button>
                <button class="border-2 w-8 h-8">D</button>
                <button class="border-2 w-8 h-8">E</button>
                <button class="border-2 w-8 h-8">F</button>
                <button class="border-2 w-8 h-8">G</button>
                <button class="border-2 w-8 h-8">H</button>
                <button class="border-2 w-8 h-8">I</button>
                <button class="border-2 w-8 h-8">J</button>
                <button class="border-2 w-8 h-8">K</button>
                <button class="border-2 w-8 h-8">L</button>
                <button class="border-2 w-8 h-8">M</button>
                <button class="border-2 w-8 h-8">N</button>
                <button class="border-2 w-8 h-8">O</button>
                <button class="border-2 w-8 h-8">P</button>
                <button class="border-2 w-8 h-8">Q</button>
                <button class="border-2 w-8 h-8">R</button>
                <button class="border-2 w-8 h-8">S</button>
                <button class="border-2 w-8 h-8">T</button>
                <button class="border-2 w-8 h-8">U</button>
                <button class="border-2 w-8 h-8">V</button>
                <button class="border-2 w-8 h-8">W</button>
                <button class="border-2 w-8 h-8">X</button>
                <button class="border-2 w-8 h-8">Y</button>
                <button class="border-2 w-8 h-8">Z</button>
            </form>
        </div>
    </div>
    <div class="w-2/3 mx-auto mb-3">
        <p class="text-xl">Browse by Sickness Category</p>
        <p class="text-slate-400 font-light text-sm mb-5">(Tap below Sickness Categories to expand for more)</p>
        <div class="w-full mx-auto px-5 flex gap-10">
            <div id="left" class="w-1/3 flex flex-col gap-2">
                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>1. Allergies</p>
                        <button onclick="show('dropdown1')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown1" class="hidden w-full pl-2">
                        <?php
                            $allergy = "SELECT name FROM medicines WHERE category = 'Allergies' ORDER BY name ASC";
                            $allergyQuery = mysqli_query($con, $allergy);
                            while($allergyRow = mysqli_fetch_assoc($allergyQuery)) {
                        ?>
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $allergyRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $allergyRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>2. Cough and Colds</p>
                        <button onclick="show('dropdown2')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown2" class="hidden w-full">
                        <?php
                            $coughAndColds = "SELECT name FROM medicines WHERE category = 'Cough and Colds' ORDER BY name ASC";
                            $coughAndColdsQuery = mysqli_query($con, $coughAndColds);
                            while($coughAndColdsRow = mysqli_fetch_assoc($coughAndColdsQuery)) {
                        ?>
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $coughAndColdsRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $coughAndColdsRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>3. Eyes, Mouth and ENT Preparations</p>
                        <button onclick="show('dropdown3')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div class="w-full border-b-2">
                    <div id="dropdown3" class="hidden w-full">
                        <?php
                            $e = "SELECT name FROM medicines WHERE category = 'ENT Preparations' ORDER BY name ASC";
                            $eQuery = mysqli_query($con, $e);
                            while($eRow = mysqli_fetch_assoc($eQuery)) {
                        ?>
                            <p class="border-b-2 text-blue-500 py-1"><?php echo $eRow['name']; ?></p>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>4. Fever and Pain Relief</p>
                        <button onclick="show('dropdown4')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown4" class="hidden w-full">
                        <?php
                            $feverAndPainRelief = "SELECT name FROM medicines WHERE category = 'Fever and Pain Relief' ORDER BY name ASC";
                            $feverAndPainReliefQuery = mysqli_query($con, $feverAndPainRelief);
                            while($feverAndPainReliefRow = mysqli_fetch_assoc($feverAndPainReliefQuery)) {
                        ?>
                            <p class="border-b-2 text-blue-500 py-1"><?php echo $feverAndPainReliefRow['name']; ?></p>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>5. Hair and Scalp</p>
                        <button onclick="show('dropdown5')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown5" class="hidden w-full">
                        <?php
                            $hairAndScalp = "SELECT name FROM medicines WHERE category = 'Hair and Scalp' ORDER BY name ASC";
                            $hairAndScalpQuery = mysqli_query($con, $hairAndScalp);
                            while($hairAndScalpRow = mysqli_fetch_assoc($hairAndScalpQuery)) {
                        ?>
                            <p class="border-b-2 text-blue-500 py-1"><?php echo $hairAndScalpRow['name']; ?></p>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>6. Hemorroids</p>
                        <button onclick="show('dropdown6')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown6" class="hidden w-full">
                        <?php
                            $hemorroids = "SELECT name FROM medicines WHERE category = 'Hemorrhoids' ORDER BY name ASC";
                            $hemorroidsQuery = mysqli_query($con, $hemorroids);
                            while($hemorroidsRow = mysqli_fetch_assoc($hemorroidsQuery)) {
                        ?>
                            <p class="border-b-2 text-blue-500 py-1"><?php echo $hemorroidsRow['name']; ?></p>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>7. Liver Protectors</p>
                        <button onclick="show('dropdown7')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown7" class="hidden w-full">
                        <?php
                            $liverProtectors = "SELECT name FROM medicines WHERE category = 'Liver Protectors' ORDER BY name ASC";
                            $liverProtectorsQuery = mysqli_query($con, $liverProtectors);
                            while($liverProtectorsRow = mysqli_fetch_assoc($liverProtectorsQuery)) {
                        ?>
                            <p class="border-b-2 text-blue-500 py-1"><?php echo $liverProtectorsRow['name']; ?></p>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>8. Motion Sickness and Vertigo</p>
                        <button onclick="show('dropdown8')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown8" class="hidden w-full">
                        <?php
                            $motionSicknessAndVertigo = "SELECT name FROM medicines WHERE category = 'Motion Sickness and Vertigo' ORDER BY name ASC";
                            $motionSicknessAndVertigoQuery = mysqli_query($con, $motionSicknessAndVertigo);
                            while($motionSicknessAndVertigoRow = mysqli_fetch_assoc($motionSicknessAndVertigoQuery)) {
                        ?>
                            <p class="border-b-2 text-blue-500 py-1"><?php echo $motionSicknessAndVertigoRow['name']; ?></p>
                        <?php
                            }
                        ?>
                    </div>
                
                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>9. Rehydration Solutions</p>
                        <button onclick="show('dropdown9')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown9" class="hidden w-full">
                        <?php
                            $rehydrationSolutions = "SELECT name FROM medicines WHERE category = 'Rehydration Solutions' ORDER BY name ASC";
                            $rehydrationSolutionsQuery = mysqli_query($con, $rehydrationSolutions);
                            while($rehydrationSolutionsRow = mysqli_fetch_assoc($rehydrationSolutionsQuery)) {
                        ?>
                            <p class="border-b-2 text-blue-500 py-1"><?php echo $rehydrationSolutionsRow['name']; ?></p>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>10. Stomach and Intestinal Disorders</p>
                        <button onclick="show('dropdown10')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown10" class="hidden w-full">
                        <?php
                            $stomachDisorders = "SELECT name FROM medicines WHERE category = 'Stomach and intestinal disorders' ORDER BY name ASC";
                            $stomachDisordersQuery = mysqli_query($con, $stomachDisorders);
                            while($stomachDisordersRow = mysqli_fetch_assoc($stomachDisordersQuery)) {
                        ?>
                            <p class="border-b-2 text-blue-500 py-1"><?php echo $stomachDisordersRow['name']; ?></p>
                        <?php
                            }
                        ?>
                    </div>
            </div>
            <div id="right" class="w-1/3">
                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>11. Topical Products</p>
                        <button onclick="show('dropdown11')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown11" class="hidden w-full">
                        <?php
                            $topicalProducts = "SELECT name FROM medicines WHERE category = 'Topical products' ORDER BY name ASC";
                            $topicalProductsQuery = mysqli_query($con, $topicalProducts);
                            while($topicalProductsRow = mysqli_fetch_assoc($topicalProductsQuery)) {
                        ?>
                            <p class="border-b-2 text-blue-500 py-1"><?php echo $topicalProductsRow['name']; ?></p>
                        <?php
                            }
                        ?>
                    </div>
                
                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>12. Weigth Management</p>
                        <button onclick="show('dropdown12')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown12" class="hidden w-full">
                        <?php
                            $topicalProducts = "SELECT name FROM medicines WHERE category = 'Weight management' ORDER BY name ASC";
                            $topicalProductsQuery = mysqli_query($con, $topicalProducts);
                            while($topicalProductsRow = mysqli_fetch_assoc($topicalProductsQuery)) {
                        ?>
                            <p class="border-b-2 text-blue-500 py-1"><?php echo $topicalProductsRow['name']; ?></p>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center">
                        <p>13. Wound Care</p>
                        <button onclick="show('dropdown13')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown13" class="hidden w-full">
                        <?php
                            $woundCare = "SELECT name FROM medicines WHERE category = 'Wound care' ORDER BY name ASC";
                            $woundCareQuery = mysqli_query($con, $woundCare);
                            while($woundCareRow = mysqli_fetch_assoc($woundCareQuery)) {
                        ?>
                            <p class="border-b-2 text-blue-500 py-1"><?php echo $woundCareRow['name']; ?></p>
                        <?php
                            }
                        ?>
                    </div>
            </div>
        </div>
    </div>
    <div class="w-full bg-slate-700 flex items-center justify-around">
        <img src="img/logo.png" alt="" class="max-w-[3%]">
        <p class="text-white text-xs">Copyright © 2023 MediGuide Pte Ltd. All rights reserved. </p>
    </div>
    <script>
        
        function show(dd){
            var x = document.getElementById(dd)
            if(x.style.display === "none"){
                x.style.display = "block"
            } else {
                x.style.display = "none"
            }
        }
    </script>
</body>
</html>