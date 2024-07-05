<?php
require_once '../classes/Auth.php';
require_once '../classes/Feedback.php';
require_once '../classes/Utils.php';

if (!Auth::isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$userId = Auth::getUserId();
$feedback = Feedback::getFeedback($userId);
$shareableLink = Utils::generateUniqueLink($userId);

include '../templates/dashboard.html';
