<?php

require 'lib/Database.php';

class User extends Database{

    private $email;
    private $user_name;
    private $user_image;
    private $password;

    public function __construct($email, $user_name, $user_image, $password){
        parent::__construct();
        $this->email = $email;
        $this->user_name = $user_name;
        $this->password = $password;
        $this->user_image = $user_image;
    }

    static function newUser($data){
        $user = new User($data['email'], $data['user_name'], null, hash('sha512', $data['password1']));
        return $user;
    }

    static function getUserByEmail($email){
        try{
            $pdo = new Database();
            $pdo = $pdo->connect();
            $sql = "SELECT * FROM users WHERE email = :email";
            $query = $pdo->prepare($sql);
            $query->execute([':email'=>$email]);
            $user = $query->fetch();
            $user = new User($user['email'], $user['user_name'], $user['user_image'], $user['password']);
            return $user;
        }catch(PDOException $e){
            return 'Error: ' . $e;
        }
    }

    public function createUser(){
        try {
            $pdo = $this->connect();
            $sql = "INSERT INTO users(email, user_name, user_image, password) VALUES(:email, :user_name, :user_image, :password)";
            $query = $pdo->prepare($sql);
            $query->execute([':email' => $this->getEmail(), ':user_name' => $this->getUserName(), ':user_image' => $this->getUserImage(), ':password' => $this->getPassword()]);
            $pdo = null;
            return true;
        } catch (PDOException $e){
            echo 'Error: '.$e->getMessage();
            return false;
        }
    }

    public function updateUser(){
        try {
            $pdo = $this->connect();
            $sql = "UPDATE users SET user_name = :user_name, user_image = :user_image, password = :password WHERE email = :email";
            $query = $pdo->prepare($sql);
            $query->execute([':email' => $this->getEmail(), ':user_name' => $this->getUserName(), ':user_image' => $this->getUserImage(), ':password' => $this->getPassword()]);
            $pdo = null;
            return true;
        } catch (PDOException $e){
            echo 'Error: '.$e->getMessage();
            return false;
        }
    }

    // Getters y Setters - encapsulamiento
    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setUserName($user_name){
        $this->user_name = $user_name;
    }

    public function getUserName(){
        return $this->user_name;
    }

    public function setUserImage($user_image){
        $this->user_image = $user_image;
    }

    public function getUserImage(){
        return $this->user_image;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword(){
        return $this->password;
    }



}



?>