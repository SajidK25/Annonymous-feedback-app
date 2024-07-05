<?php
require_once '../classes/User.php';
require_once '../classes/Utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (User::find($username) === null) {
        $user = new User($username, $password);
        $user->save();
        header('Location: login.php');
        exit();
    } else {
        echo 'Username already exists';
    }
} else {
    include '../templates/register.html';
}

