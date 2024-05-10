<?php
include ('database/db.php');

    if(isset($_GET['input'])){
        $input = $_GET['input'];

        $query = "SELECT generic_name FROM medicines WHERE generic_name LIKE '{$input}%'";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0) {
            ?>
                <div class="w-full absolute  bg-slate-100 max-h-[250px] overflow-auto rounded-sm">
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <form action="edit_medicine.php" method="GET">
                        <button class="w-full px-2 py-1 text-left hover:bg-green-500 hover:text-white">
                            <?php echo $row['generic_name']?>
                            <input type="hidden" name="medicine" value="<?php echo $row['generic_name'] ?>">
                        </button>
                    </form>
                    <?php
                    }
                    ?>
                </div>
            <?php
        } else {
            echo 'No data found';
        }
    }
?>