<?php
require_once '../classes/User.php';
require_once '../classes/Utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (User::find($email) === null) {
        $user = new User($name, $email, $password);
        $user->save();
        header('Location: login.php');
        exit();
    } else {
        echo 'Email already exists';
    }
} else {
    include '../templates/register.html';
}

