<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Topic extends Entity{

    private $id;
    private $title;
    private $content;
    private $user;
    private $category;
    private $isLocked;
    private $timeDiff;
    private $postCount;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * Get the time difference
     */ 
    public function getTimeDiff(){
        return $this->timeDiff;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTimeDiff($timeDiff){
        $this->timeDiff = $timeDiff;
        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle(){
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getIsLocked(){
        return $this->isLocked;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setIsLocked($isLocked){
        $this->isLocked = $isLocked;
        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser(){
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    public function __toString(){
        return $this->title;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of postCount
     */ 
    public function getPostCount()
    {
        return $this->postCount;
    }

    /**
     * Set the value of postCount
     *
     * @return  self
     */ 
    public function setPostCount($postCount)
    {
        $this->postCount = $postCount;

        return $this;
    }
}