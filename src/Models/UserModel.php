<?php
namespace Oquiz\Models;
use Oquiz\Database;
use PDO;

class UserModel {

    protected $id;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $password;

    const TABLE_NAME = 'users';

    /**
     * On créé une fonction qui vérifie si l'email rentré existe dans la BDD
     *
     * @param string $email
     * @return object
     */
    public static function findByEmail($email) {
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
    private function insert ()
    {
        $sql = '
        INSERT INTO '.self::TABLE_NAME.'
        (`first_name`, `last_name`, `email`, `password`)
        VALUES
        (:first_name, :last_name, :email, :password)
        ';

        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bindValue(':first_name', $this->first_name , PDO::PARAM_STR);
        $pdoStatement->bindValue(':last_name', $this->last_name , PDO::PARAM_STR);
        $pdoStatement->bindValue(':email', $this->email , PDO::PARAM_STR);
        $pdoStatement->bindValue(':password', $this->password , PDO::PARAM_STR);

        $affectedRows = $pdoStatement->execute();

          // Je récupère l'id auto-incrémenté
        // et je l'affecte à la propriété id
        $this->id = Database::getPDO()->lastInsertId();
        
        return $affectedRows;
    }

   
    /**
     * update the object in database
     *
     * @return void
     */
    private  function update() {
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

            $pdoStatement->bindValue(':first_name', $this->first_name , PDO::PARAM_STR);
            $pdoStatement->bindValue(':last_name', $this->last_name , PDO::PARAM_STR);
            $pdoStatement->bindValue(':email', $this->email , PDO::PARAM_STR);
            $pdoStatement->bindValue(':password', $this->password , PDO::PARAM_STR);
            $pdoStatement->bindValue(':id', $this->id , PDO::PARAM_INT);

            $affectedRows = $pdoStatement->execute();
            return $affectedRows;
    }


    /**
     * saves data in database, and know when insert or upadte
     *
     * @return void
     */
    public function save() {
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


    /*GETTERS*/

    public function getId(){
        return $this->id;
    }

    public function getFirstName(){
        return $this->first_name;
    }

    public function getLastName(){
        return $this->last_name;
    }
    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    /*SETTERS*/

       public function setFirstName($firstName) {
        if (!empty($firstName)) {
            $this->first_name = $firstName;
        }
    }
     public function setLastName($lastName) {
      if (!empty($lastName)) {
          $this->last_name = $lastName;
      }
  }
      public function setEmail($email) {
        if (!empty($email)) {
            $this->email = $email;
        }
    }
       public function setPassword($password) {
        if (!empty($password)) {
            $this->password = $password;
        }
    }
}
