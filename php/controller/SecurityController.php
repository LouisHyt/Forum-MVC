<?php
namespace Controller;

use App\AbstractController;
use App\DAO;
use Model\Managers\UserManager;
use App\Session;
use Exception;

class SecurityController extends AbstractController {

    public function register() {
        if(isset($_POST['submit'])) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options"=> [
                    "regexp" => "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{12,14}$/"
                ]
            ]);
            $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //Check if all fields are valid
            if(!$username || !$email || !$confirmPassword) {
                $error = "All fields must have a valid value!";
                Session::addFlash("error", $error);
                $this->redirectTo("security", "register");
                exit();
            }

            //Check if password is valid
            if(!$password){
                $error = "Password must be between 12 and 14 characters with at least 1 uppercase, 1 lowercase, 1 digit and 1 special character!";
                Session::addFlash("error", $error);
                $this->redirectTo("security", "register");
                exit();
            }

            //check if passwords matches
            if($password !== $confirmPassword) {
                $error = "Paswords don't match!";
                Session::addFlash("error", $error);
                $this->redirectTo("security", "register");
                exit();
            }

            //Check if username or email already exists
            $userManager = new UserManager();
            $existingUser = $userManager->findByUsernameOrEmail($username, $email);
            if($existingUser) {
                $error = "Username or email already exists!";
                Session::addFlash("error", $error);
                $this->redirectTo("security", "register");
                exit();
            }

            //Hashing the password and adding the user to the database
            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
            $newUser = $userManager->add([
                "username" => $username,
                "password" => $hashedPassword,
                "email" => $email
            ]);

            Session::addFlash("success", "Your account has been created! Please login.");
            $this->redirectTo("security", "login");

        } else {
            return [
                "view" => VIEW_DIR."security/register.php",
                "meta_description" => "Register page of the forum",
                "title" => "DevForum - Register"
            ];
        }
    }

    public function login () {
        if(isset($_POST['submit'])) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if(!$username || !$password) {
                $error = "All fields must have a valid value!";
                Session::addFlash("error", $error);
                $this->redirectTo("security", "login");
                exit();
            }

            $userManager = new UserManager();

            try {
                $user = $userManager->verifyCredentials($username, $password);
                Session::setUser($user);
                $this->redirectTo("home", "index");
            } catch (Exception $e) {
                Session::addFlash("error", $e->getMessage());
                $this->redirectTo("security", "login");
                exit();
            }

        } else {
            return [
                "view" => VIEW_DIR."security/login.php",
                "meta_description" => "Login page of the forum",
                "title" => "DevForum - Login"
            ];
        }
    }
    public function logout () {
        Session::setUser(null);
        $this->redirectTo("forum", "index");
    }
}