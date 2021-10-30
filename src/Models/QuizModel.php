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

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getQuestions($id)
    {
        return $this->questions;
    }
    /*SETTERS*/
    public function setTitle($title)
    {
        if (!empty($title)) {
            $this->title = $title;
        }
    }
    public function setDescription($description)
    {
        if (!empty($description)) {
            $this->description= $description;
        }
    }
    public function setAuthor($author)
    {
        if (!empty($author)) {
            $this->author = $author;
        }
    }
}
