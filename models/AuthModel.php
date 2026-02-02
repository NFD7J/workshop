<?php
namespace App\models;
use App\entities\User;
use App\core\Dbconnect;

class AuthModel extends Dbconnect
{
    public function login(User $user)
    {
        $this->request = $this->connection->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $this->request->execute([
            "email" => $user->getEmail(),
            "password" => $user->getPassword()
        ]);
        $isconnected = $this->request->fetch();
        if($isconnected !== NULL){
            return $isconnected;
        }else{
            return false;
        }
    }

    public function register(User $user)
    {
        $this->request = $this->connection->prepare("INSERT INTO users (name, email, password, roles_id) VALUES (:name, :email, :password, :role)");
        $this->request->execute([
            "name" => $user->getName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "role" => $user->getRole()
        ]);
    }

}