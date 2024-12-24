<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;

class TopicController extends AbstractController implements ControllerInterface{

    public function index() {

        var_dump("yeeeeey index");
        die;

        $this->restrictAuth();
    }

    public function delete() {

    }

    public function lock() {
        $this->restrictAuth();


        var_dump($_SERVER);die;

        if(isset($_POST["topicId"])){
            $topicManager = new TopicManager();
            $topicManager->lockTopic($_POST["topicId"]);
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

}