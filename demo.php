<?php
    session_start();
    include ('database/db.php');
    include ('session.php');

    $name = $first_name . ' ' . $last_name;

    $sql = "SELECT * FROM reserve WHERE name = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
?>

    <p class="mb-2">First Name: <?php echo $first_name ?></p>
    <p class="mb-2">Last Name: <?php echo $last_name ?></p>
    <p class="mb-2">Email: <?php echo $email ?></p>
    <p class="mb-6">Contact #: <?php echo $contact ?></p>
    <div class="w-full">
        <p class="font-semibold text-center mb-6">Currently Reserved Medicines</p>
        <div class="w-full flex bg-[#bebebe] px-2 font-medium">
            <p class="w-[17%] py-2">Ticket#</p>
            <p class="w-[10%] py-2">Qty</p>
            <p class="w-[21%] py-2">Medicine Name</p>
            <p class="w-[21%] py-2">Reservation Date</p>
            <p class="w-[21%] py-2">Reserved Until</p>
            <p class="w-[10%]"></p>
        </div>
        <?php
            while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="w-full flex py-2 border-b border-[#bebebe] px-2 text-gray-700">
            <p class="w-[17%]"><?php echo $row['ticket'] ?></p>
            <p class="w-[10%]"><?php echo $row['quantity'] ?></p>
            <p class="w-[21%]"><?php echo $row['medicine'] ?></p>
            <p class="w-[21%]"><?php echo $row['date_reserved'] ?></p>
            <p class="w-[21%]">
            <?php
                $date_reserved = $row['date_reserved'];

                // Parse the date string
                $date = date_create_from_format('m-d-Y', $date_reserved);

                if ($date === false) {
                    // Handle parsing failure
                    echo "Failed to parse the date string.<br>";
                    $errors = date_get_last_errors();
                    foreach ($errors['errors'] as $error) {
                        echo "Error: $error<br>";
                    }
                } else {
                    // Add 3 days to the date
                    $date->modify('+3 days');

                    // Format the modified date
                    $reserved_until = $date->format('m-d-y');
                    
                    echo $reserved_until;
                }
            ?>
            </p>
            <a href="remove.php?ticket=<?php echo $row['ticket'] ?>&quantity=<?php echo $row['quantity'] ?>&medicine=<?php echo $row['medicine'] ?>" class="w-[10%] text-center flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="red" width="12px" height="12px"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/></svg>
            </a>
        </div>
        <?php } ?>
    </div>
