<?php
namespace Oquiz\Repositories;

use Oquiz\Models\QuizModel;
use Oquiz\Models\UserModel;

use Oquiz\Database;
use PDO;

class QuizRepository
{
    const TABLE_NAME = 'quizzes';
    //On crée la fonction qui doit afficher tous les quiz.
    public function findAll($attributes=['quizzes.id','title','description'], $withAuthor =false)
    {
        $fields= $attributes[0];
        $badKey =array_search('password', $attributes);
        if ($badKey) {
            array_splice($attributes, $badKey, 1);
        }
        if (count($attributes)>1) {
            $fields = join(', ', $attributes);
        }

        //On crée la requête SQL
        $sql = '
             SELECT '.$fields.' FROM '.self::TABLE_NAME.'
 
         ';
        if ($withAuthor) {
            $sql= 'SELECT '.$fields.', first_name, last_name, users.id AS author_id FROM '.self::TABLE_NAME.' INNER JOIN users ON users.id = quizzes.id_author ';
        }
         
        $pdo = Database::getPDO();
      
        $pdoStatement = $pdo->query($sql);
         
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        // On retourne les résultats
        return $results;
    }
 
    public function findById($id, $withAuthor=false)
    {
        $sql ='
         SELECT * FROM '.self::TABLE_NAME.'
         WHERE id = :id
         ';
        
        if ($withAuthor) {
            $sql = '
            SELECT quizzes.id,title,description,`first_name`,`last_name`, users.id AS author_id FROM
           `users` INNER JOIN quizzes On users.id = '.self::TABLE_NAME.'.id_author WHERE '.self::TABLE_NAME.'.id = :id           
            ';
        }
        // Je prépare ma requête
        $pdoStatement = Database::getPDO()->prepare($sql);
        // Je "bind" les données/token/jeton de ma requête
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        // J'exécute ma requête
        $pdoStatement->execute();
        // Je récupère LE résultat
        $result = $pdoStatement->fetch(
            PDO::FETCH_ASSOC
        );
        return $result;
    }
 
    public function findAuthorByQuiz($id)
    {
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
        $result = $pdoStatement->fetchObject(QuizModel::class);
        return $result;
    }
     
    /**
     * return the quizzes created by one specific user
     *
     * @param int $userId
     * @return
     */
    public function findQuizzesByUser($userId)
    {
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
 
    public function findFullQuizz($id)
    {
        $sql ='
        SELECT  qid, question, name AS level, prop1,prop2,prop3, prop4,anecdote,wiki FROM 
        (SELECT questions.id AS qid,question,prop1,prop2,prop3, prop4,id_level,anecdote,wiki FROM `questions` INNER JOIN quizzes ON questions.id_quiz = quizzes.id WHERE quizzes.id = 2 )
        AS qs INNER JOIN levels ON qs.id_level = levels.id
     ';
        // Je prépare ma requête
        $pdoStatement = Database::getPDO()->prepare($sql);
        // Je "bind" les données/token/jeton de ma requête
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        // J'exécute ma requête
        $pdoStatement->execute();
        // Je récupère LE résultat
        $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
