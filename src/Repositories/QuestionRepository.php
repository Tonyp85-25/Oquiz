<?php
namespace Oquiz\Repositories;
use \Oquiz\Database;
use Oquiz\Models\QuestionModel;

class QuestionRepository
{
    const TABLE_NAME = 'questions';

    public function findQuestionsByQuiz($quizId, $fields='*',$withLevels=false)
    {
        $sql='
        SELECT '.$fields.' FROM '.self::TABLE_NAME.'
        WHERE id_quiz = :id
        ';
        if($withLevels){
            $sql='
        SELECT '.$fields.',name AS level FROM '.self::TABLE_NAME.'
        INNER JOIN levels ON '.self::TABLE_NAME.'.id_level= levels.id WHERE id_quiz = :id';
        }
        // Je prépare ma requête
        $pdoStatement = Database::getPDO()->prepare($sql);
        // Je "bind" les données/token/jeton de ma requête
        $pdoStatement->bindValue(':id', $quizId, \PDO::PARAM_INT);
        // J'exécute ma requête
        $pdoStatement->execute();
        $results = $pdoStatement->fetchAll(\PDO::FETCH_CLASS, QuestionModel::class);
        // On retourne les résultats
        return $results;
    }

    // public function shuffleProps($questionId)
    // {
    //     $sql ='
    //         SELECT `prop1`,`prop2`,`prop3`,`prop4`
    //         FROM '.self::TABLE_NAME.'
    //         WHERE id = :id

    //     ';
    //     // Je prépare ma requête
    //     $pdoStatement = Database::getPDO()->prepare($sql);
    //     // Je "bind" les données/token/jeton de ma requête
    //     $pdoStatement->bindValue(':id', $questionId, \PDO::PARAM_INT);
    //     // J'exécute ma requête
    //     $pdoStatement->execute();
    //     // Je récupère LE résultat
    //     $result = $pdoStatement->fetchAll(\PDO::FETCH_ASSOC);

    //     //FETCH_ASSOC renvoie un tableau associatif contenu dans la première case d'un tableau d'index numériques, d'où le result[0]
    //     $shuffledResult = shuffle($result[0]);

    //     return $result[0];
    //}
    //Méthode pour retornuer les niveaux
    public  function findLevelByQuestion($id)
    {
        $sql ='
			SELECT `name` FROM `levels` RIGHT JOIN '.self::TABLE_NAME.' ON levels.id = '.self::TABLE_NAME.'.id_level WHERE '.self::TABLE_NAME.'.id = :id
		';
        // Je prépare ma requête
        $pdoStatement = Database::getPDO()->prepare($sql);
        // Je "bind" les données/token/jeton de ma requête
        $pdoStatement->bindValue(':id', $id, \PDO::PARAM_INT);
        // J'exécute ma requête
        $pdoStatement->execute();
        // Je récupère LE résultat
        $result = $pdoStatement->fetchObject(self::class);
        return $result;
    }
    
    public static function findQuestionById($id)
    {
        $sql='
            SELECT * FROM '.self::TABLE_NAME.'
            WHERE id = :id
        ';
        // Je prépare ma requête
        $pdoStatement = Database::getPDO()->prepare($sql);
        // Je "bind" les données/token/jeton de ma requête
        $pdoStatement->bindValue(':id', $id, \PDO::PARAM_INT);
        // J'exécute ma requête
        $pdoStatement->execute();
        $result = $pdoStatement->fetchObject(static::class);
        // On retourne les résultats
        return $result;
    }

}