<?php
include ('database/db.php');

    if(isset($_GET['input'])){
        $input = $_GET['input'];

        $query = "SELECT name FROM manufacturer WHERE name LIKE '{$input}%'";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0) {
            ?>
                <div class="w-full absolute  bg-slate-100 max-h-[250px] overflow-auto rounded-sm">
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <form action="manufacturer.php" method="GET">
                        <button class="w-full pl-2 py-1 text-left hover:bg-blue-200">
                            <?php echo $row['name']?>
                            <input type="hidden" name="manufacturer" value="<?php echo $row['name'] ?>">
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