<?php
namespace Model\Managers;

use App\Manager;
use APP\DAO;

class CategoryManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Category";
    protected $tableName = "category";

    public function __construct(){
        parent::connect();
    }

    public function findByName(string $name){
        $sql = "
            SELECT 
            id_category 
            FROM category 
            WHERE name = :name
        ";
        return  $this->getOneOrNullResult(
            DAO::select($sql, ["name" => $name], false),
            $this->className
        );
    }

    public function updateName(int $id, string $name){
        $sql = "
            UPDATE category
            SET name = :name
            WHERE id_category = :id
        ";
        DAO::update($sql, [
            'id' => $id,
            'name' => $name
        ]);
    }

}