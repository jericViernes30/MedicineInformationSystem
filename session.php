<?php
    include ('database/db.php');

    if (isset($_SESSION['user_email'])) {
        // Retrieve the user's email from the session
        $email = $_SESSION['user_email'];
        // Prepare a SELECT statement to fetch the last name of the user by email
        $stmt = mysqli_prepare($con, "SELECT last_name, countryOfPractice FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);

        // Execute the statement
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Check if a user with the given email exists
        if (mysqli_stmt_num_rows($stmt) == 1) {
            // Bind the result variable
            mysqli_stmt_bind_result($stmt, $last_name, $region);
            mysqli_stmt_fetch($stmt);
        } else {
            // User with the given email does not exist
            echo "User with this email does not exist.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // User is not logged in, redirect to the login page
        header("Location: index.php");
    }