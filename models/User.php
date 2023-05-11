<?php
// Clase user / Control de usuarios / CRUD de usuarios
class User extends Database{
    // Atributos de la clase
    private $email;
    private $user_name;
    private $user_image;
    private $password;

    // Constructor de la clase
    public function __construct($email, $user_name, $user_image, $password){
        parent::__construct();
        $this->email = $email;
        $this->user_name = $user_name;
        $this->password = $password;
        $this->user_image = $user_image;
    }

    // Método estático que devuelve una instancia de la clase usuario.
    // Recibe como parametro un array asociativo con los atributos necesarios.
    static function newUser($data){
        $user = new User($data['email'], $data['user_name'], null, hash('sha512', $data['password1']));
        return $user;
    }

    // Método estático que devuelve el id de un usuario.
    static function getUserId($email){
        try{
            $database = new Database();
            $pdo = $database->connect();
            $sql = "SELECT id FROM users WHERE email = :email";
            $query = $pdo->prepare($sql);
            $query->execute([':email'=>$email]);
            $userId = $query->fetch();
            $pdo = null;
            return $userId['id'];
        } catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // Método estático que devuelve una instancia de la clase usuario.
    // En este caso recibe como parametro el email de dicho usuario.
    static function getUserByEmail($email){
        try{
            $pdo = new Database();
            $pdo = $pdo->connect();
            $sql = "SELECT * FROM users WHERE email = :email";
            $query = $pdo->prepare($sql);
            $query->execute([':email'=>$email]);
            $user = $query->fetch();
            $user = new User($user['email'], $user['user_name'], $user['user_image'], $user['password']);
            $pdo = null;
            return $user;
        }catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // (Create) Método que crea un nuevo usuario en la base de datos.
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

    // (Update) Método que actualiza un registro en la base de datos.
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