<?php
include 'Model/MedicineModel.php';

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
        $conn = new mysqli("localhost", "root", "", "otcmedicineis");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
?>