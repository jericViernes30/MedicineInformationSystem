<?php
    include('../database/db.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_POST['login'])) {
        // Retrieve user inputs from the form
        $adminEmail = $_POST['admin_email'];
        $adminPassword = $_POST['admin_password'];
    
        // SQL query to check if the provided credentials are valid
        $query = "SELECT * FROM admin WHERE admin_email = ? AND admin_password = ?";
        
        // Prepare the statement
        $stmt = mysqli_prepare($con, $query);
    
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $adminEmail, $adminPassword);
    
        // Execute the statement
        mysqli_stmt_execute($stmt);
    
        // Get result set
        $result = mysqli_stmt_get_result($stmt);
    
        if ($result) {
            // Check if any rows were returned
            if (mysqli_num_rows($result) > 0) {
                // Login successful
                header('location: admin.php');
            } else {
                // Login failed
                echo "Login failed. Please check your credentials.";
            }
        } else {
            // Query execution failed
            echo "Error: " . mysqli_error($con);
        }
    
        // Close the statement
        mysqli_stmt_close($stmt);
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
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Admin Login | MontiCasa Drugstore</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="grid items-center min-h-screen bg-slate-100">
    <div class="w-2/6 max-h-fit mx-auto shadow-lg bg-slate-50 py-4">
        <img class="mx-auto" src="../img/logo.png" alt="" width="100px">
        <p class="text-blue-500 font-bold text-2xl text-center">Monti<span class="text-green-500">Casa</span> Drugstore</p>
        <p class="italic font-semibold text-green-500 text-center mb-4">Your Health Guardian</p>
        <p class="font-semibold text-center uppercase mb-10">Admin Login</p>
        <form action="" method="POST" class="w-full">
            <label class="block text-center" for="name">Admin Email</label>
            <input type="email" name="admin_email" class="block px-2 py-1 mx-auto w-10/12 shadow-lg border-2 border-green-200 mb-4 rounded-md outline-none">
            <label class="block text-center" for="name">Admin Password</label>
            <input type="password" name="admin_password" class="block px-2 py-1 mx-auto w-10/12 shadow-lg border-2 border-green-200 mb-4 rounded-md outline-none">
            <button name="login" class="block w-1/2 py-1 text-center mx-auto bg-green-500 text-white rounded-md">Login</button>
        </form>
    </div>
</body>
</html>