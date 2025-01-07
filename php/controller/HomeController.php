<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
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
}
