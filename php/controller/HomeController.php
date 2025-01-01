<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;
use App\Session;

class HomeController extends AbstractController implements ControllerInterface {

    public function index(){

        if(Session::getUser()){
            $this->redirectTo("forum", "index");
            exit;
        }

        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Home page of the forum",
            "title" => "DevForum - Home"
        ];
    }
        
    public function users(){
        $this->restrictTo("ROLE_USER");

        $manager = new UserManager();
        $users = $manager->findAll(['register_date', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
    }
}
