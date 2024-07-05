<?php
require_once '../classes/User.php';
require_once '../classes/Auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (Auth::login($email, $password)) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo 'Invalid email or password';
    }
} else {
    include '../templates/login.html';
}
