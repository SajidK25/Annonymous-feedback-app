<?php
require_once '../classes/Feedback.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $name = $_POST['name'];
    $message = $_POST['message'];

    $feedback = new Feedback($userId, $name, $message);
    $feedback->save();

    header('Location: feedback-success.html');
    exit();
} else {
    include '../templates/feedback.html';
}
