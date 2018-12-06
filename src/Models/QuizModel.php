<?php

namespace Oquiz\Models;
use Oquiz\Database;
use PDO;

class QuizModel {

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
	private $id_author;

    const TABLE_NAME = 'quizzes';

	protected  function insert(){

	}

	protected function update(){

	}

    //On crée la fonction qui doit afficher tous les quiz.
    public static function findAll(){
        //On crée la requête SQL
        $sql = '
            SELECT * FROM '.self::TABLE_NAME.'

        ';
         // Utilisation de notre classe Database pour se connecter à la database
        $pdo = Database::getPDO();
        // exécution de la requête
        $pdoStatement = $pdo->query($sql);
        // Je veux récupérer tous les résultats sous forme de tableau d'objet QuizModel
        // on doit préciser le FQCN de la classe
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
        // On retourne les résultats
        return $results;
    }

    public static function findById($id){
        $sql ='
        SELECT * FROM '.self::TABLE_NAME.'
        WHERE id = :id
        ';
        // Je prépare ma requête
      $pdoStatement = Database::getPDO()->prepare($sql);
      // Je "bind" les données/token/jeton de ma requête
      $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        // J'exécute ma requête
      $pdoStatement->execute();
      // Je récupère LE résultat
      $result = $pdoStatement->fetchObject(static::class);
      return $result;
    }

	public static function findAuthorByQuiz($id){
		$sql ='
			SELECT `first_name`,`last_name` FROM `users` RIGHT JOIN quizzes On users.id = '.self::TABLE_NAME.'.id_author WHERE '.self::TABLE_NAME.'.id = :id
		';
		// Je prépare ma requête
      $pdoStatement = Database::getPDO()->prepare($sql);
      // Je "bind" les données/token/jeton de ma requête
      $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        // J'exécute ma requête
      $pdoStatement->execute();
      // Je récupère LE résultat
      $result = $pdoStatement->fetchObject(static::class);
      return $result;
    }
    
    /**
     * return the quizzes created by one specific user
     *
     * @param int $userId
     * @return 
     */
    public static function findQuizzesByUser($userId) {
        $sql ='
        SELECT * FROM '.self::TABLE_NAME.'
        WHERE id_author = :userId
        ';

        $pdoStatement = Database::getPDO()->prepare($sql);
        $pdoStatement->bindValue(':userId', $userId, PDO::PARAM_INT); 
        $pdoStatement->execute();
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
        
        return $results;
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
        return $this->id_author;
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
            $this->id_author = $authorId;
        }
    }





}
