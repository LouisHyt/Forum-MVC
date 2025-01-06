<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\CategoryManager;
use App\Session;
use Model\Managers\PostManager;

class TopicController extends AbstractController implements ControllerInterface{

    public function index(?int $id = null) {
        $this->restrictAuth();

        $topicManager = new TopicManager();
        $postManager = new PostManager();
        $topic = $topicManager->findTopicById($id);
        $posts = $postManager->findPostsByTopic($id);

        if(!$topic) {
            $error = "Topic with id $id, does not exist!";
            Session::addFlash("error", $error);
            $this->redirectTo("forum", "index");
            exit();
        }

        return [
            "view" => VIEW_DIR."topics/showTopic.php",
            "meta_description" => "Display the selected topic with all the posts related",
            "title" => "DevForum - Topic $id",
            "data" => [
                "topics" => $topic,
                "posts" => $posts
            ]
        ];
    }

    public function addPost(){
        $this->restrictAuth();

        if(!isset($_POST['submit']) && empty($_POST)) {
            $this->redirectTo("forum", "index");
            exit();
        }

        
        $topicId = filter_input(INPUT_POST, 'topicId', FILTER_VALIDATE_INT);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$topicId || !$content) {
            $error = "Your answer must have a valid value!";
            Session::addFlash("error", $error);
            $this->redirectTo("topic", "index", $topicId);
            exit();
        }

        $postManager = new PostManager();

        $postManager->add([
            "content" => $content,
            "topic_id" => $topicId,
            "user_id" => \App\Session::getUser()->getId()
        ]);

        Session::addFlash("success", "Your answer has been posted!");
        $this->redirectTo("topic", "index", $topicId);
        exit();
        
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