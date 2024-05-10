<?php
    session_start();
    include ('database/db.php');
    include ('session.php');
    include 'Controller/MedicineController.php';
    include 'Views/MedicineView.php';



if (isset($_GET['medicine'])) {
    $name = $_GET['medicine'];

    $controller = new MedicineController();
    $medicine = $controller->getMedicineByName($name);

    $view = new MedicineView();
    $view->displayMedicine($medicine);

    $genericName = $view->getGenericName();
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Drug Information | MontiCasa Drugstore</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <script>
        function openModal(){
            var body = document.getElementById('body')
            var modal = document.getElementById('modal')
            modal.classList.toggle('hidden')

            if(!modal.classList.contains('hidden')){
                body.style.filter = 'blur(5px)'
            } else {
                body.style.filter = 'blur(0px)'
            }
        }
        function openProfile(){
            var modal = document.getElementById('profile')
            var body = document.getElementById('body')
            var main = document.getElementById('main')
            modal.classList.remove('hidden')
            body.style.filter = 'blur(5px)'
            main.style.overflow = 'hidden'

        }
        function closeProfile(){
            var modal = document.getElementById('profile')
            var body = document.getElementById('body')
            var main = document.getElementById('main')
            modal.classList.add('hidden')
            body.style.filter = 'blur(0px)'
            main.style.overflow = 'auto'
        }
    </script>
</head>
<body id="main">
    <div id="profile" class="hidden absolute w-1/2 border border-[#bebebe] bg-[#f4f4f4] top-[50px] left-1/2 transform -translate-x-1/2 p-6 z-10 rounded-md">
        <button onclick="closeProfile()">Close</button>
        <p class="text-center font-semibold mb-6">User Profile</p>
        <script>
            $(document).ready(function(){
                $('#nameBtn').click(function(){
                    $('#contents').load('demo.php');
                })
            })
        </script>
        <div id="contents" class="w-full text-sm">

        </div>
    </div>
    <div id="modal" class="hidden absolute w-1/4 border border-[#bebebe] bg-[#f4f4f4] top-[100px] left-1/2 transform -translate-x-1/2 p-6 z-10 rounded-md">
        <form action="reserve.php" method="POST">
            <?php 
                $server = 'localhost';
                $user = 'root';
                $pass = '';
                $dbname = 'medicine_information_system';
                
                $conn = mysqli_connect($server, $user, $pass, $dbname); 

                $sql = "SELECT stocks from medicines WHERE generic_name = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $genericName);
                mysqli_stmt_execute($stmt); // Corrected line
                $result = mysqli_stmt_get_result($stmt); // Retrieve the result
                $row = mysqli_fetch_assoc($result);

                
                $total = "SELECT SUM(quantity) AS reserved FROM reserve WHERE medicine = ?";
                $totalStmt = mysqli_prepare($conn, $total);
                mysqli_stmt_bind_param($totalStmt, "s", $genericName);
                mysqli_stmt_execute($totalStmt);
                $reserves_result = mysqli_stmt_get_result($totalStmt);
                $reservesRow = mysqli_fetch_assoc($reserves_result);

                $canReserve = $row['stocks'] - $reservesRow['reserved'];
            ?>
            <div class="w-full flex flex-col gap-1">
                <div class="w-full flex gap-1">
                    <p class="mb-2">In stock:</p>
                    <p id="stock">
                        <?php 
                            echo $row['stocks'];
                        ?>
                    </p>
                </div>
                <div class="w-full flex gap-1">
                    <p class="mb-2">Reserved:</p>
                    <p id="reserved">
                        <?php 
                            $total_reserved = $reservesRow['reserved'];
                            echo $total_reserved;
                        ?>
                    </p>
                </div>
            </div>
            <div class="w-full mb-3">
                <label for="">Quantity</label>
                <input id="quantity" type="text" name="quantity" value="<?php echo $row['stocks'] ?>" class="w-full px-2 py-1 outline-none border border-green-500 rounded-md mb-2 text-center">
                <input type="hidden" name="medicine" value="<?php echo $genericName ?>">
                <div class="w-full flex gap-1">

                    <button id="dec" onclick="decrease()" class="w-1/2 py-1 border border-[#bebebe] bg-[#f4f4f4] rounded-md"><</button>
                    <button id="inc" onclick="increase()" class="w-1/2 py-1 border border-[#bebebe] bg-[#f4f4f4] rounded-md">></button>
                </div>
            </div>
            <div>
                <label for="">Note:</label>
                <textarea name="note" id="" cols="30" rows="10" class="w-full px-2 py-1 outline-none border border-green-500 rounded-md mb-2"></textarea>
            </div>
            <button id="confirm" name="confirm" class="w-full rounded-md bg-green-500 py-1">Confirm</button>
            <script>
                    var qty = 1
                    var quantity = document.getElementById('quantity');
                    var stock = document.getElementById('stock')
                    var stockQty = parseInt(stock.textContent);
                    var confirm = document.getElementById('confirm')

                    if(quantity.value == 0){
                        confirm.disabled = true
                        confirm.style.background = 'gray'
                    }

                    function increase() {
                        event.preventDefault()
                        if (qty < <?php echo $canReserve ?>) {
                            qty++;
                            quantity.value = qty;
                        }
                    }

                    function decrease() {
                        event.preventDefault()
                        if (qty > 1) {
                            qty--;
                            quantity.value = qty;
                        }
                    }
                </script>
        </form>
    </div>
    <div id="body" class="z-0">
        <div class="w-full flex flex-col bg-slate-50 border-b-4 border-b-green-500">
            <div class="container flex justify-end px-10 py-1 gap-x-14 text-sm">
                <button onclick="openProfile()" id="nameBtn" class="flex gap-1 items-center"><i class="fa-solid fa-user text-green-500"></i><?php echo $last_name; ?>,</button>
                <form class="flex gap-1 items-center" action="logout.php" method="POST"><i class="fa-solid fa-arrow-right-from-bracket text-green-500"></i><input type="submit" name="logout" value="Logout" class="hover:cursor-pointer"></form>
            </div>
            <div class="w-full flex items-center justify-center p-2">
                <img src="img/logo.png" alt="" class="max-w-[2%]">
                <p class="font-semibold text-blue-500">Monti<span class="text-green-500">Casa</span> Drugstore</p>
            </div>
        </div>
        <div class="w-full bg-slate-700 mb-10">
            <div class="container w-2/3 mx-auto flex justify-center gap-12 text-slate-50 py-2">
                <div><button onclick="window.location.href='find-drugs.php'" class="text-green-500 ease-out duration-200">Find Drugs</button></div>
            </div>
        </div>
        <div class="w-[80%] mx-auto border-b-2 border-black mb-4">
            <div class="mb-5 w-full">
                <div class="w-full flex justify-between">
                    <p class="text-2xl font-bold"><?php echo $medicineName = $view->getMedName(); ?></p>
                    <button onclick="openModal()" class="px-4 bg-green-500">Pre order</button>
                </div>
                <p class="text-lg text-blue-500 mb-2"><?php echo $genericName = $view->getGenericName();?></p>
                <p class="text-sm text-gray-500">In stocks: <?php echo $view->getStocks(); ?> left</p>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                <p>Manufacturer: <span class="text-blue-500"><?php echo $medicineName = $view->getManufacturer(); ?></span></p>
            </div>
        </div>
        <div class="w-[80%] mx-auto mb-4 flex gap-5">
            <div class="w-1/4">
                <form action="">
                    <p class="text-sm font-semibold">Available Brands</p>
                    <?php
                    $medName = $view->getMedName();
                    $sql = "SELECT * FROM medicines WHERE type = 'Branded' AND name = '$medName'";
                    $query = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($query)){
                        ?>
                        <button>
                            <p class="text-red-500 text-sm"><?php echo $row['generic_name']; ?></p>
                            <input type="hidden" name="medicine" value="<?php echo $row['generic_name']; ?>">
                        </button>
                        <?php
                    }
                    ?>
                </form>
            </div>
            <div class="w-1/2">
                <p class="text-xl font-bold mb-5">Full Prescribing Information</p>
                <!-- <div class="mb-4">
                    <p class="font-semibold text-lg">Contents</p>
                    <p><?php echo $medicineName = $view->getContents(); ?></p>
                </div> -->
                <div class="mb-6">
                    <p class="font-semibold text-lg">Description</p>
                    <p class="text-justify"><?php echo $medicineName = $view->getDescription(); ?>></p>
                </div>
                <!-- <div class="mb-6">
                    <p class="font-semibold text-lg">Action</p>
                    <p><span class="font-semibold">Pharmacology:</span> These medicines contain Cetirizine, an anti-allergy. Cetirizine blocks the action of histamine, a substance that causes allergic symptoms. Cetirizine is less likely to cause drowsiness and dizziness than the older class of anti-allergy medicines.</p>
                </div> -->
                <div class="mb-6">
                    <p class="font-semibold text-lg">Indications/Uses</p>
                    <p class="text-justify"><?php echo $medicineName = $view->getIndications(); ?></p>
                </div>
                <div class="mb-6">
                    <p class="font-semibold text-lg">Dosage/Directions for Use</p>
                    <p class="text-justify"><?php echo $medicineName = $view->getDosage(); ?></span>
                </div>
                <!-- <div class="mb-6">
                    <p class="font-semibold text-lg">Overdosage</p>
                    <p><?php echo $medicineName = $view->getOverdosage(); ?></p>
                </div> -->
                <div class="mb-6">
                    <p class="font-semibold text-lg">Contraindications</p>
                    <p class="text-justify"><?php echo $medicineName = $view->getContraindications(); ?></p>
                </div>
                <div class="mb-6">
                    <p class="font-semibold text-lg">Special Precautions</p>
                    <p class="text-justify"><?php echo $medicineName = $view->getSpecialPrecautions(); ?></p>
                </div>
                <div class="mb-6">
                    <p class="font-semibold text-lg">Adverse Reactions</p>
                    <p class="text-justify"><?php echo $medicineName = $view->getAdversePrecautions(); ?></p>
                </div>
                <div class="mb-6">
                    <p class="font-semibold text-lg">Drug Interactions</p>
                    <p class="text-justify"><?php echo $medicineName = $view->getDrugInteractions(); ?></p>
                </div>
                <!-- <div class="mb-6">
                    <p class="font-semibold text-lg">Storage</p>
                    <?php
                    $medicineName = $view->getStorage();
                    $storage = str_replace('?', '°', $medicineName);
                    ?>
                    <p><?php echo $storage; ?></p>
                </div> -->
                <div class="mb-6">
                    <p class="font-semibold text-lg">Classification</p>
                    <p class="text-blue-500"><?php echo $medicineName = $view->getClassification(); ?></p>
                </div>
                <div class="mb-4">
                    <p class="font-semibold text-lg text-red-500 mb-3">Presentation/Packing</p>
                    <img class="" src="img/packagings/<?php echo $medicineName = $view->getPacking()?>.jpg" alt="<?php echo $medicineName = $view->getPacking()?> Packaging" width="400" height="400">
                </div>
            </div>
        </div>
        <div class="w-full bg-slate-700 flex items-center justify-around">
            <img src="img/logo.png" alt="" class="max-w-[3%]">
            <p class="text-white text-xs">Copyright © 2023 MediGuide Pte Ltd. All rights reserved. </p>
        </div>
    </div>
</body>
</html>

