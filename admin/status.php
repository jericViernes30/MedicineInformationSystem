<?php
    include('../database/db.php');
    if(isset($_POST['selectedStatus'])){
        $status = $_POST['selectedStatus'];
        
        $sql = "SELECT * FROM reserve WHERE status = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 's', $status);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($res)){

        ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                var button = document.getElementById('complete');
                var text = document.getElementById('status');
                let status = text.textContent.trim(); // Trim the text to remove leading/trailing whitespaces

                console.log("Status:", status); // Log the status to the console for debugging

                if (status === "Completed") {
                    button.disabled = true;
                    console.log("Button disabled"); // Log if the button is disabled
                }
            });
            </script>
            <div id="table" class="w-full flex py-2 border-b border-[#bebebe] px-2 hover:bg-[#ededed]">
                <p class="w-[7.5%]"><?php echo $row['ticket'] ?></p>
                <p class="w-[14%]"><?php echo $row['name'] ?></p>
                <p class="w-[14%]"><?php echo $row['medicine'] ?></p>
                <p class="w-[5%]"><?php echo $row['quantity'] ?></p>
                <p class="w-[8%]"><?php echo $row['date_reserved'] ?></p>
                <p class="w-[8%]">
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
                            $reserved_until = $date->format('m-d-Y');
                            
                            echo $reserved_until;
                        }
                    ?>
                </p>
                <p class="w-[10%]">
                    <?php
                        $picked_up = $row['date_picked_up'];
                        if($picked_up == NULL){
                            echo "Not yet";
                        } else{
                            echo $row['date_picked_up'];
                        }
                    ?>
                </p>
                <p class="w-[18.5%]"><?php echo $row['note'] ?></p>
                <p id="status" class="w-[10%]">
                    <?php
                        $status = $row['status'];
                        if($status == 'Unclaimed'){
                            echo '<span class="text-red-500">'. $status .'</span>';
                        } elseif ($status == 'Claimed'){
                            echo '<span class="text-green-500">'. $status .'</span>';
                        } elseif ($status == 'Expired'){
                            echo '<span class="text-blue-900">'. $status .'</span>';
                        }
                    ?>
                </p>
                <div class="w-[5%] text-xs">
                    <?php
                        if($status == 'Unclaimed'){
                            ?>
                            <form action="action.php" method="POST" class="w-full flex gap-2 justify-evenly">
                                <button name="cancel" class="w-1/2 flex items-center justify-center bg-red-500 rounded-md text-white py-1 hover:bg-red-600 transition duration-100 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width='14' height='14' fill='white'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                                </button>
                                <button id="complete" name="claim" class="w-1/2 flex items-center justify-center bg-emerald-500 rounded-md py-1 text-white hover:bg-emerald-600 transition duration-100 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width='14' height='14' fill='white'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                                </button>
                                <input type="hidden" name="ticket" value="<?php echo $row['ticket'] ?>">
                                <input type="hidden" name="quantity" value="<?php echo $row['quantity'] ?>">
                                <input type="hidden" name="medicine" value="<?php echo $row['medicine'] ?>">
                            </form>
                            <?php
                        }
                    ?>
                </div>
            </div>
        <?php }
    }

    if(isset($_POST['search'])){
        $search = $_POST['search'];
        
        $searchSql = "SELECT * FROM reserve WHERE name LIKE ? OR ticket LIKE ? OR medicine LIKE ?";
        $stmt1 = mysqli_prepare($con, $searchSql);
        $searchTerm = "%$search%";
        mysqli_stmt_bind_param($stmt1, 'sss', $searchTerm, $searchTerm, $searchTerm);
        mysqli_stmt_execute($stmt1);
        $res1 = mysqli_stmt_get_result($stmt1);

        while($row1 = mysqli_fetch_assoc($res1)){

            ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                    var button = document.getElementById('complete');
                    var text = document.getElementById('status');
                    let status = text.textContent.trim(); // Trim the text to remove leading/trailing whitespaces
    
                    console.log("Status:", status); // Log the status to the console for debugging
    
                    if (status === "Completed") {
                        button.disabled = true;
                        console.log("Button disabled"); // Log if the button is disabled
                    }
                });
                </script>
                <div id="table" class="w-full flex py-2 border-b border-[#bebebe] px-2 hover:bg-[#ededed]">
                    <p class="w-[7.5%]"><?php echo $row1['ticket'] ?></p>
                    <p class="w-[15%]"><?php echo $row1['name'] ?></p>
                    <p class="w-[15%]"><?php echo $row1['medicine'] ?></p>
                    <p class="w-[5%]"><?php echo $row1['quantity'] ?></p>
                    <p class="w-[10%]"><?php echo $row1['date_reserved'] ?></p>
                    <p class="w-[10%]">
                        <?php
                            $date_reserved = $row1['date_reserved'];
    
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
                                $reserved_until = $date->format('m-d-Y');
                                
                                echo $reserved_until;
                            }
                        ?>
                    </p>
                    <p class="w-[22.5%]"><?php echo $row1['note'] ?></p>
                    <p id="status" class="w-[10%]">
                        <?php
                            $status = $row1['status'];
                            if($status == 'Unclaimed'){
                                echo '<span class="text-red-500">Pending</span>';
                            } elseif ($status == 'Claimed'){
                                echo '<span class="text-green-500">Completed</span>';
                            }
                        ?>
                    </p>
                    <div class="w-[5%] text-xs">
                        <?php
                            if($status == 'Unclaimed'){
                                ?>
                                <form action="status.php" method="POST" class="w-full flex gap-2 justify-evenly">
                                    <button name="reject" class="w-1/2 flex items-center justify-center bg-red-500 rounded-md text-white py-1 hover:bg-red-600 transition duration-100 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width='14' height='14' fill='white'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                                    </button>
                                    <button id="complete" name="completed" class="w-1/2 flex items-center justify-center bg-emerald-500 rounded-md py-1 text-white hover:bg-emerald-600 transition duration-100 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width='14' height='14' fill='white'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                                    </button>
                                    <input type="hidden" name="ticket" value="<?php echo $row['ticket'] ?>">
                                    <input type="hidden" name="quantity" value="<?php echo $row['quantity'] ?>">
                                    <input type="hidden" name="medicine" value="<?php echo $row['medicine'] ?>">
                                </form>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            <?php }
    }
?>