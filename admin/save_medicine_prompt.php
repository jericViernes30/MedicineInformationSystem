<?php
    include '../database/db.php';
    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $generic_name = $_POST['generic_name'];
        $manufacturer = $_POST['manufacturer'];
        $distributor = $_POST['distributor'];
        $description = $_POST['description'];
        $indications = $_POST['indications'];
        $dosage = $_POST['dosage'];
        $contraindications = $_POST['contraindications'];
        $special_precautions = $_POST['special_precautions'];
        $adverse_reactions = $_POST['adverse_reactions'];
        $drug_interactions = $_POST['drug_interactions'];
        $classification = $_POST['classification'];
        $stocks = $_POST['stocks'];
        $visible = $_POST['visible'];

        // Sanitize the inputs to prevent SQL injection
    $generic_name = mysqli_real_escape_string($con, $generic_name);
    $manufacturer = mysqli_real_escape_string($con, $manufacturer);
    $distributor = mysqli_real_escape_string($con, $distributor);
    $description = mysqli_real_escape_string($con, $description);
    $indications = mysqli_real_escape_string($con, $indications);
    $dosage = mysqli_real_escape_string($con, $dosage);
    $contraindications = mysqli_real_escape_string($con, $contraindications);
    $special_precautions = mysqli_real_escape_string($con, $special_precautions);
    $adverse_reactions = mysqli_real_escape_string($con, $adverse_reactions);
    $drug_interactions = mysqli_real_escape_string($con, $drug_interactions);
    $classification = mysqli_real_escape_string($con, $classification);
    $name = mysqli_real_escape_string($con, $name);

    $sql = "UPDATE medicines SET name = '$name', generic_name = '$generic_name', manufcaturer = '$manufacturer', distributor = '$distributor', description = '$description', indications = '$indications', dosage = '$dosage', contraindications = '$contraindications', special_precautions = '$special_precautions', adverse_reactions = '$adverse_reactions', drug_interactions = '$drug_interactions', classification = '$classification', stocks = $stocks, visible = '$visible' WHERE generic_name = '$generic_name'";


    if (mysqli_query($con, $sql)){
        echo "Record updated successfully";
        header('location: edit_medicine.php?medicine='.$generic_name);
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
    ?>