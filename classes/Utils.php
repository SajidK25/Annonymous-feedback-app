<?php

class Utils {
    public static function generateUniqueLink($userId) {
        return "feedback.php?user={$userId}";
    }
}
