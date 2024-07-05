<?php
session_start();

class Auth {
    public static function login($username, $password) {
        if (User::verifyPassword($username, $password)) {
            $user = User::find($username);
            // print_r($user);
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user->getId();
            return true;
        }
        return false;
    }

    public static function logout() {
        session_destroy();
    }

    public static function isLoggedIn() {
        return isset($_SESSION['username']);
    }

    public static function getUsername() {
        return $_SESSION['username'];
    }

    public static function getUserId() {
        return $_SESSION['user_id'];
    }
}
