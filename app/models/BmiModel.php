<?php
class BmiModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function saveBmiRecord($user_id, $name, $weight, $height, $bmi, $status)
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

    public function getBmiHistory($user_id)
    {
        $query = "SELECT * FROM bmi_records WHERE user_id = :user_id ORDER BY timestamp DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllBmiRecords()
    {
        $query = "SELECT * FROM bmi_records ORDER BY timestamp DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteBmiRecord($bmi_id)
    {
        $query = "DELETE FROM bmi_records WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $bmi_id]);
    }

    public function updateBmiRecord($id, $name, $weight, $height, $bmi, $status)
    {
        $query = "UPDATE bmi_records SET name = :name, weight = :weight, height = :height, bmi = :bmi, status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':name' => $name,
            ':weight' => $weight,
            ':height' => $height,
            ':bmi' => $bmi,
            ':status' => $status,
            ':id' => $id
        ]);
    }
}
