<?php
class MedicineView {
    private $medName;
    private $genericName;
    private $manufacturer;
    private $distributor;
    private $category;
    private $contents;
    private $description;
    private $indications;
    private $dosage;
    private $overdosage;
    private $contraindications;
    private $specialprecautions;
    private $adverseprecautions;
    private $druginteractions;
    private $storage;
    private $classification;
    private $regulatoryclassification;

    public function displayMedicine($medicine) {
        
        if ($medicine) {
            $this->medName = $medicine['name'];
            $this->genericName = $medicine['generic_name'];
            $this->manufacturer = $medicine['manufcaturer'];
            $this->distributor = $medicine['distributor'];
            $this->category = $medicine['category'];
            $this->contents = $medicine['contents'];
            $this->description = $medicine['description'];
            $this->indications = $medicine['indications'];
            $this->dosage = $medicine['dosage'];
            $this->overdosage = $medicine['overdosage'];
            $this->contraindications = $medicine['contraindications'];
            $this->specialprecautions = $medicine['special_precautions'];
            $this->adverseprecautions = $medicine['adverse_reactions'];
            $this->druginteractions = $medicine['drug_interactions'];
            $this->storage = $medicine['storage'];
            $this->classification = $medicine['classification'];
            $this->regulatoryclassification = $medicine['regulatory_classification'];
        
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

    public function getManufacturer(){
        return $this->manufacturer;
    }

    public function getDistributor(){
        return $this->distributor;
    }

    public function getCategory(){
        return $this->category;
    }

    public function getContents(){
        return $this->contents;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getIndications(){
        return $this->indications;
    }

    public function getDosage(){
        return $this->dosage;
    }

    public function getOverdosage(){
        return $this->overdosage;
    }

    public function getContraindications(){
        return $this->contraindications;
    }

    public function getSpecialPrecautions(){
        return $this->specialprecautions;
    }

    public function getAdversePrecautions(){
        return $this->adverseprecautions;
    }

    public function getDrugInteractions(){
        return $this->druginteractions;
    }

    public function getStorage(){
        return $this->storage;
    }

    public function getClassification(){
        return $this->classification;
    }

    public function getRegulatoryClassification(){
        return $this->regulatoryclassification;
    }
}
?>