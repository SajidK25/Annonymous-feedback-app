<?php
session_start();

class Auth {
    public static function login($email, $password) {
        if (User::verifyPassword($email, $password)) {
            $user = User::find($email);
            // print_r($user);
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $user->getId();
            return true;
        }
        return false;
    }

    public static function logout() {
        session_destroy();
    }

    public static function isLoggedIn() {
        return isset($_SESSION['email']);
    }

    public static function getEmail() {
        return $_SESSION['email'];
    }

    public static function getUserId() {
        return $_SESSION['user_id'];
    }
}
