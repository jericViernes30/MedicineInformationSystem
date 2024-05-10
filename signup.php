<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

    include ('database/db.php');

    if(isset($_POST['create']) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $name_pattern = '/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/';

        // Set the variables with the form data
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
<<<<<<< HEAD
        $email = $_POST['email'];
        $password = $_POST['password'];
        $contact = $_POST['contact'];

        if (preg_match($name_pattern, $first_name)) {
            $checked_first_name = $first_name;
=======
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
        $countryOfPractice = $_POST["countryOfPractice"];
        $profession = $_POST["profession"];
    
        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Data inserted successfully
            echo "User registration successful.";
>>>>>>> 9a94872e617a2a505c8cb202f9261ef20c3dc9aa
        } else {
            $isValidFirstName = false;
        }

        if (preg_match($name_pattern, $last_name)) {
            $checked_last_name = $last_name;
        } else {
            $isValidLastName = false;
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $checked_email = $email;
        } else {
            
            $isValidEmail = false;
        }

        $mail = new PHPMailer(true);

        try{
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jericviernes06@gmail.com';
            $mail->Password = 'ikul ouhs jrhz ffic';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('jericviernes06@gmail.com', 'Mailer');
            $mail->addAddress($email, $first_name);
            $mail->isHTML(true);
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $mail->Subject = 'Email Verification';
            $mail->Body = "
            <html>
            <head>
            <title>Email Verification</title>
            </head>
            <body>
                <div style='width: 400px; padding: 10px;'>
                    <div style='width: 100%; padding-top: 2rem; display: flex; justify-content: center; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem;'>
                        <p style='font-size: 1.125rem;'>MontiCasa Drugstore.</p>
                    </div>
                    <h1 style='color: #333333;'>Email Verification</h1>
                    <p style='font-size: 1rem'>Hi, $first_name.</p>
                    <p>Please use the following verification code to complete your registration:</p>
                    <p style='font-size: 24px; color: #007bff;'>$verification_code</p>
                    <p>If you did not request this code, please ignore this email.</p>
                    <p>Thank you!</p>
                </div>
            </body>
            </html>
            ";
            $mail->send();
        } catch (Exception $e){
            echo 'Message not sent. Mailer Error: {$mail->ErrorInfo}';
        }
        

        if(strlen($password) >= 10 && preg_match('/[A-Z]/', $password) && preg_match('/\d/', $password) && isset($checked_first_name) && isset($checked_last_name) && isset($checked_email)){
            $validatedPassword = $password;
            $hashedPassword = password_hash($validatedPassword, PASSWORD_DEFAULT); // Hash the password

            // Prepare and bind the SQL statement
            $stmt = mysqli_prepare($con, "INSERT INTO usersss (first_name, last_name, contact, email, verification_code, password) VALUES (?, ?, ?, ?, ?, ?)");
        
            // Bind parameters with the form data
            mysqli_stmt_bind_param($stmt, "ssssss", $checked_first_name, $checked_last_name, $contact, $checked_email, $verification_code, $hashedPassword);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {?>
                <div class="zoom-in w-1/4 flex flex-col items-center justify-center bg-green-500 py-4 px-4 gap-5 rounded-md z-10 absolute top-[30%] left-[37.5%]">
                    <div class="w-[40px] h-[40px] border-4 rounded-[50%] flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM625 177L497 305c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L591 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" fill="white"/></svg>
                    </div>
                    <p class="font-semibold text-white">User created successfully!</p>
                    <a class="w-full bg-slate-50 rounded-md py-1 text-center" href="email_verify.php?email=<?= $email ?>">Verify your email now!</a>
                </div>

                <script>
                    function applyBlur() {
                        var main = document.getElementById('main');
                        main.classList.add('filter', 'blur');
                    }

                    // Call the function when the document is fully loaded
                    document.addEventListener('DOMContentLoaded', applyBlur);
                </script>
                <?php
            } else {
                // Error occurred
                echo "Error: " . mysqli_error($con);
            }

            // Close the statement and the connection
            mysqli_stmt_close($stmt);
            mysqli_close($con);
            
        }
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Signup | MediGuide</title>
    <style>
        p{
            font-family: 'Poppins', sans-serif;
        }

        input, select {
            border: 1px solid #808588
        }

        .zoom-in{
            animation: zoomIn 1s ease-in-out;
        }

        
        @keyframes zoomIn {
            0%{
                opacity: 0;
                transform: scale3d(0.3, 0.3, 0.3);
            }
            50%{
                opacity: 1;
                transform: scale3d(1, 1, 1);
            }
        }
    </style>
</head>
<body>
    <div id="main" class="w-3/4 mx-auto z-0">
        <div class="flex items-center p-1 justify-center my-2">
            <p class=" text-blue-500 text-logo text-2xl font-semibold">Monti<span class="text-green-500">Casa</span> Drugstore</p>
            <img src="img/logo.png" width="70" height="70" alt="">
        </div>
        <div class="w-1/3 mx-auto">
            <p class="text-lg font-semibold my-2">Sign up for a free MontiCasa account today</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="w-full flex gap-2">
                    <div class="w-1/2 flex flex-col mb-3">
                        <label for="" class="mb-2 text-md"><span class="text-red-500">*</span> First Name</label>
                        <input type="text" name="first_name" required class="w-full py-1 px-2">
                        <?php
                            if (isset($isValidFirstName) && !$isValidFirstName) {
                                echo '<p class="error-message text-sm text-red-500 mt-2">It should contain only letters from A-Z and no space at the start or end.</p>';
                            }
                        ?>
                    </div>
                    <div class="w-1/2 flex flex-col mb-3">
                        <label for="" class="mb-2"><span class="text-red-500">*</span> Last Name</label>
                        <input type="text" name="last_name" required class="w-full py-1 px-2">
                        <?php
                            if (isset($isValidLastName) && !$isValidLastName) {
                                echo '<p class="error-message text-sm text-red-500 mt-2">Last name should contain only letters from A-Z and no space at the start or end.</p>';
                            }
                        ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for=""><span class="text-red-500">*</span>Contact Number</label>
                    <input type="number" name="contact" required class="w-full py-1 px-2 mt-2" placeholder="09991334737">
                </div>
                <div class="mb-3">
                    <label for=""><span class="text-red-500">*</span> Email Address</label>
                    <input type="email" name="email" required class="w-full py-1 px-2 mt-2" placeholder="example@gmail.com">
                    <?php
                        if (isset($isValidEmail) && !$isValidEmail) {
                            echo '<p class="error-message text-sm text-red-500 mt-2">Please enter a valid email address.</p>';
                        }
                    ?>
                </div>
                <div class="mb-5">
                    <label for=""><span class="text-red-500">*</span> Password</label>
                    <input id="password" type="password" name="password" required class="w-full py-1 px-2 mt-2 mb-2">
                    <?php
                        if(isset($_POST['password'])){
                            if (strlen($password) < 10) {
                                echo '<p class="error-message text-sm text-red-500 mt-2">Password must 10.</p>';
                            }
                    
                            // Check if the password contains at least one uppercase letter
                            if (!preg_match('/[A-Z]/', $password)) {
                                echo '<p class="error-message text-sm text-red-500 mt-2">Password must uppercase</p>';
                            }
                    
                            // Check if the password contains at least one digit
                            if (!preg_match('/\d/', $password)) {
                                echo '<p class="error-message text-sm text-red-500 mt-2">Password must number</p>';
                            }
                        }
                    ?>
                    <p class="font-medium text-sm">Build a strong password</p>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" height="13" width="13" viewBox="0 0 512 512" class="border rounded-[50%]"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path id="length" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" fill="#49a409" class="hidden"/></svg>
                        <p class="text-sm">Be at least 10 characters long</p>
                    </div>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" height="13" width="13" viewBox="0 0 512 512" class="border rounded-[50%]"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path id="uppercase" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" fill="#49a409" class="hidden"/></svg>
                        <p class="text-sm">Have at least one uppercase</p>
                    </div>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" height="13" width="13" viewBox="0 0 512 512" class="border rounded-[50%]"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path id="digit" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" fill="#49a409" class="hidden"/></svg>
                        <p class="text-sm">Have at least one number</p>
                    </div>
                </div>
                <hr>
                <button name="create" class="w-1/2 py-2 font-medium bg-green-500 text-white rounded-md block mx-auto mt-5 mb-3">Create My Account</button>
                <p class="text-sm text-center">Already have an account? <a href="index.php" class="text-green-500 underline">Login!</a></p>
            </form>
        </div>
    </div>
    <div class="w-full bg-slate-700 flex items-center justify-around absolute bottom-0">
        <?php require 'footer.php'; ?>
    </div>
    <script>
        var password = document.getElementById("password");
        var uppercase = document.getElementById("uppercase");
        var passLength = document.getElementById("length");
        var hasDigit = document.getElementById("digit");

        password.addEventListener("input", function () {
        var passwordValue = password.value;

        // Check if the password contains at least one uppercase letter
        var uppercaseRegex = /[A-Z]/;
        var numberRegex = /[0-9]/;
        var containsUppercase = uppercaseRegex.test(passwordValue);
        var isValidLength = passwordValue.length;
        var containsDigit = numberRegex.test(passwordValue);

        if(isValidLength >= 10){
            passLength.classList.remove('hidden');
        } else {
            passLength.classList.add('hidden');
        }

        // You can use the 'containsUppercase' variable to perform further actions
        if (containsUppercase) {
            uppercase.classList.remove('hidden');
        } else {
            uppercase.classList.add('hidden');
        }

        if (containsDigit) {
            hasDigit.classList.remove('hidden');
        } else {
            hasDigit.classList.add('hidden');
        }
    });

    function openVerification(){

    }
    </script>
</body>
</html>