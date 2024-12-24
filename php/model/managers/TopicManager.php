<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use App\Session;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    private function getSqlRequest($order = null, $condition = null){
        $orderQuery = ($order) 
        ?   "ORDER BY ".$order[0]. " ".$order[1] 
        :   "";

        $whereQuery = $condition ?? ""; 

        $sql = "
        SELECT 
            top.id_topic, 
            top.title, 
            top.isLocked, 
            top.createdAt, 
            top.updatedAt, 
            top.user_id, 
            top.category_id,
            COUNT(po.id_post) AS postCount,
        CASE
        WHEN TIMESTAMPDIFF(YEAR, top.createdAt, NOW()) >= 1 THEN 
            CONCAT(TIMESTAMPDIFF(YEAR, top.createdAt, NOW()), ' year', IF(TIMESTAMPDIFF(YEAR, top.createdAt, NOW()) > 1, 's', ''))
        WHEN TIMESTAMPDIFF(DAY, top.createdAt, NOW()) >= 1 THEN 
            CONCAT(TIMESTAMPDIFF(DAY, top.createdAt, NOW()), ' day', IF(TIMESTAMPDIFF(DAY, top.createdAt, NOW()) > 1, 's', ''))
        WHEN TIMESTAMPDIFF(HOUR, top.createdAt, NOW()) >= 1 THEN 
            CONCAT(TIMESTAMPDIFF(HOUR, top.createdAt, NOW()), ' hour', IF(TIMESTAMPDIFF(HOUR, top.createdAt, NOW()) > 1, 's', ''))
        ELSE 
            CONCAT(TIMESTAMPDIFF(MINUTE, top.createdAt, NOW()), ' minute', IF(TIMESTAMPDIFF(MINUTE, top.createdAt, NOW()) > 1, 's', ''))
        END AS timeDiff
        FROM topic top
        LEFT JOIN post po ON top.id_topic = po.topic_id
        $whereQuery
        GROUP BY top.id_topic
        $orderQuery";

        return $sql;
    }

    public function findAllTopics($order = null){

       $sql = $this->getSqlRequest($order);
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory(int $id, $order = null){
        
        $sql = $this->getSqlRequest($order, "WHERE top.category_id = :id");
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return $this->getMultipleResults(
            DAO::select($sql, ["id" => $id]), 
            $this->className
        );
    }

    public function findTopicsByType(string $type, $order = null){
        switch($type){
            case "owner":
                $userId = Session::getUser()->getId();
                $condition = "WHERE top.user_id = :id";
                $values = ["id" => $userId];
            break;
            case "responses":
                $userId = Session::getUser()->getId();
                $condition = "WHERE po.user_id = :id";
                $values = ["id" => $userId];
            break;
            case "open":
                $condition = "WHERE top.isLocked = false";
                $values = [];
            break;
            case "closed":
                $condition = "WHERE top.isLocked = true";
                $values = [];
            break;
        }

        $sql = $this->getSqlRequest($order, $condition);
        return $this->getMultipleResults(
            DAO::select($sql, $values), 
            $this->className
        );

    }

    public function lockTopic(int $id){

        $sql="
        UPDATE topic 
        SET isLocked = true
        WHERE id_topic = :id
        ";

        return $this->getOneOrNullResult(
            DAO::update($sql, ["id" => $id]),
            $this->className
        );
    }
}