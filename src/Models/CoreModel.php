<?php
namespace Oquiz\Models;

use Oquiz\Database;
use PDO;


/*abstract class CoreModel {



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

    public function delete() {
        $sql = '
            DELETE FROM '.static::TABLE_NAME.'
            WHERE id = :id
        ';
        // Je prépare
        $pdoStatement = Database::getPDO()->prepare($sql);

        // Je fais mes "binds"
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

        // j'exécute la requête préparée
        $affectedRows = $pdoStatement->execute();

        return $affectedRows;
    }

    protected abstract function insert();


    protected abstract function update();





}
