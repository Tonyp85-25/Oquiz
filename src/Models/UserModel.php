<?php
namespace Oquiz\Models;

use Oquiz\Database;
use PDO;

class UserModel
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $password;

    const TABLE_NAME = 'users';

    /**
     * checks if email already exists
     *
     * @param string $email
     * @return object
     */
    public static function findByEmail($email)
    {
        $sql = '
            SELECT *
            FROM '.self::TABLE_NAME.'
            WHERE email = :email

            LIMIT 1
        ';
        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);

        $pdoStatement->execute();

        // JE n'ai qu'un résultat => fetchObject
        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }

    
    /**
    * insert fields in Database
    *
    * @return void
    */
    private function insert()
    {
        $sql = '
        INSERT INTO '.self::TABLE_NAME.'
        (`first_name`, `last_name`, `email`, `password`)
        VALUES
        (:first_name, :last_name, :email, :password)
        ';

        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $pdoStatement->bindValue(':password', $this->password, PDO::PARAM_STR);

        $affectedRows = $pdoStatement->execute();

        // Je récupère l'id auto-incrémenté
        // et je l'affecte à la propriété id
        $this->id = Database::getPDO()->lastInsertId();
        
        return $affectedRows;
    }

   
    /**
     * update the object in database
     *
     * @return object
     */
    private function update()
    {
        $sql = '
            UPDATE '.self::TABLE_NAME.'
            SET 
            `first_name` = :first_name,
            `last_name` = :last_name,
            `email` = :email,
            `password` = :password
            WHERE id = :id
            ';
        // Je prépare
        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $pdoStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

        $affectedRows = $pdoStatement->execute();
        return $affectedRows;
    }


    /**
     * saves data in database, and know when insert or update
     *
     * @return void
     */
    public function save()
    {
        // Si on a un id => alors la ligne existe dans la table
        // => on met à jour
        if ($this->id > 0) {
            $retour = $this->update();
            return $retour;
        }
        // Sinon, la ligne n'existe pas dans la table
        // => on insère dans la table
        else {
            return $this->insert();
        }
    }

    /**
     * return the userModel with the selected id
     *
     * @param int $id
     * @return object
     */
    public static function findById($id)
    {
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


    /*GETTERS*/

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /*SETTERS*/

    public function setId(int $id)
    {
        if (!empty($id)) {
            $this->id = $id;
        }
    }
    public function setFirstName(string $firstName)
    {
        if (!empty($firstName)) {
            $this->first_name = $firstName;
        }
    }
    public function setLastName(string $lastName)
    {
        if (!empty($lastName)) {
            $this->last_name = $lastName;
        }
    }
    public function setEmail(string $email)
    {
        if (!empty($email)) {
            $this->email = $email;
        }
    }
    public function setPassword(string $password)
    {
        if (!empty($password)) {
            $this->password = $password;
        }
    }
}
