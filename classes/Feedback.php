<?php

class Feedback {
    private $userId;
    private $name;
    private $message;

    public function __construct($userId, $name, $message) {
        $this->userId = $userId;
        $this->name = $name;
        $this->message = $message;
    }

    public function save() {
        $file_path = "../data/feedback/{$this->userId}.json";
        $feedbacks = json_decode(file_get_contents($file_path), true) ?: [];
        $feedbacks[] = ['name' => $this->name, 'message' => $this->message];
        file_put_contents($file_path, json_encode($feedbacks));
    }

    public static function getFeedback($userId) {
        $file_path = "../data/feedback/{$userId}.json";
        return json_decode(file_get_contents($file_path), true) ?: [];
    }
}
