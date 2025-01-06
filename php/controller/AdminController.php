<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\DAO;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;
use App\Session;

class AdminController extends AbstractController implements ControllerInterface{

    public function banUser() {

        $this->restrictTo("ROLE_ADMIN");
        $userManager = new UserManager();
        $users = $userManager->getAllUsers();

        if(!isset($_POST['submit']) && empty($_POST)) {
            return [
                "view" => VIEW_DIR."admin/banUser.php",
                "title" => "DevForum [Admin] - Ban a user",
                "data" => [
                    "users" => $users
                ]
            ];
        }

        $userId = filter_input(INPUT_POST, "userId", FILTER_VALIDATE_INT);

        $user = $userManager->findOneById($userId);

        $isUserBanned = boolval($user->getIsBanned());

        if($isUserBanned) {
            $userManager->unbanUser($userId);
            Session::addFlash("success", "The user ". $user->getUsername() . " has been unbanned.");
        } else {
            $userManager->banUser($userId);
            Session::addFlash("success", "The user ". $user->getUsername() . " has been banned.");
        }

        $this->redirectTo("admin", "banUser");

    }

    public function manageCategory() {

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll(['name', 'ASC']);

        $this->restrictTo("ROLE_ADMIN");
        return [
            "view" => VIEW_DIR."admin/manageCategory.php",
            "title" => "DevForum [Admin] - Add a category",
            "data" => [
                "categories" => $categories
            ]
        ];

    }

    public function addCategory() {

        $this->restrictTo("ROLE_ADMIN");

        if(!isset($_POST['submit']) && empty($_POST)) {
            $this->redirectTo("admin", "manageCategory");
            exit();
        }

        $categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(!$categoryName){
            $error = "The new category must have a valid name!";
            Session::addFlash("error", $error);
            $this->redirectTo("admin", "manageCategory");
            exit();
        }

        $categoryManager = new CategoryManager();

        $isCategoryTaken = $categoryManager->findByName($categoryName);

        if($isCategoryTaken){
            $error = "A category with the name \"$categoryName\" already exists!";
            Session::addFlash("error", $error);
            $this->redirectTo("admin", "manageCategory");
            exit();
        }

        $categoryManager->add([
            "name" => $categoryName
        ]);
        Session::addFlash("success", "The category \"$categoryName\" has been added!");
        $this->redirectTo("admin", "manageCategory");
    }

    public function deleteCategory() {

        $this->restrictTo("ROLE_ADMIN");
        $categoryManager = new CategoryManager();

        $categoryId = filter_input(INPUT_POST, "categoryId", FILTER_VALIDATE_INT);
        $categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $categoryManager->delete($categoryId);
        Session::addFlash("success", "The category \"$categoryName\" has been deleted!");
        $this->redirectTo("admin", "manageCategory");

    }

    public function editCategory(){
        $this->restrictTo("ROLE_ADMIN");
        $categoryManager = new CategoryManager();

        $categoryId = filter_input(INPUT_POST, "categoryId", FILTER_VALIDATE_INT);
        $categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$categoryName){
            $error = "The category must have a valid name!";
            Session::addFlash("error", $error);
            $this->redirectTo("admin", "manageCategory");
            exit();
        }

        $categoryManager->updateName($categoryId, $categoryName);
        Session::addFlash("success", "The category \"$categoryName\" has been updated!");
        $this->redirectTo("admin", "manageCategory");
    }
}