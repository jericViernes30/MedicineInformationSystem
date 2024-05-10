<?php
    $currentDateTime = new DateTime();
    $formattedDateTime = $currentDateTime->format('m-d-Y');
    session_start();
    include ('database/db.php');
    $email = $_GET['email'];
    if(isset($_POST['verify'])){
        $code = $_POST['code'];
        
        $query = "SELECT verification_code FROM usersss WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $verification = $row['verification_code'];
            if($verification == $code){
                $update = "UPDATE usersss SET verified_at = ? WHERE email = ?";
                $stmt1 = mysqli_prepare($con, $update);
                mysqli_stmt_bind_param($stmt1, 'ss', $formattedDateTime, $email);
                mysqli_stmt_execute($stmt1);
                $_SESSION['user_email'] = $email;
                header("Location: find-drugs.php");
            }
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
    <title>Email Verification | MontiCasa Drugstore</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
        .parent-element:hover{
            background-color: #ebecf0;
        }
    </style>
</head>
<body class="">
    <div class="w-full h-screen flex items-center justify-center">
        <div class="w-1/4 rounded-md p-4 border border-[#bebebe] shadow-lg">
            <div class="w-full py-2 flex justify-center items-center gap-5 mb-10">
                <img src="img/logo.png" alt="" class="max-w-[10%]">
                <p class="text-lg">MontiCasa Drugstore.</p>
            </div>
            <p class="text-center text-2xl font-medium mb-10">You're almost there!</p>
            <div class="w-full mb-20">
                <p class="text-center text-sm font-light mb-2">Please enter the 6 digit verification code that we sent to your email.</p>
                <form action="" method="POST" class="w-full">
                    <input maxlength="6" type="text" name="code" class="w-full rounded-md mb-4 py-4 text-3xl font-semibold text-center outline-none bg-emerald-100">
                    <button name='verify' class="w-1/2 block mx-auto py-2 rounded-md bg-emerald-500 text-white uppercase font-medium">Verify my email</button>
                </form>
            </div>
            <div class="w-full">
                <div class="w-full flex justify-center items-center gap-2">
                    <img src="img/logo.png" alt="" class="max-w-[5%]">
                    <p class="text-sm">MontiCasa Drugstore.</p>
                </div>
                <p class="text-center text-xs text-slate-500">Mabuhay City Main Rd, Cabuyao, 4025 Laguna</p>
                <p class="text-center text-xs text-slate-500">Call us - 0956 369 1555</p>
            </div>
        </div>
    </div>
</body>
</html>