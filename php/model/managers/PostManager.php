<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct(){
        parent::connect();
    }

    public function findPostsByTopic(int $topicId){
        $sql = "
        SELECT 
            po.id_post, 
            po.content,
            us.username,
        CASE
        WHEN TIMESTAMPDIFF(YEAR, po.createdAt, NOW()) >= 1 THEN 
            CONCAT(TIMESTAMPDIFF(YEAR, po.createdAt, NOW()), ' year', IF(TIMESTAMPDIFF(YEAR, po.createdAt, NOW()) > 1, 's', ''))
        WHEN TIMESTAMPDIFF(DAY, po.createdAt, NOW()) >= 1 THEN 
            CONCAT(TIMESTAMPDIFF(DAY, po.createdAt, NOW()), ' day', IF(TIMESTAMPDIFF(DAY, po.createdAt, NOW()) > 1, 's', ''))
        WHEN TIMESTAMPDIFF(HOUR, po.createdAt, NOW()) >= 1 THEN 
            CONCAT(TIMESTAMPDIFF(HOUR, po.createdAt, NOW()), ' hour', IF(TIMESTAMPDIFF(HOUR, po.createdAt, NOW()) > 1, 's', ''))
        ELSE 
            CONCAT(TIMESTAMPDIFF(MINUTE, po.createdAt, NOW()), ' minute', IF(TIMESTAMPDIFF(MINUTE, po.createdAt, NOW()) > 1, 's', ''))
        END AS timeDiff
        FROM post po
        INNER JOIN user us ON po.user_id = us.id_user
        INNER JOIN topic top ON po.topic_id = top.id_topic
        WHERE top.id_topic = :id
        ORDER BY po.createdAt DESC
        ";
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return $this->getMultipleResults(
            DAO::select($sql, ["id" => $topicId]), 
            $this->className
        );
    }
}