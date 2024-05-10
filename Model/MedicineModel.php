<?php
class MedicineModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getMedicineByName($name) {
        $query = "SELECT * FROM medicines WHERE generic_name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>