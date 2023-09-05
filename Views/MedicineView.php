<?php
class MedicineView {
    private $medName;
    private $genericName;

    public function displayMedicine($medicine) {
        
        if ($medicine) {
            $this->medName = $medicine['name'];
            $this->genericName = $medicine['generic_name'];
        
        } else {
            echo "Medicine not found.";
        }
    }

    public function getMedName() {
        return $this->medName;
    }

    public function getGenericName(){
        return $this->genericName;
    }
}
?>