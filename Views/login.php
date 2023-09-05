<?php
    include 'database/DBHelper.php';
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
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="img/vector1.png" alt="" class="vector">
            <p class="tagline">"Empowering Health Through Data:</p>
            <p class="tagline-b">Your Prescription for Informed Care"</p>
            <p class="bullet"><i class="fa-solid fa-hand-holding-medical"></i>Enhanced Patient Care and Safety</p>
            <p class="bullet"><i class="fa-solid fa-stethoscope"></i>Efficient Healthcare Operations</p>
            <p class="bullet"><i class="fa-solid fa-book-medical"></i>Data-Driven Insights and Research</p>
        </div>
        <div class="right">
            <div class="head">
                <div class="app-name">
                    <img src="img/logo.png" alt="" style="max-width: 10%;">
                    <p>Medi<span>Guide</span></p>
                </div>
                <!-- <div class="register">
                    <button id="button-select" class="register-btn" onclick="buttons()">Register</button>
                </div> -->
            </div>
            <div class="login-container">
                <form action="" method="post">
                    <div id="login" class="login-form">
                        <p>Login</p>
                        <label for="">Name</label>
                        <input type="text" name="name" class="input">
                        <label for="">Email</label>
                        <input type="email" name="email" class="input">
                        <div class="options">
                            <div class="save-user">
                                <input type="checkbox" name="save_user" value="yes">
                                <label for="">Agree to the Terms & Conditions of the app</label>
                            </div>
                            
                        </div>
                        <button type="submit" class="login-btn" name="login">Login</button>
                    </div>

                    <!-- <div id="register" class="register-form">
                        <p>Register</p>
                        <label for="">Name</label>
                        <input type="text" name="name_r" class="input">
                        <label for="">Email</label>
                        <input type="email" name="email_r" class="input">
                        <label for="">Password</label>
                        <input type="password" name="password_r" class="input">
                        <div class="terms">
                            <input type="checkbox" name="save_user" value="yes">
                            <label for="">Agree to Terms and Conditions</label>
                        </div>
                        <button type="submit" class="login-btn" name="register">Register</button>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

    <script>
        var login = document.getElementById("login")
        var register = document.getElementById("register")
        var button = document.getElementById("button-select")

        function buttons(){
            if(button.textContent.trim() === "Register"){
                login.style.left ="-45rem"
                register.style.left = "0"
                button.innerText = "Login"
            } else {
                login.style.left ="0"
                register.style.left = "45rem"
                button.innerText = "Register"
            }
        }
    </script>
</body>
</html>