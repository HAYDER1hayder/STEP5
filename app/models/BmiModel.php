<?php
class BmiModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function saveBmiRecord($user_id,$name, $weight, $height, $bmi, $status)
    {
        $query = "INSERT INTO bmi_records (user_id,name, weight, height, bmi, status, timestamp) 
                  VALUES ( :user_id,:name, :weight, :height, :bmi, :status, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':user_id' => $user_id,
            ':name' => $name,
            ':weight' => $weight,
            ':height' => $height,
            ':bmi' => $bmi,
            ':status' => $status
        ]);
        return true;
    }

    public function getBmiHistory($user_id) {
        $query = "SELECT * FROM bmi_records WHERE user_id = :user_id ORDER BY timestamp DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
