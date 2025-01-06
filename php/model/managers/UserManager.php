<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    public function findByUsernameOrEmail($username, $email){

        $sql = "
            SELECT id_user
            FROM user
            WHERE username = :username OR email = :email
        ";
        return $this->getOneOrNullResult(
            DAO::select($sql, ['username' => $username, 'email' => $email], false),
            $this->className
        );
    }

    public function verifyCredentials($username, $password){
        $sql = "
            SELECT *
            FROM user
            WHERE username=:username
        ";
        $user = $this->getOneOrNullResult(
            DAO::select($sql, ['username' => $username], false),
            $this->className
        );

        if(!$user){
            throw new \Exception('Invalid credentials');
            exit();
        }

        $isCorrectPassword = password_verify($password, $user->getPassword());
        if(!$isCorrectPassword){
            throw new \Exception('Invalid credentials');
            exit();
        }

        return $user;
        
    }

    public function getAllUsers(){
        $sql = "
            SELECT
                us.id_user,
                us.username,
                us.email,
                us.isBanned,
                us.createdAt,
                COUNT(top.id_topic) AS topicCount
            FROM user us
            LEFT JOIN topic top ON us.id_user = top.user_id
            GROUP BY us.id_user
            ORDER BY us.username DESC
        ";

        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }

    public function isUserBanned(int $id){
        $sql = "
            SELECT isBanned
            FROM user
            WHERE id_user = :id
        ";
        return $this->getSingleScalarResult(
            DAO::select($sql, ['id' => $id], false)
        );
    }

    public function banUser(int $id){
        $sql = "
            UPDATE user
            SET isBanned = 1
            WHERE id_user = :id
        ";
        DAO::update($sql, ['id' => $id]);
    }

    public function unBanUser(int $id){
        $sql = "
            UPDATE user
            SET isBanned = 0
            WHERE id_user = :id
        ";
        DAO::update($sql, ['id' => $id]);
    }
}