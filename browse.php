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
    <title>Browse Drugs | MontiCasa Drugstore</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <script>
        $(document).ready(function () {
            $(".type").click(function () {
                var buttonValue = $(this).text();
                var key = '<?php echo $key; ?>';
                $.ajax({
                    type: "GET",
                    url: "load-medicines.php",
                    data: { buttonValue: buttonValue, key:key },
                    success: function (response) {
                        $("#medicines_list").html(response);
                    }
                });
            });
        });
    </script>
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
        <div class="container w-2/3 mx-auto flex justify-center gap-12 text-slate-50 py-2 mb-5">
            <div><button onclick="window.location.href='find-drugs.php'" class="text-green-500 ease-out duration-200">Find Drugs</button></div>
        </div>
    </div>
    <div class="w-2/3 mx-auto flex flex-col mb-5">
        <a href="find-drugs.php" class="flex items-center gap-2 mb-2"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg><p>Back</p></a>
        <p id="drugText" class="font-semibold text-xl mb-3">Drugs starts with: <?php echo $key ?></p>
        <div class="flex gap-4">
            <button id="all" class="rounded-md py-2 px-4 text-sm type border bg-blue-500 text-white">All</button>
            <button id="branded" class="rounded-md py-2 px-4 text-sm type border">Branded</button>
            <button id="generic" class="rounded-md py-2 px-4 text-sm type border">Generic</button>
        </div>
    </div>
    <div class="w-2/3 mx-auto">
        <div id="medicines_list">
            <?php
                $sql = "SELECT generic_name, type, stocks from medicines WHERE generic_name LIKE '$key%';";
                $query = mysqli_query($con, $sql);

                while($row = mysqli_fetch_assoc($query)){
                    ?>
                    <form action="drugs.php" method="GET">
                    <button class="w-full flex justify-between items-center border-b-2 py-2 px-1 hover:bg-slate-100">
                        <p><?php echo $row['generic_name'] ?></p>
                        <div class="flex gap-2 items-center">
                            <p class="text-sm text-blue-500"><?php echo $row['type']; ?></p>
                            <p>
                                <?php 
                                    $stocks = $row['stocks'];
                                    if($stocks != 0){
                                        echo "<p class='text-green-500 text-sm'>Available</p>";
                                    } else {
                                        echo "<p class='text-red-500 text-sm'>Unavailable</p>";
                                    }
                                ?>
                            </p>
                        </div>
                        
                    </button>
                    <input type="hidden" name="medicine" value="<?php echo $row['generic_name'] ?>">
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
    const all = document.getElementById("all")
    const branded = document.getElementById('branded')
    const generic = document.getElementById('generic')

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

  // Add click event listener to each button
  all.addEventListener('click', function() {
    updateButtonStyle(all);
  });

  branded.addEventListener('click', function() {
    updateButtonStyle(branded);
  });

  generic.addEventListener('click', function() {
    updateButtonStyle(generic);
  });

  function updateButtonStyle(clickedButton) {
    // Remove the bg-blue-500 class from all buttons
    all.classList.remove('bg-blue-500', 'text-white');
    branded.classList.remove('bg-blue-500', 'text-white');
    generic.classList.remove('bg-blue-500', 'text-white');

    // Add the bg-blue-500 class to the clicked button
    clickedButton.classList.add('bg-blue-500', 'text-white');
  }

</script>






</body>
</html>