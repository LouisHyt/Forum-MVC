<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;

class TopicController extends AbstractController implements ControllerInterface{

    public function index() {

        return json_encode($_POST);
    }

    public function delete() {

    }

    // API POST
    public function ajax() {

        if(!isset($_POST['topicId']) || empty($_POST['topicId'])){
            return json_encode(["error" => "missing topicId"]);
            exit;
        }

        $topicManager = new TopicManager();
        $topicManager->lockTopic($_POST['topicId']);
        return json_encode([
            "success" => "Topic successfully locked"
        ]);
    }

}