<?php
session_start();
if (isset($_SESSION['bmi_result'])) {
    $bmiResult = $_SESSION['bmi_result'];
    unset($_SESSION['bmi_result']);
} else {
    $bmiResult = null;
}

/*if (!isset($_SESSION["username"]) || $_SESSION["role"] !== 'user') {
    header('Location: index.php');
    exit();
}*/

require '../config/database.php';
require '../app/models/BmiModel.php';
require '../app/controllers/BmiController.php';

$db = new Database();
$connection = $db->getConnection();

if ($connection === null) {
    echo "An error occurred connecting to the database.";
    exit;
}

$model = new BmiModel($db);
$controller = new BmiController($model);
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION["username"]) || !isset($_SESSION["role"])) {
        $_SESSION['error_message'] = "Please log in first to calculate your BMI.";
        header("Location: index.php");
        exit();
    }

    if (isset($_POST['name'], $_POST['weight'], $_POST['height'])) {

        $result = $controller->calculateBmi($_SESSION['user_id'], $_POST['name'], $_POST['weight'], $_POST['height']);
        $_SESSION['bmi_result'] = $result;
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_message'] = "Please enter all required data correctly!";
        header("Location: index.php");
        exit();
    }
}

require '../app/views/bmi_form.php';
