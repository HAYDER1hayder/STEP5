<?php
session_start();
require '../../app/config/database.php';
require '../../app/models/BmiModel.php';
require '../../app/controllers/BmiController.php';



if (isset($_GET['id'])) {
    $db = new Database();
    $model = new BmiModel($db);
    $controller = new BmiController($model);

    $bmi_id = $_GET['id'];

    $deleted = $controller->deleteBmiRecord($bmi_id);

    if ($deleted) {
        $_SESSION['message'] = "Record deleted successfully";
    } else {
        $_SESSION['message'] = "Failed to delete the record";
    }

    header('Location: index.php');
    exit();
} else {
    header('Location: index.php');
    exit();
}


