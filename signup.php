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
    <title>Document</title>
    <style>
        p{
            font-family: 'Poppins', sans-serif;
        }

        input, select {
            border: 1px solid #808588
        }

        .captcha{
            font-size: xx-small;
        }
    </style>
</head>
<body>
    <div class="w-3/4 mx-auto">
        <div class="flex items-center p-1">
            <p class=" text-red-500 text-logo text-lg font-semibold">MEDIGUIDE</p>
            <img src="img/logo.png" width="70" height="70" alt="">
        </div>
        <div class="flex gap-6">
            <div class="w-9/12">
                <p class="text-lg font-semibold mb-6">Sign up for a free MediGuide account today</p>
                <p class="text-sm mb-4">Get unlimited access to locally-approved drug information, medical news and disease treament guidelines on the go!</p>
                <form action="">
                    <div class="flex justify-between gap-4 mb-5">
                        <div class="w-1/3 flex flex-col gap-2">
                            <label for=""><span class="text-red-500">*</span> Title</label>
                            <select name="title" id="" class="py-1 px-2">
                                <option value="" disabled selected>Select your Title</option>
                                <option value="">Professor</option>
                                <option value="">Doctor</option>
                                <option value="">Student</option>
                                <option value="">Mister</option>
                                <option value="">Miss</option>
                            </select>
                        </div>
                        <div class="w-1/3 flex flex-col gap-2">
                            <label for=""><span class="text-red-500">*</span> First Name</label>
                            <input type="text" name="first_name" required class="py-1 px-2">
                        </div>
                        <div class="w-1/3 flex flex-col gap-2">
                            <label for=""><span class="text-red-500">*</span> Last Name</label>
                            <input type="text" name="last_name" required class="py-1 px-2">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="" class="mb-2"><span class="text-red-500">*</span> Email Address</label>
                        <input type="email" name="email" required class="w-full py-1 px-2">
                    </div>
                    <div class="mb-5">
                        <label for="" class="mb-2"><span class="text-red-500">*</span> Password</label>
                        <input type="password" name="password" required placeholder="******" class="w-full py-1 px-2">
                    </div>
                    <div class="mb-5">
                        <label for="" class="mb-2"><span class="text-red-500">*</span> Country of Practice</label>
                        <input type="email" name="email" required class="w-full py-1 px-2">
                    </div>
                    <div class="mb-3">
                        <label for="" class="mb-2"><span class="text-red-500">*</span> Profession</label>
                        <input type="email" name="email" required class="w-full py-1 px-2">
                    </div>
                    <hr>
                    <div class="mt-3 flex items-center gap-2 mb-4">
                        <input type="checkbox" name="agree">
                        <label for="" class="text-sm">I agree to the <span class="text-blue-500">Terms</span> and <span class="text-blue-500">Privacy Policy</span> and I voluntarily consent to the processing of my personal data as set forth in the Privacy Policy</label>
                    </div>
                    <div class="border-2 bg-slate-100 w-1/3 flex items-center justify-evenly px-2 py-1 gap-3 mb-16">
                        <div class="flex gap-3 items-center">
                            <input type="checkbox" class="transform scale-150">
                            <label for="" class="text-sm">I'm not a robot</label>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <img src="img/captcha.png" width="30" height="30" alt="">
                            <p class="captcha">reCAPTCHA</p>
                            <p class="captcha">Privacy - Terms</p>
                        </div>
                    </div>
                    <button class="w-1/3 py-2 font-semibold bg-red-500 text-white rounded-md">Create My Account</button>
                </form>
            </div>
            <div class="w-1/4 flex flex-col">
                <img src="img/signup_promotion_widget_1_image.png" width="200" height="200" alt="" class="mx-auto">
                <p class="text-sm font-semibold text-left mb-2">Find answers at the point-of-care</p>
                <p class="text-sm mb-3">Access trusted clinical information and search a comprehensive drug and disease management database to enhance daily workflows and improve patient outcomes.</p>
                <img src="img/signup_promotion_widget_2_image.png" width="200" height="200" alt="" class="mx-auto">
                <p class="text-sm font-semibold text-left mb-2">Gain medical knowledge</p>
                <p class="text-sm mb-3">Read the latest news available across various specialties and fulfil CME requirements by keeping current with changes in medicine.</p>
                <img src="img/signup_promotion_widget_3_image.png" width="200" height="200" alt="" class="mx-auto">
                <p class="text-sm font-semibold text-left mb-2">Enjoy seamless access</p>
                <p class="text-sm mb-5">One free account gives you easy and convenient cross-platform access, wherever and whenever.</p>
            </div>
        </div>
    </div>
</body>
</html>