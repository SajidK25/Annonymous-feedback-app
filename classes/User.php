<?php

class User {
    private $username;
    private $password;
    private $id;

    public function __construct($username, $password, $id = null) {
        $this->username = $username;
        // $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $this->isHashed($password) ? $password : password_hash($password, PASSWORD_BCRYPT);
        $this->id = $id ? $id : uniqid();
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getId() {
        return $this->id;
    }

    public function save() {
        $users = json_decode(file_get_contents('../data/users.json'), true) ?: [];
        $users[$this->username] = [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password
        ];
        file_put_contents('../data/users.json', json_encode($users));
    }

    public static function find($username) {
        $users = json_decode(file_get_contents('../data/users.json'), true) ?: [];
        if (isset($users[$username])) {
            $user_data = $users[$username];
            return new User($user_data['username'], $user_data['password'], $user_data['id']);
        }
        return null;
    }

    public static function verifyPassword($username, $password) {
        $user = self::find($username);
        if ($user) {
            $storedPassword = $user->getPassword();
            $isVerified = password_verify($password, $storedPassword);
            
            error_log('Username: ' . $username);
            error_log('Provided Password: ' . $password);
            error_log('Stored Password Hash: ' . $storedPassword);
            error_log('Password Verified: ' . ($isVerified ? 'true' : 'false'));
            
            return $isVerified;
        }
        error_log('User not found: ' . $username);
        return false;
    }

    private function isHashed($password) {
        $info = password_get_info($password);
        return isset($info['algo']) && $info['algo'] !== 0;
    }
    
}
