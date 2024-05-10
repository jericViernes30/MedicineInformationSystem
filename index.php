<?php
    session_start();
    include ('database/db.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_POST['login'])) {
        // Retrieve user input from the login form
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Check if the email and password are not empty
        if (!empty($email) && !empty($password)) {
            // Prepare a SELECT statement to fetch the user's hashed password and verification status by email
            $stmt = mysqli_prepare($con, "SELECT email, password, verified_at FROM usersss WHERE email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
    
            // Execute the statement
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
    
            // Check if a user with the given email exists
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Bind the result variables
                mysqli_stmt_bind_result($stmt, $db_email, $hashed_password, $verified_at);
                mysqli_stmt_fetch($stmt);
    
                // Check if the email is verified
                if ($verified_at === null) {
                    // Email is not verified
                    echo '<script>alert("Email is not verified. Please verify your email first."); window.location.href = "index.php";</script>';
                } else {
                    // Verify the password
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, set a session token using the email
                        $_SESSION['user_email'] = $db_email;
    
                        // You can now allow access or perform actions as an authenticated user
                        header("location: find-drugs.php");
                    } else {
                        // Incorrect password
                        echo '<script>alert("Incorrect password. Please try again."); window.location.href = "index.php";</script>';
                    }
                }
            } else {
                // User with the given email does not exist
                echo '<script>alert("User with this email does not exist."); window.location.href = "index.php";</script>';
            }
    
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Email or password is empty
            echo '<script>alert("Both email and password are required."); window.location.href = "index.php";</script>';
        }
    }
<<<<<<< HEAD
    
=======
}
>>>>>>> 9a94872e617a2a505c8cb202f9261ef20c3dc9aa
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Login | MontiCasa Drugstore</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
        .bordered{
            border: 1px solid #d4d1cc;
            background-color: #f2efe9;
            
        }
    </style>
</head>
<body style="display: grid; place-items: center; min-height: 100vh;">
    <div class="mx-auto p-2 w-2/6">
        <div class="bordered flex rounded-lg">
            <div class="w-full py-4">
                <div class="w-full mx-auto px-5">
                    <img class="mx-auto" src="img/logo.png" alt="" width="100px">
                    <p class="text-blue-500 font-bold text-2xl text-center">Monti<span class="text-green-500">Casa</span> Drugstore</p>
                    <p class="italic font-semibold text-green-500 text-center mb-4">Your Health Guardian</p>
                    <p class="text-center mb-3 font-bold">Sign in with your account</p>
                    <form class="flex flex-col px-1" action="" method="POST">
                        <label class="mb-1">Email</label>
                        <input type="text" name="email" placeholder="Email" class="rounded-md mb-4 px-3 py-2 border-2" required>
                        <label class="mb-1">Password</label>
                        <input id="password" type="password" name="password" placeholder="Password" class="rounded-md mb-4 px-3 py-2 border-2" required>
                        <button name="login" id="butt" class="mx-auto font-medium py-2 px-16 border bg-green-500 text-sm rounded-md text-white mb-2">Sign In</button>
                    </form>
                    <p class="text-sm text-center">Don't have an account? <a href="signup.php" class="underline text-green-500">Create one!</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full bg-slate-700 flex items-center justify-around absolute bottom-0">
        <?php require 'footer.php'; ?>
    </div>
    <script>
    document.getElementById("password").addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent the default form submission
            document.querySelector("form").submit(); // Manually submit the form
        }
    });
</script>
</body>
</html>