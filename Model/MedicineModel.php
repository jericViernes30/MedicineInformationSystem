<?php
class MedicineModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getMedicineInfo($medicineName) {
        // Implement your database query here using prepared statements.
        // Return the result or false in case of an error.
    }
}
?>