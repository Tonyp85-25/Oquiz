<?php

namespace Oquiz\Models;

use Oquiz\Database;
use PDO;

class QuizModel
{
    private $id;
    /**
    *  @var string

    */
    private $title;
    /**
    *  @var string

    */
    private $description;
    /**
    *  @var UserModel
    */
    private $author;

    /**
     * Undocumented variable
     *
     * @var QuestionModel[]
     */
    private $questions;

   

   

    

    /* GETTERS*/

    public function getId():int
    {
        return $this->id;
    }
    public function getTitle():string
    {
        return $this->title;
    }
    public function getDescription():string
    {
        return $this->description;
    }
    public function getAuthor():UserModel
    {
        return $this->author;
    }
    public function getQuestions($id)
    {
        return $this->questions;
    }
    /*SETTERS*/
    public function setTitle(string $title)
    {
        if (!empty($title)) {
            $this->title = $title;
        }
    }
    public function setDescription(string $description)
    {
        if (!empty($description)) {
            $this->description= $description;
        }
    }
    public function setAuthor(UserModel $author)
    {
        if (!empty($author)) {
            $this->author = $author;
        }
    }
    public function setId(int $id)
    {
        if (!empty($id)) {
            $this->id = $id;
        }
    }
}
