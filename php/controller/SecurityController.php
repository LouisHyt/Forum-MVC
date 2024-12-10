<?php
namespace Controller;

use App\AbstractController;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {

        return [
            "view" => VIEW_DIR."security/register.php",
            "meta_description" => "Register page of the forum",
            "title" => "DevForum - Register"
        ];
    }
    public function login () {
        return [
            "view" => VIEW_DIR."security/login.php",
            "meta_description" => "Login page of the forum",
            "title" => "DevForum - Login"
        ];
    }
    public function logout () {}
}