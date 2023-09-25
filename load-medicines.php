<?php
include 'Database/db.php';
if(isset($_GET['buttonValue'])){
    $buttonValue = $_GET['buttonValue'];
    
    $sql = "SELECT * FROM medicines WHERE LEFT(name, 2) = '$buttonValue'";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query)>0){
            while($row = mysqli_fetch_assoc($query)){
                ?>
                <form action="drugs.php" method="GET">
                <button class="w-2/3 flex justify-between items-center border-b-2 py-2 px-1 hover:bg-slate-100">
                    <p><?php echo $row['name'] ?></p>
                    <p class="text-sm text-green-500">Generic</p>
                </button>
                <input type="hidden" name="medicine" value="<?php echo $row['name'] ?>">
                </form>
                <?php
            }
        } else {
            echo "No results found!";
        }
} else {
    echo "Button value not received.";
}
?>