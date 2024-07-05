<?php
require_once '../classes/Feedback.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $message = $_POST['message'];

    $feedback = new Feedback($userId,$message);
    $feedback->save();

    header('Location: feedback-success.php');
    exit();
} else {
    include '../templates/feedback.html';
}
