<?php
    session_start();
    include ('database/db.php');
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
    <div class="w-full bg-slate-700">
        <div class="container w-2/3 mx-auto flex justify-center gap-12 text-slate-50 py-2">
            <div><button onclick="window.location.href='home.php'" class="hover:text-blue-500 ease-out duration-200">Home</button></div>
            <div><button onclick="window.location.href='find-drugs.php'" class="hover:text-blue-500 ease-out duration-200">Find Drugs</button></div>
            <div><button onclick="window.location.href='find-company.php'" class="hover:text-blue-500 ease-out duration-200">Find Drug Company</button></div>
        </div>
    </div>
    <div class="w-full bg-blue-600">
        <div class="w-2/3 mx-auto flex flex-col py-10 relative">
            <p class="text-2xl font-semibold text-white pb-2">Find Drugs</p>
            <div class="w-2/3 flex gap-10 relative">
                <div class="w-full relative">
                <input id="medicine_search" type="text" placeholder="Enter Drug Name, Manufacturer, etc." class="w-full py-2 pl-10 pr-4 bg-white rounded-sm text-gray-800 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 h-5 w-5 text-blue-500"></i>
                </div>
                <button class="rounded-sm py-2 px-6 bg-slate-50">Search</button>
            </div>
            <div id="search_result" class="w-2/3 relative pb-5 mt-2 hidden">
                
            </div>
        </div>
    </div>
    <div class="w-4/6 mx-auto mb-3">
        <img src="img/ads.gif" alt="Ads">
    </div>
    <div class="w-2/3 mx-auto flex flex-col gap-3 p-1 mb-10">

        <p class="text-xl">Browse Drugs (A to Z)</p>
        <div class="flex mx-auto">
            <form action="browse.php" method="GET">
                <button name="button_selected" class="border-2 w-8 h-8" value="A">A</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="B">B</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="C">C</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="D">D</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="E">E</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="F">F</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="G">G</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="H">H</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="I">I</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="J">J</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="K">K</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="L">L</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="M">M</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="N">N</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="O">O</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="P">P</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="Q">Q</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="R">R</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="S">S</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="T">T</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="U">U</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="V">V</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="W">W</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="X">X</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="Y">Y</button>
                <button name="button_selected" class="border-2 w-8 h-8" value="Z">Z</button>
            </form>
        </div>
    </div>
    <div class="w-2/3 mx-auto mb-3">
        <p class="text-xl">Browse by Sickness Category</p>
        <p class="text-slate-400 font-light text-sm mb-5">(Click the '+' icon besides Sickness Categories to expand for more)</p>
        <div class="w-full mx-auto px-5 flex gap-10">
            <div id="left" class="w-1/3 flex flex-col gap-2">
                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center py-1">
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
                    <div class="w-full flex justify-between items-center py-1">
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
                    <div class="w-full flex justify-between items-center py-1">
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
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $eRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $eRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center py-1">
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
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $feverAndPainReliefRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $feverAndPainReliefRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center py-1">
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
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $hairAndScalpRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $hairAndScalpRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center py-1">
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
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $hemorroidsRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $hemorroidsRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center py-1">
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
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $liverProtectorsRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $liverProtectorsRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center py-1">
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
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $motionSicknessAndVertigoRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $motionSicknessAndVertigoRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>
                
                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center py-1">
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
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $rehydrationSolutionsRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $rehydrationSolutionsRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center py-1">
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
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $stomachDisordersRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $stomachDisordersRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>
            </div>
            <div id="right" class="w-1/3">
                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center py-1">
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
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $topicalProductsRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $topicalProductsRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>
                
                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center py-2">
                        <p>12. Weigth Management</p>
                        <button onclick="show('dropdown12')"><i class="fa-solid fa-plus float-right text-xs"></i></button>
                    </div>
                </div>
                    <div id="dropdown12" class="hidden w-full">
                        <?php
                            $weightManagement = "SELECT name FROM medicines WHERE category = 'Weight management' ORDER BY name ASC";
                            $weightManagementQuery = mysqli_query($con, $topicalProducts);
                            while($weightManagementRow = mysqli_fetch_assoc($weightManagementQuery)) {
                        ?>
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $weightManagementRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $weightManagementRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>

                <div class="w-full border-b-2">
                    <div class="w-full flex justify-between items-center py-2">
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
                            <form action="drugs.php" method="GET">
                            <button class="border-b-2 text-blue-500 py-1 w-full text-left hover:bg-slate-100"><?php echo $woundCareRow['name']; ?></button>
                            <input type="hidden" name="medicine" value="<?php echo $woundCareRow['name']; ?>">
                            </form>
                        <?php
                            }
                        ?>
                    </div>
            </div>
        </div>
    </div>
    <?php
        include 'footer.php';
    ?>
    <script>
        $(document).ready(function(){
            $("#medicine_search").keyup(function(){
                var searchResult = document.getElementById('search_result')
                var input = $(this).val();

                if(input != ''){
                    searchResult.style.display = 'block'
                    $.ajax({
                        url:"medicine_search.php",
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

        function show(dd){
            var x = document.getElementById(dd)
            if(x.style.display === "" || x.style.display === "none"){
                x.style.display = "block"
            } else {
                x.style.display = "none"
            }
        }
    </script>
</body>
</html>