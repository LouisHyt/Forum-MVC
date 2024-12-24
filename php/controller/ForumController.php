<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {

        $this->restrictAuth();

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll(['name', 'ASC']);
        $topicManager = new TopicManager();
        $topics = $topicManager->findAllTopics(['createdAt', 'DESC']);
        return [
            "view" => VIEW_DIR."forum/feed.php",
            "meta_description" => "List all latest topics of the forum",
            "title" => "DevForum - Feed",
            "data" => [ 
                "topics" => $topics,
                "categories" => $categories 
            ]
        ];
    }

    public function showByType(){

        $this->restrictAuth();

        $allowed_types = array("owner", "responses", "open", "closed");

        
        if(!isset($_GET["type"]) || empty($_GET["type"]) || !in_array($_GET["type"], $allowed_types)){
            $this->redirectTo("home", "index");
            exit();
        } else if(!Session::getUser()) {
            $this->redirectTo("security", "login");
            exit();
        } else {
            $topicManager = new TopicManager();
            $topics = $topicManager->findTopicsByType($_GET["type"], ['createdAt', 'DESC']);
            $categoryManager = new CategoryManager();
            $categories = $categoryManager->findAll(['name', 'ASC']);
            return [
                "view" => VIEW_DIR."forum/feed.php",
                "meta_description" => "List all latest topics of the forum",
                "title" => "DevForum - Feed",
                "data" => [ 
                    "topics" => $topics,
                    "categories" => $categories 
                ]
            ];

        }

    }

    public function showByCategory(int $id){
        
        $this->restrictAuth();

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll(['name', 'ASC']);
        $topicManager = new TopicManager();
        $topics = $topicManager->findTopicsByCategory($id, ['createdAt', 'DESC']);
        return [
            "view" => VIEW_DIR."forum/feed.php",
            "meta_description" => "List all latest topics of the forum",
            "title" => "DevForum - Feed",
            "data" => [ 
                "topics" => $topics,
                "categories" => $categories 
            ]
        ];
    }
}