<?php
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["role"] !== 'user') {
    header("Location: index.php");
    exit();
}

require '../app/config/database.php';
require '../app/models/BmiModel.php';
require '../app/controllers/BmiController.php';

$db = new Database();
$connection = $db->getConnection();

if ($connection === null) {
    die("An error occurred while connecting to the database.");
}

$user_id = $_SESSION['user_id'];
$model = new BmiModel($db);
$controller = new BmiController($model);
$bmiHistory = $controller->getUserBmiHistory($user_id);

$dates = [];
$bmiValues = [];

foreach ($bmiHistory as $record) {
    $dates[] = $record['timestamp'];
    $bmiValues[] = $record['bmi'];
}

$datesJson = json_encode($dates);
$bmiValuesJson = json_encode($bmiValues);


require '../app/views/bmi_result.php';
