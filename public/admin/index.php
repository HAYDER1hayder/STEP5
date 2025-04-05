<?php
session_start();

require '../../app/config/database.php';
require '../../app/models/BmiModel.php';
require '../../app/controllers/BmiController.php';

$db = new Database();
$model = new BmiModel($db);
$controller = new BmiController($model);

$records = $controller->getAllBmiRecords();

if (!isset($_SESSION["username"]) || !isset($_SESSION["role"])) {
    $_SESSION['error_message'] = "Please log in first to calculate your BMI.";
    header("Location: login.php");
    exit();
}
require '../../app/views/admin_dashboard.php';
?>
