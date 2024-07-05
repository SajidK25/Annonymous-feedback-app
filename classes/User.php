<?php

class User {
    private $name;
    private $email;
    private $password;
    private $id;

    public function __construct($name,$email, $password, $id = null) {
        $this->name = $name;
        $this->email=$email;
        // $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $this->isHashed($password) ? $password : password_hash($password, PASSWORD_BCRYPT);
        $this->id = $id ? $id : uniqid();
    }

    public function getName() {
        return $this->name;
    }

    public function getUserEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getId() {
        return $this->id;
    }

    public function save() {
        $users = json_decode(file_get_contents('../data/users.json'), true) ?: [];
        $users[$this->email] = [
            'id' => $this->id,
            'username' => $this->name,
            'username' => $this->email,
            'password' => $this->password
        ];
        file_put_contents('../data/users.json', json_encode($users));
    }

    public static function find($email) {
        $users = json_decode(file_get_contents('../data/users.json'), true) ?: [];
        if (isset($users[$email])) {
            $user_data = $users[$email];
            return new User($user_data['name'],$user_data['email'], $user_data['password'], $user_data['id']);
        }
        return null;
    }

    public static function verifyPassword($email, $password) {
        $user = self::find($email);
        if ($user) {
            $storedPassword = $user->getPassword();
            $isVerified = password_verify($password, $storedPassword);
            
            error_log('Email: ' . $email);
            error_log('Provided Password: ' . $password);
            error_log('Stored Password Hash: ' . $storedPassword);
            error_log('Password Verified: ' . ($isVerified ? 'true' : 'false'));
            
            return $isVerified;
        }
        error_log('User not found: ' . $email);
        return false;
    }

    private function isHashed($password) {
        $info = password_get_info($password);
        return isset($info['algo']) && $info['algo'] !== 0;
    }
    
}
