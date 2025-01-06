<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\CategoryManager;
use App\Session;

class TopicController extends AbstractController implements ControllerInterface{

    public function index() {

        $this->restrictAuth();
        return json_encode($_POST);
    }

    public function create() {

        $this->restrictAuth();
        
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll(['name', 'ASC']);

        if(!isset($_POST['submit']) && empty($_POST)) {
            return [
                "view" => VIEW_DIR."topics/createTopic.php",
                "meta_description" => "Creation page for a new topic",
                "title" => "DevForum - Create a new topic",
                "data" => [
                    "categories" => $categories
                ]
            ];

        }

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $categoryId = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);

        if(!$title || !$content || !$categoryId) {
            $error = "All fields must have a valid value!";
            Session::addFlash("error", $error);
            $this->redirectTo("topic", "create");
            exit();
        }

        $topicManager = new TopicManager();
        $topicManager->add([
            "title" => $title,
            "content" => $content,
            "category_id" => $categoryId,
            "user_id" => \App\Session::getUser()->getId()
        ]);

        Session::addFlash("success", "Topic successfully created!");
        $this->redirectTo("forum", "index");
        exit();
    }

    public function delete() {

        $this->restrictAuth();

    }

    // API POST for locking a Post
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