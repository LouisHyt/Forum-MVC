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
                "email" => $email,
                "roles" => "user"
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

                $isUserBanned = boolval($user->getIsBanned());
                
                if($isUserBanned) {
                    Session::addFlash("error", "Your account has been banned!");
                    $this->redirectTo("security", "login");
                    exit();
                }

                Session::setUser($user);
                $this->redirectTo("forum", "index");
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
        $this->restrictAuth();
        Session::setUser(null);
        $this->redirectTo("home", "index");
    }

    public function profile() {
        $this->restrictAuth();
        
        return [
            "view" => VIEW_DIR."security/profile.php",
            "meta_description" => "Profile page of the user",
            "title" => "DevForum - User Profile"
        ];
    }

    public function deleteUser(){
        $this->restrictAuth();

        if(empty($_POST)) {
            $this->redirectTo("home", 'index');
            exit();
        }

        if(intval($_POST["userId"]) !== Session::getUser()->getId()){
            $this->redirectTo("home", 'index');
            exit();
        }

        //Delete the user from the database
        $userManager = new UserManager();
        $userId = Session::getUser()->getId();
        $userManager->delete($userId);

        //Logout immediately the user
        Session::setUser(null);
        $this->redirectTo("home", "index");

    }
}