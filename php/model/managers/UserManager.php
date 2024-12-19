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
}