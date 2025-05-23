<?php
class BmiController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function calculateBmi($user_id, $name, $weight, $height)
    {
        if ($height <= 0 || $weight <= 0) {
            return ["error" => "Height and weight must be greater than zero"];
        }

        $bmi = $weight / ($height * $height);

        if ($bmi < 18.5) {
            $status = "Underweight";
        } elseif ($bmi < 25) {
            $status = "Normal weight";
        } elseif ($bmi < 30) {
            $status = "Overweight";
        } else {
            $status = "Obesity";
        }

        $saved = $this->model->saveBmiRecord($user_id, $name, $weight, $height, $bmi, $status);

        if ($saved) {
            $_SESSION['bmi_result'] = [
                "name" => $name,
                "weight" => $weight,
                "height" => $height,
                "bmi" => round($bmi, 2),
                "status" => $status
            ];

            return $_SESSION['bmi_result'];
        } else {
            return ["error" => "An error occurred while saving data"];
        }
    }

    public function getUserBmiHistory($user_id)
    {
        return $this->model->getBmiHistory($user_id);
    }

    public function getAllBmiRecords()
    {
        return $this->model->getAllBmiRecords();
    }

    public function deleteBmiRecord($bmi_id)
    {
        return $this->model->deleteBmiRecord($bmi_id);
    }

    public function editBmiRecord($id, $name, $weight, $height)
    {
        if ($height <= 0 || $weight <= 0) {
            return ["error" => "Height and weight must be greater than zero"];
        }

        $bmi = $weight / ($height * $height);

        if ($bmi < 18.5) {
            $status = "Underweight";
        } elseif ($bmi < 25) {
            $status = "Normal weight";
        } elseif ($bmi < 30) {
            $status = "Overweight";
        } else {
            $status = "Obesity";
        }

        $updated = $this->model->updateBmiRecord($id, $name, $weight, $height, $bmi, $status);

        if ($updated) {
            return ["success" => "Record updated successfully"];
        } else {
            return ["error" => "Failed to update record"];
        }
    }

    public function getBmiCategoryDistribution()
    {
        $records = $this->model->getAllBmiRecords();

        $categories = [
            'Underweight' => 0,
            'Normal weight' => 0,
            'Overweight' => 0,
            'Obesity' => 0,
        ];

        foreach ($records as $record) {
            $status = $record['status'];
            if (isset($categories[$status])) {
                $categories[$status]++;
            }
        }

        return $categories;
    }
}
