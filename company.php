<?php
    include ('database/db.php');

    if(isset($_GET['selected'])){
        $manufacturer = $_GET['manufacturer'];

        $sql = "SELECT * FROM medicines WHERE manufcaturer = '$manufacturer'";
        $result = mysqli_query($con, $sql);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        while($row = mysqli_fetch_assoc($result)){
    ?>
        <p><?php echo $row['name'];?></p>
    <?php } ?>
</body>
</html>