<?php

namespace Oquiz\Models;

class QuizModel {

    /**
    *  @var int
    */
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
    *  @var int
    */
	private $authorId;

	protected  function insert(){

	}

	protected function update(){

	}

	/* GETTERS*/
    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getAuthorId(){
        return $this->authorId;
    }
    /*SETTERS*/
    public function setTitle($title){
        if(!empty($title)){
         $this->title = $title;
         }
    }
    public function setDescription($description){
        if(!empty($description)){
            $this->description= $description;
        }
    }
    public function setAuthorId($authorId){
        if (!empty($authorId)){
            $this->authorId = $authorId;
        }
    }





}
