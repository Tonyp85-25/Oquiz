<?php

namespace Oquiz\Models;

use Oquiz\Database;
use PDO;

class QuestionModel {
    private $id;
    private $id_quiz;
    private $question;
    private $prop1;
    private $prop2;
    private $prop3;
    private $prop4;
    private $id_level;
    private $anecdote;
    private $wiki;

    const TABLE_NAME = 'questions';

    public static function findQuestionsByQuiz($quizId){
    $sql='
        SELECT * FROM '.self::TABLE_NAME.'
        WHERE id_quiz = :id
    ';
        // Je prépare ma requête
      $pdoStatement = Database::getPDO()->prepare($sql);
      // Je "bind" les données/token/jeton de ma requête
      $pdoStatement->bindValue(':id', $quizId, PDO::PARAM_INT);
        // J'exécute ma requête
      $pdoStatement->execute();
      $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
      // On retourne les résultats
      return $results;

    }

    public static function shuffleProps($questionId){
        $sql ='
            SELECT `prop1`,`prop2`,`prop3`,`prop4`
            FROM '.self::TABLE_NAME.'
            WHERE id = :id

        ';
        // Je prépare ma requête
      $pdoStatement = Database::getPDO()->prepare($sql);
      // Je "bind" les données/token/jeton de ma requête
      $pdoStatement->bindValue(':id', $questionId, PDO::PARAM_INT);
        // J'exécute ma requête
      $pdoStatement->execute();
      // Je récupère LE résultat
      $result = $pdoStatement->fetchObject(static::class);
      dump($result);
      exit;
      $shuffledResult = shuffle ($result);
      return  $shuffledResult;

    }







/*GETTERS */
    public function getId(){
    return $this->id;
    }

    public function getIdQuiz(){
        return $this->id_quiz;
    }
    public function getQuestion(){
        return $this->question;
    }
    public function getProp1(){
        return $this->prop1;
    }
    public function getProp2(){
        return $this->prop2;
    }
    public function getProp3(){
        return $this->prop3;
    }
    public function getProp4(){
        return $this->prop4;
    }
    public function getIdLevel(){
        return $this->id_level;
    }
    public function getAnecdote(){
        return $this->anecdote;
    }
    public function getWiki(){
        return $this->wiki;
    }



    /*SETTERS*/
    public function setIdQuiz($idQuiz){
        if(!empty($idQuiz)){
             $this->id_quiz = $idQuiz;
        }

    }

    public function setQuestion($question){
        if(!empty($question)){
             $this->question = $question;
        }
    }
    public function setProp1($prop1){
        if(!empty($prop1)){
             $this->prop1 = $prop1;
        }
    }
    public function setProp2($prop2){
        if(!empty($prop2)){
             $this->prop2 = $prop2;
        }
    }
    public function setProp3($prop3){
        if(!empty($prop3)){
             $this->prop3 = $prop3;
        }
    }
    public function setProp4($prop4){
        if(!empty($prop4)){
             $this->prop4 = $prop4;
        }
    }

    public function setIdLevel($id_level){
        if(!empty($id_level)){
            $this->id_level= $id_level;
        }
    }
    public function setAnecdote($anecdote){
        if(!empty($anecedote))
            $this->anecdote = $anecdote;
        }

    public function setWiki($wiki){
        if(!empty($wiki))
            $this->wiki= $wiki;
            }



}
