<?php
    session_start();
    include ('database/db.php');
    include ('session.php');
    if(isset($_GET['button_selected'])){
        $key = $_GET['button_selected'];
    } else {
        echo 'No key selected!';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Browse Drugs | MediGuide</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <script>
        $(document).ready(function () {
            $(".mixedButton").click(function () {
                var buttonValue = $(this).text();
                $.ajax({
                    type: "GET",
                    url: "load-medicines.php",
                    data: { buttonValue: buttonValue },
                    success: function (response) {
                        $("#medicines_list").html(response);
                    }
                });
            });
        });
    </script>
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
    <div class="w-full bg-blue-500 mb-3">
        <div class=" w-2/3 mx-auto gap-3 p-1 pb-9 pt-9">
            <div class="mb-3">
                <p id="drug-starts" class="text-xl text-white">Drugs starts with "<?php echo $key ?>"</p>
            </div>
            <div class="w-full flex gap-2">
                <?php
                    for ($i = 0; $i < 26; $i++) {
                    $letter = chr(97 + $i);

                    $mixed = $key.$letter;
                ?>
                        <button id="btn" class="bg-white w-8 h-8 hover:text-blue-500 mixedButton"><?php echo $mixed ?>
                        </button>
                    
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="w-4/6 mx-auto mb-5">
        <a target="_blank" rel="noopener" href="https://www.unilab.com.ph/alaxan/winning-over-body-pain/articles/worry-free-pain-relief"><img src="img/ads3.jpg" alt="Ads"></a>
    </div>
    <div class="w-2/3 mx-auto flex flex-col mb-5">
        <p id="drugText" class="font-semibold text-xl mb-3">Drugs: <?php echo $key ?></p>
        <div class="flex gap-4">
            <form action="">
                <button class="bg-blue-500 rounded-md py-2 px-4 text-white font-semibold text-sm">Show all</button>
                <button class="rounded-md py-2 px-4 text-sm" style="border: 1px solid #999">Branded</button>
                <button class="rounded-md py-2 px-4 text-sm" style="border: 1px solid #999">Generic</button>
            </form>
        </div>
    </div>
    <div class="w-2/3 mx-auto">
        <div id="medicines_list">
            <?php
                $sql = "SELECT * from medicines WHERE name LIKE '$key%';";
                $query = mysqli_query($con, $sql);

                while($row = mysqli_fetch_assoc($query)){
                    ?>
                    <form action="drugs.php" method="GET">
                    <button class="w-2/3 flex justify-between items-center border-b-2 py-2 px-1 hover:bg-slate-100">
                        <p><?php echo $row['name'] ?></p>
                        <p class="text-sm text-green-500">Generic</p>
                    </button>
                    <input type="hidden" name="medicine" value="<?php echo $row['name'] ?>">
                    </form>
                    <?php
                }
            ?>
        </div>
    </div>
    <script>
    // Get references to the button and the paragraph element
    const buttons = document.getElementsByClassName("mixedButton");
const drugParagraph = document.getElementById("drugText");

// Loop through each button and add a click event listener
for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", function() {
        // Get the current text content of the clicked button
        const buttonValue = this.textContent; // Use "this" to refer to the clicked button
        console.log(buttonValue);

        // Update the text in the paragraph element
        drugParagraph.textContent = "Drugs: " + buttonValue;
    });
}
</script>






</body>
</html>