<?php
session_start();


if (!isset($_SESSION["username"]) || $_SESSION["role"] !== 'admin') {
    header("Location: login.php");
    exit();
}


require '../../config/database.php';
require '../../app/models/BmiModel.php';
require '../../app/controllers/BmiController.php';


$db = new Database();
$connection = $db->getConnection();

if ($connection === null) {
    die("An error occurred while connecting to the database.");
}

$model = new BmiModel($db);
$controller = new BmiController($model);

$distribution = $controller->getBmiCategoryDistribution();
$labels = json_encode(array_keys($distribution));
$data = json_encode(array_values($distribution));
if (!empty($distribution)) {
    require '../../app/views/bmi_Admin_result.php';
} else {
    echo "There are no records for it.";
}
