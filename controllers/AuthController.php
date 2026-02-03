<?php
namespace App\controllers;
use App\entities\User;
use App\models\AuthModel;

class AuthController extends Controller
{

    public function index()
    {
        isset($_SESSION["user"]) ? header("location: index.php") : "";
        if(isset($_POST["email"]) && isset($_POST["password"])){

            if(!empty($_POST["email"]) && !empty($_POST["password"])){
                $user = new User();
                $user->setEmail($_POST["email"]);
                $user->setPassword($_POST["password"]);
                $authModel = new AuthModel();
                $role = $authModel->login($user);
                if($role !== false){
                    $_SESSION["user"] = [
                        "email" => $_POST["email"],
                        "role" => $role->roles_id,
                        "name" => $role->name,
                        "id" => $role->user_id
                    ];
                    header("location: index.php");
                }else{
                    $error = "Email ou mot de passe incorrect";
                    $this->render("authentification/login", ["error" => $error]);
                }
            }else{
                $error = "Tous les champs doivent être remplis";
                $this->render("authentification/login", ["error" => $error]);
            }
        }else{
            $this->render('authentification/login');
        }
    }

    public function logout()
    {
        if(isset($_POST["true"])){
            session_destroy();
            header("location: index.php");
        }elseif(isset($_POST["false"])){
            header("location: index.php");
        }else{
            $this->render("authentification/logout");
        }
    }

    public function register()
    {
        isset($_SESSION["user"]) ? header("location: index.php") : "";
        if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])){

            if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
                $user = new User();
                $user->setName($_POST["name"]);
                $user->setEmail($_POST["email"]);
                $user->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
                $user->setRole("2");

                $authModel = new AuthModel();
                $authModel->register($user);
                $_SESSION["email"] = $_POST["email"];
                header("location: index.php?controller=auth");
            }else{
                $error = "Tous les champs doivent être remplis";
                $this->render("authentification/register", ["error" => $error]);
            }
        }else{
        
            $this->render('authentification/register');
        }
    }
}