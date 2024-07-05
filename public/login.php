<?php
require_once '../classes/User.php';
require_once '../classes/Auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (Auth::login($username, $password)) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo 'Invalid username or password';
    }
} else {
    include '../templates/login.html';
}
