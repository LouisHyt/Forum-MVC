<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
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

    public function showByCategory(int $id){
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