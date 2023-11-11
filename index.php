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
            // Prepare a SELECT statement to fetch the user's hashed password by email
            $stmt = mysqli_prepare($con, "SELECT email, password FROM users WHERE email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
    
            // Execute the statement
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
    
            // Check if a user with the given email exists
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Bind the result variables
                mysqli_stmt_bind_result($stmt, $db_email, $hashed_password);
                mysqli_stmt_fetch($stmt);
    
                // Verify the password
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, set a session token using the email
                    $_SESSION['user_email'] = $db_email;
    
                    // You can now allow access or perform actions as an authenticated user
                    header("location: home.php");
                } else {
                    // Incorrect password
                    echo "Incorrect password. Please try again.";
                }
            } else {
                // User with the given email does not exist
                echo "User with this email does not exist.";
            }
    
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Email or password is empty
            echo "Both email and password are required.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Login | MediGuide</title>
    <style>
        .bordered{
            border: 1px solid #d4d1cc;
            background-color: #f2efe9;
            
        }
    </style>
</head>
<body style="display: grid; place-items: center; min-height: 100vh;">
    <div class="mx-auto p-2" style="width: 60%;">
        <div class="mb-3">
            <a class="flex items-center text-red-500 font-semibold" href="index.php"><i class="fa-solid fa-caret-left fa-lg"></i><p class="text-sm">Return to MediGuide.com</p></a>
            <!-- <button class="flex items-center text-red-500 font-semibold"><i class="fa-solid fa-caret-left fa-lg"></i><p class="text-sm">Return to MediGuide.com</p></button> -->
        </div>
        <div class="bordered flex rounded-lg">
            <div class="w-2/4 py-4">
                <div class="w-11/12 mx-auto">
                <p class="text-center mb-7">Sign in with your MediGuide Account</p>
                    <form class="flex flex-col px-1" action="" method="POST">
                        <button class="flex items-center mx-auto gap-3 bg-white py-4 px-6 text-sm font-semibold rounded-md shadow-md mb-10">
                            <svg viewBox="0 0 24 24" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                                <g transform="matrix(1, 0, 0, 1, 27.009001, -39.238998)">
                                    <path fill="#4285F4" d="M -3.264 51.509 C -3.264 50.719 -3.334 49.969 -3.454 49.239 L -14.754 49.239 L -14.754 53.749 L -8.284 53.749 C -8.574 55.229 -9.424 56.479 -10.684 57.329 L -10.684 60.329 L -6.824 60.329 C -4.564 58.239 -3.264 55.159 -3.264 51.509 Z"/>
                                    <path fill="#34A853" d="M -14.754 63.239 C -11.514 63.239 -8.804 62.159 -6.824 60.329 L -10.684 57.329 C -11.764 58.049 -13.134 58.489 -14.754 58.489 C -17.884 58.489 -20.534 56.379 -21.484 53.529 L -25.464 53.529 L -25.464 56.619 C -23.494 60.539 -19.444 63.239 -14.754 63.239 Z"/>
                                    <path fill="#FBBC05" d="M -21.484 53.529 C -21.734 52.809 -21.864 52.039 -21.864 51.239 C -21.864 50.439 -21.724 49.669 -21.484 48.949 L -21.484 45.859 L -25.464 45.859 C -26.284 47.479 -26.754 49.299 -26.754 51.239 C -26.754 53.179 -26.284 54.999 -25.464 56.619 L -21.484 53.529 Z"/>
                                    <path fill="#EA4335" d="M -14.754 43.989 C -12.984 43.989 -11.404 44.599 -10.154 45.789 L -6.734 42.369 C -8.804 40.429 -11.514 39.239 -14.754 39.239 C -19.444 39.239 -23.494 41.939 -25.464 45.859 L -21.484 48.949 C -20.534 46.099 -17.884 43.989 -14.754 43.989 Z"/>
                                </g>
                            </svg>Continue with Google
                        </button>
                        <p class="mx-auto text-slate-400 mb-6">_____________________   <span class="text-sm text-black">OR</span>   _____________________</p>
                        <label class="mb-1">Email</label>
                        <input type="text" name="email" placeholder="Email" class="rounded-sm mb-4 px-3 py-2 border-2">
                        <label class="mb-1">Password</label>
                        <input id="password" type="password" name="password" placeholder="Password" class="rounded-sm mb-4 px-3 py-2 border-2">
                        <div class=" flex justify-between mb-10">
                            <div class="flex gap-1 items-center">
                                <input type="checkbox" name="remember_me">
                                <label for="">Remember Me</label>
                            </div>
                            <div>
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div>
                        <button name="login" id="butt" class="mx-auto font-bold py-2 px-16 bg-blue-500 text-white text-sm rounded-md">Sign In</button>
                    </form>
                </div>
            </div>
            <div class="w-2/4 relative"  style="border-left: 1px solid gray">
                <img src="img/sso_login_image.png" class="mx-auto">
                <button onclick="console.log('Button clicked'); window.location.href='signup.php';" class="absolute mx-auto font-bold py-2 px-16 bg-blue-500 text-white text-sm rounded-md bottom-6 left-2/4 transform -translate-x-2/4">Sign Up</button>
                <p class="w-full text-center absolute bottom-52 text-xl">Get your <span class="font-bold">Free MediGuide account</span> today!</p>
                <p class="absolute bottom-24 text-sm text-center">"An extensive and user-friendly information system, "Your Reliable Companion for Over-the-Counter Health Solutions," is crafted to empower individuals in making educated decisions regarding non-prescription medications.</p>
            </div>
        </div>
    </div>
    <div class="w-full bg-slate-700 flex items-center justify-around absolute bottom-0">
        <img src="img/logo.png" alt="" class="max-w-[3%]">
        <p class="text-white text-xs">Copyright © 2023 MediGuide Pte Ltd. All rights reserved. </p>
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