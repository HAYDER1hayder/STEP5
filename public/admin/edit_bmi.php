<?php
session_start();

require '../../app/config/database.php';
require '../../app/models/BmiModel.php';
require '../../app/controllers/BmiController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];

    if (empty($id) || empty($name) || empty($weight) || empty($height)) {
        $_SESSION['message'] = 'All fields are required.';
        header('Location: index.php');
        exit;
    }

    $db = new Database();
    $model = new BmiModel($db);
    $controller = new BmiController($model);

    $result = $controller->editBmiRecord($id, $name, $weight, $height);

    if (isset($result['success'])) {
        $_SESSION['message'] = $result['success'];
    } else {
        $_SESSION['message'] = $result['error'];
    }

    header('Location: index.php');
    exit;
} else {
    $_SESSION['message'] = 'Invalid request.';
    header('Location: index.php');
    exit;
}
