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
    <title>Drug Information | MediGuide</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <div class="w-full flex flex-col bg-slate-50 border-b-4 border-b-blue-600">
        <div class="container flex justify-end px-10 py-1 gap-x-14 text-sm">
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
    <div class="w-4/6 mx-auto mb-10">
        <img src="img/ads2.jpg" alt="">
    </div>
    <div class="w-[80%] mx-auto border-b-2 border-black mb-4">
        <div class="mb-5">
            <p class="text-2xl font-bold"><?php echo $medicineName = $view->getMedName(); ?></p>
            <p class="text-md text-blue-500"><?php echo $genericName = $view->getGenericName(); ?></p>
        </div>
        <div class="flex flex-col gap-1 mb-4">
            <p>Manufacturer: <span class="text-blue-500"><?php echo $medicineName = $view->getManufacturer(); ?></span></p>
            <p>Distributor: <span class="text-blue-500"><?php echo $medicineName = $view->getDistributor(); ?></span></p>
        </div>
    </div>
    <div class="w-[80%] mx-auto mb-4 flex gap-5">
        <div class="w-1/4">
            <button class="w-full bg-slate-200 text-blue-500 text-left py-2 font-semibold">Full Prescribing Info</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Contents</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Description</button>
            <!-- <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Action</button> -->
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Indications/Uses</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Dosage/Direction for Use</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Overdosage</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Contraindications</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Special Precautions</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Adverse Reactions</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Drug Interactions</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Storage</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Classification</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Regulatory Classification</button>
            <button class="w-full text-left py-2 px-2 hover:bg-slate-200 hover:text-blue-500 border-b border-slate-300">Presentation/Packing</button>
        </div>
        <div class="w-1/2">
            <p class="text-2xl font-bold mb-5">Full Prescribing Information</p>
            <div class="mb-4">
                <p class="font-semibold text-lg">Contents</p>
                <p><?php echo $medicineName = $view->getContents(); ?></p>
            </div>
            <div class="mb-6">
                <p class="font-semibold text-lg">Description</p>
                <p><?php echo $medicineName = $view->getDescription(); ?>></p>
            </div>
            <!-- <div class="mb-6">
                <p class="font-semibold text-lg">Action</p>
                <p><span class="font-semibold">Pharmacology:</span> These medicines contain Cetirizine, an anti-allergy. Cetirizine blocks the action of histamine, a substance that causes allergic symptoms. Cetirizine is less likely to cause drowsiness and dizziness than the older class of anti-allergy medicines.</p>
            </div> -->
            <div class="mb-6">
                <p class="font-semibold text-lg">Indications/Uses</p>
                <p><?php echo $medicineName = $view->getIndications(); ?></p>
            </div>
            <div class="mb-6">
                <p class="font-semibold text-lg">Dosage/Directions for Use</p>
                <p><?php echo $medicineName = $view->getDosage(); ?></span>
            </div>
            <div class="mb-6">
                <p class="font-semibold text-lg">Overdosage</p>
                <p><?php echo $medicineName = $view->getOverdosage(); ?></p>
            </div>
            <div class="mb-6">
                <p class="font-semibold text-lg">Contraindications</p>
                <p><?php echo $medicineName = $view->getContraindications(); ?></p>
            </div>
            <div class="mb-6">
                <p class="font-semibold text-lg">Special Precautions</p>
                <p><?php echo $medicineName = $view->getSpecialPrecautions(); ?></p>
            </div>
            <div class="mb-6">
                <p class="font-semibold text-lg">Adverse Reactions</p>
                <p><?php echo $medicineName = $view->getAdversePrecautions(); ?></p>
            </div>
            <div class="mb-6">
                <p class="font-semibold text-lg">Drug Interactions</p>
                <p><?php echo $medicineName = $view->getDrugInteractions(); ?></p>
            </div>
            <div class="mb-6">
                <p class="font-semibold text-lg">Storage</p>
                <?php
                $medicineName = $view->getStorage();
                $storage = str_replace('?', '°', $medicineName);
                ?>
                <p><?php echo $storage; ?></p>
            </div>
            <div class="mb-6">
                <p class="font-semibold text-lg">Classification</p>
                <p class="text-blue-500"><?php echo $medicineName = $view->getClassification(); ?></p>
            </div>
            <div class="mb-4">
                <p class="font-semibold text-lg text-red-500">Regulatory Classification</p>
                <p><?php echo $medicineName = $view->getRegulatoryClassification(); ?></p>
            </div>
        </div>
    </div>
    <div class="w-full bg-slate-700 flex items-center justify-around">
        <img src="img/logo.png" alt="" class="max-w-[3%]">
        <p class="text-white text-xs">Copyright © 2023 MediGuide Pte Ltd. All rights reserved. </p>
    </div>
</body>
</html>

