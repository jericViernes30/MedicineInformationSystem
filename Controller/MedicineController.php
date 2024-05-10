<?php
include(__DIR__ . '/../Model/MedicineModel.php');

class MedicineController {
    private $model;

    public function __construct() {
        $this->model = new MedicineModel($this->getDbConnection());
    }

    public function getMedicineByName($name) {
        $medicine = $this->model->getMedicineByName($name);
        return $medicine;
    }

    private function getDbConnection() {
        $conn = new mysqli("localhost", "root", "", "medicine_information_system");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
?>