<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../config/database.php';

class AuthController
{


    public function login($username, $password)
    {
        $db = new Database();
        $conn = $db->getConnection();


        if ($conn === null) {
            echo "<div class='alert alert-danger'>An error occurred connecting to the database.</div>";
            return;
        }

        $userModel = new UserModel($conn);
        $user = $userModel->getUserByUserName($username);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'user') {
                    header('Location: ../public/index.php');
                } elseif ($user['role'] === 'admin') {
                    header('Location: ../admin/index.php');
                }

                exit;
            } else {
                echo "<div class='alert alert-danger'>Invalid credentials. Please try again.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>User not found!</div>";
        }
    }


    public function signupUser($username, $password)
    {
        $db = new Database();
        $conn = $db->getConnection();


        if ($conn === null) {
            echo "<div class='alert alert-danger'>An error occurred connecting to the database.</div>";
            return;
        }

        $userModel = new UserModel($conn);


        if ($userModel->getUserByUserName($username)) {
            echo "<div class='alert alert-danger'>User already exists. Please log in.</div>";
            return;
        }


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($userModel->createUser($username, $hashedPassword)) {
            echo "<div class='alert alert-success'>Account successfully created. You can now log in.</div>";
            header('Location: login.php');
        } else {
            echo "<div class='alert alert-danger'>An error occurred while creating the account.</div>";
        }
    }

    public function signupAdmin($username, $password)
    {
        $db = new Database();
        $conn = $db->getConnection();


        if ($conn === null) {
            echo "<div class='alert alert-danger'>An error occurred connecting to the database.</div>";
            return;
        }

        $userModel = new UserModel($conn);


        if ($userModel->getUserByUserName($username)) {
            echo "<div class='alert alert-danger'>User already exists. Please log in.</div>";
            return;
        }


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($userModel->createAdmin($username, $hashedPassword)) {
            echo "<div class='alert alert-success'>Account successfully created. You can now log in.</div>";
            header('Location: login.php');
        } else {
            echo "<div class='alert alert-danger'>An error occurred while creating the account.</div>";
        }
    }


    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function logoutAdmin()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit;
    }
}
