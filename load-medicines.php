<?php
include 'Database/db.php';
if(isset($_GET['buttonValue'])){
    $buttonValue = $_GET['buttonValue'];
    $key = $_GET['key'];
    
    if($buttonValue == 'All'){
        $sql = "SELECT generic_name, type, stocks from medicines WHERE generic_name LIKE '$key%';";
        $query = mysqli_query($con, $sql);

        while($row = mysqli_fetch_assoc($query)){
            ?>
            <form action="drugs.php" method="GET">
            <button class="w-full flex justify-between items-center border-b-2 py-2 px-1 hover:bg-slate-100">
                <p><?php echo $row['generic_name'] ?></p>
                <div class="flex gap-2 items-center">
                    <p class="text-sm text-green-500"><?php echo $row['type']; ?></p>
                    <p>
                        <?php 
                            $stocks = $row['stocks'];
                            if($stocks != 0){
                                echo "<p class='text-green-500 text-sm'>Available</p>";
                            } else {
                                echo "<p class='text-red-500 text-sm'>Unavailable</p>";
                            }
                        ?>
                    </p>
                </div>
                
            </button>
            <input type="hidden" name="medicine" value="<?php echo $row['generic_name'] ?>">
            </form>
            <?php
        }
    } else {
        $sql = "SELECT generic_name, type, stocks from medicines WHERE type LIKE '$buttonValue%' AND generic_name LIKE '$key%';";
        $query = mysqli_query($con, $sql);

        while($row = mysqli_fetch_assoc($query)){
            ?>
            <form action="drugs.php" method="GET">
            <button class="w-full flex justify-between items-center border-b-2 py-2 px-1 hover:bg-slate-100">
                <p><?php echo $row['generic_name'] ?></p>
                <div class="flex gap-2 items-center">
                    <p class="text-sm text-green-500"><?php echo $row['type']; ?></p>
                    <p>
                        <?php 
                            $stocks = $row['stocks'];
                            if($stocks != 0){
                                echo "<p class='text-green-500 text-sm'>Available</p>";
                            } else {
                                echo "<p class='text-red-500 text-sm'>Unavailable</p>";
                            }
                        ?>
                    </p>
                </div>
                
            </button>
            <input type="hidden" name="medicine" value="<?php echo $row['generic_name'] ?>">
            </form>
            <?php
        }
    }
    
} else {
    echo "Button value not received.";
}
?>