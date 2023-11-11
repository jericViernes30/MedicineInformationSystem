<?php
    session_start();
    include ('database/db.php');
    include ('session.php');
    // if (isset($_SESSION['user_email'])) {
    //     // Retrieve the user's email from the session
    //     $email = $_SESSION['user_email'];
    //     // Prepare a SELECT statement to fetch the last name of the user by email
    //     $stmt = mysqli_prepare($con, "SELECT last_name, countryOfPractice FROM users WHERE email = ?");
    //     mysqli_stmt_bind_param($stmt, "s", $email);

    //     // Execute the statement
    //     mysqli_stmt_execute($stmt);
    //     mysqli_stmt_store_result($stmt);

    //     // Check if a user with the given email exists
    //     if (mysqli_stmt_num_rows($stmt) == 1) {
    //         // Bind the result variable
    //         mysqli_stmt_bind_result($stmt, $last_name, $region);
    //         mysqli_stmt_fetch($stmt);
    //     } else {
    //         // User with the given email does not exist
    //         echo "User with this email does not exist.";
    //     }

    //     // Close the statement and the connection
    //     mysqli_stmt_close($stmt);
    //     mysqli_close($con);
    // } else {
    //     // User is not logged in, redirect to the login page
    //     header("Location: index.php");
    //     exit;
    // }
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
    <title>Find Drugs | MediGuide</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
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
    <div class="w-full bg-slate-700 mb-5">
        <div class="container w-2/3 mx-auto flex justify-center gap-12 text-slate-50 py-2">
            <div><button onclick="window.location.href='home.php'" class="hover:text-blue-500 ease-out duration-200">Home</button></div>
            <div><button onclick="window.location.href='find-drugs.php'" class="hover:text-blue-500 ease-out duration-200">Find Drugs</button></div>
            <div><button onclick="window.location.href='find-company.php'" class="hover:text-blue-500 ease-out duration-200">Find Drug Company</button></div>
        </div>
    </div>
    <div class="w-4/6 mx-auto flex gap-4">
        <div class="w-2/4">
            <p class="font-semibold py-1 border-b border-black mb-5">Over-the-counter Related Medical News</p>
            <div class="w-full flex gap-2">
                <div class="w-2/4">
                    <div>
                        <img src="img/news-1.jpg" alt="" class="mb-2">
                        <a target="_blank" rel="noopener" href="https://www.pna.gov.ph/articles/1168825?fbclid=IwAR2VjZyRtCcDb_ZcQQiHO7Ph8sL8uV-UiJz74JSWyzX_AGVc6QygCvn-Coc" class="hover:text-blue-500"><p class="font-semibold mb-1">Allow sari-sari stores to sell over-the-counter meds: Senate bet</p></a>
                        <p class="mb-1 text-xs text-gray-500">March 2, 2022</p>
                        <p class="text-sm text-justify mb-4">“Hindi dapat ipagbawal ang mga sari-sari store na magbenta ng mga OTC na gamot (Sari-sari stores should not be prevented from selling OTC medicines),” Padilla said during a campaign sortie in Lucen...</p>
                    </div>
                    <hr>
                    <div class="mt-4 mb-4 flex gap-2">
                        <img src="img/news-2.jpg" alt="" width="100" style="height: 70px;">
                        <div>
                            <a target="_blank" rel="noopener"  href="https://www.usnews.com/news/health-news/articles/2023-07-13/fda-approves-first-over-the-counter-birth-control-pill?fbclid=IwAR2njC-BcuyKt7yZMgHxn32wC9B468k1qV_C9LrZSPMVR6QTHOCYUyZmPDo" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">FDA Approves First Over-the-Counter Birth Control Pill</p></a>
                            <p class="text-xs text-gray-500">July 13, 2023</p>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4 mb-4 flex gap-2">
                        <img src="img/news-3.jpg" alt="" width="100" style="height: 70px;">
                        <div>
                            <a target="_blank" rel="noopener" href="https://www.nbcnews.com/health/health-news/fda-panel-says-common-counter-decongestant-phneylephrine-doesnt-work-rcna104424" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">FDA panel says common over-the-counter decongestant doesn’t work</p></a>
                            <p class="text-xs text-gray-500">Sept. 12, 2023</p>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4 mb-4 flex gap-2">
                        <img src="img/news-4.jpg" alt="" width="100" style="height: 70px;">
                        <div>
                            <a target="_blank" rel="noopener" href="https://abcnews.go.com/Health/childrens-counter-medicine-shortages-parts-us/story?id=95600427" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">Why we're seeing shortages of children's over-the-counter medicine</p></a>
                            <p class="text-xs text-gray-500">December 21, 2022</p>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4 mb-4 flex gap-2">
                        <img src="img/news-5.jpg" alt="" width="100" style="height: 70px;">
                        <div>
                            <a target="_blank" rel="noopener" href="https://www.today.com/health/best-over-counter-medications-us-news-world-report-t221113" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">US News and World Report announces best over-the-counter medications</p></a>
                            <p class="text-xs text-gray-500">June 8, 2021</p>
                        </div>
                    </div>
                </div>
                <div class="w-2/4">
                    <div class="mb-4 flex gap-2">
                        <img src="img/news-6.jpg" alt="" width="100" style="height: 70px;">
                        <div>
                            <a target="_blank" rel="noopener" href="https://www.politico.com/newsletters/prescription-pulse/2023/09/15/consumers-head-to-court-on-otc-cold-pills-00116150?fbclid=IwAR0xEGXUe6ZQ7oIXfUTR-MQfdg96JpW4cTKvxzfEDsgmrPgdut87E43fwto" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">Consumers head to court on OTC cold pills</p></a>
                            <p class="text-xs text-gray-500">September 15, 2023</p>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4 mb-4 flex gap-2">
                        <img src="img/news-7.jpg" alt=""width="100" style="height: 70px;">
                        <div>
                            <a target="_blank" rel="noopener" href="https://pharmanewsintel.com/features/how-a-prescription-drug-becomes-available-over-the-counter?fbclid=IwAR0aDGhg7RuQh1QvNO5yFBX11I6EQwpelzNSJ0IyMWMn1wPlz-zi_YN6bcA" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">How A Prescription Drug Becomes Available Over the Counter</p></a>
                            <p class="text-xs text-gray-500">September 27, 2022 </p>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4 mb-4 flex gap-2">
                        <img src="img/news-8.jpg" alt=""width="100" style="height: 70px;">
                        <div>
                            <a target="_blank" rel="noopener" href="https://www.wbtv.com/2022/01/31/over-the-counter-medicine-high-demand/" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">Over-the-counter medicine in high demand</p></a>
                            <p class="text-xs text-gray-500">Jan. 31, 2022</p>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4 mb-4 flex gap-2">
                        <img src="img/news-9.jpg" alt="" width="100" style="height: 70px;">
                        <div>
                            <a target="_blank" rel="noopener" href="https://nielseniq.com/global/en/insights/analysis/2023/decoding-otc-medicines-in-the-philippines/?fbclid=IwAR1Nhh-jIo_4yvd7llYMlk3IRSCUxacggegTbifeuSRZguYYnyRw2iqdAE8" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">Decoding OTC medicines in the Philippines</p></a>
                            <p class="text-xs text-gray-500">October 20, 2023</p>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4 mb-4 flex gap-2">
                        <img src="img/news-10.jpg" alt="" width="100" style="height: 70px;">
                        <div>
                            <a target="_blank" rel="noopener" href="https://www.philstar.com/headlines/2022/01/11/2153203/government-limits-purchases-fever-and-flu-meds-retailers-run-out-stock" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">Government limits purchases of fever and flu meds as retailers run out of stock</p></a>
                            <p class="text-xs text-gray-500">January 11, 2022</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-2/4">
            <div>
                <p class="font-semibold py-1 border-b border-black mb-5">Special Reports</p>
                <div>
                    <img src="img/news-11.jpg" alt="" class="mb-2">
                    <a target="_blank" rel="noopener" href="https://www.gmanetwork.com/news/topstories/nation/822282/stores-may-apply-for-authorization-to-sell-otc-medicines-ano/story/" class="hover:text-blue-500"><p class="font-semibold mb-1">Stores may apply for authorization to sell OTC medicines</p></a>
                    <p class="mb-1 text-xs text-gray-500">February 18, 2022</p>
                    <p class="text-sm text-justify mb-4">“Hindi dapat ipagbawal ang mga sari-sari store na magbenta ng mga OTC na gamot (Sari-sari stores should not be prevented from selling OTC medicines),” Padilla said during a campaign sortie in Lucen...</p>
                </div>
                <hr>
                <div class="flex gap-2">
                    <div class="w-2/4">
                        <div class="mt-4 mb-4 flex gap-2">
                            <img src="img/news-12.jpg" alt="" width="100" style="height: 70px;">
                            <div>
                                <a target="_blank" rel="noopener" href="https://www.openaccessgovernment.org/article/investigating-otc-drugs-counter-drugs-toxic-danger/161693/?fbclid=IwAR0rED4bYmFimIUrZgHBd_GJ156AKfJPBtaEFhNLshokJxgWUsjZiukHqHg" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">Investigating OTC drugs: Are over-the-counter drugs an under-appreciated toxic danger?</p></a>
                                <p class="text-xs text-gray-500">June 23, 2023</p>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-4 mb-4 flex gap-2">
                            <img src="img/news-13.jpg" alt="" width="100" style="height: 70px;">
                            <div>
                                <a target="_blank" rel="noopener" href="https://www.thestreet.com/retailers/these-popular-medicines-might-be-pulled-from-shelves-for-a-very-strange-reason?fbclid=IwAR25-bdMBFnFxeiXcShlubBeV37VyPGizdZo2wueDE-AXE4oib_25JJ-zuc" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">These popular medicines might be pulled from shelves for a very strange reason</p></a>
                                <p class="text-xs text-gray-500">September 12, 2023</p>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-4 mb-4 flex gap-2">
                            <img src="img/news-14.jpg" alt="" width="100" style="height: 70px;">
                            <div>
                                <a target="_blank" rel="noopener" href="https://news.abs-cbn.com/news/01/04/22/extraordinary-demand-for-otc-drugs-observed-shortage-may-be-artificial" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">'Extraordinary demand' for OTC drugs observed; 'shortage' may be artificial</p></a>
                                <p class="text-xs text-gray-500">January 4, 2022</p>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-4 mb-4 flex gap-2">
                            <img src="img/news-15.jpg" alt="" width="100" style="height: 70px;">
                            <div>
                                <a target="_blank" rel="noopener" href="https://www.onenews.ph/articles/lgus-ordered-stop-medicine-sale-in-sari-sari-stores?fbclid=IwAR3rR7-MRldRkh_wzRoUQ-4xY4EcpcDgEiaUPx90DCZXWbZEze1i-ad3rzI" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">LGUs Ordered: Stop Medicine Sale In Sari-Sari Stores</p></a>
                                <p class="text-xs text-gray-500">October 22, 2023</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-2/4">
                        <div class="mt-4 mb-4 flex gap-2">
                            <img src="img/news-16.jpg" alt="" width="100" style="height: 70px;">
                            <div>
                                <a target="_blank" rel="noopener" href="https://www.bbc.com/news/world-asia-india-63226055" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">Cough syrup deaths: Why drugs made in India are sparking safety concerns</p></a>
                                <p class="text-xs text-gray-500">October 17, 2022</p>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-4 mb-4 flex gap-2">
                            <img src="img/news-17.jpeg" alt="" width="100" style="height: 70px;">
                            <div>
                                <a target="_blank" rel="noopener" href="https://focusonbusiness.eu/en/news/global-over-the-counter-otc-drugs-market-to-grow-by-6-yoy-and-hit-120-8b-value-in-2021/4025?fbclid=IwAR2tNWb9zMA2IT5IyjUg8j8aHl7aSfHsyES2pviINgPCwKzo1sGous1f3aE" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">Global Over-the-Counter (OTC) Drugs Market to Grow by 6%YoY and Hit $120.8B Value in 2021</p></a>
                                <p class="text-xs text-gray-500">January 13, 2021</p>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-4 mb-4 flex gap-2">
                            <img src="img/news-18.jpg" alt="" width="100" style="height: 70px;">
                            <div>
                                <a target="_blank" rel="noopener" href="https://news.harvard.edu/gazette/story/2023/09/why-are-ineffective-oral-decongestants-still-on-store-shelves/?fbclid=IwAR1i2_DxuEg0qJsUitt7edgXECLYw_CqZJpVpNu35ItES8PBHAdkCzBrXR4" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">Why are ineffective oral decongestants still on store shelves?</p></a>
                                <p class="text-xs text-gray-500">September 20, 2023</p>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-4 mb-4 flex gap-2">
                            <img src="img/news-19.jpg" alt="" width="100" style="height: 70px;">
                            <div>
                                <a target="_blank" rel="noopener" href="https://www.bloomberg.com/news/features/2023-07-17/eyedrop-recall-2023-and-infections-were-result-of-lack-of-fda-regulation?fbclid=IwAR25-bdMBFnFxeiXcShlubBeV37VyPGizdZo2wueDE-AXE4oib_25JJ-zuc" class="hover:text-blue-500"><p class="text-sm font-semibold text-justify">No Testing, No Inspections: Contaminated Eyedrops Blinded and Killed Americans</p></a>
                                <p class="text-xs text-gray-500">July 18, 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        include 'footer.php';
    ?>
</body>
</html>