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

    //On créé une fonction qui vérifie si l'email rentré existe dans la BDD
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
