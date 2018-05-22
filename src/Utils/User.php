<?php
namespace Oquiz\Utils;

//Classe servant de librairie de fonctions

class User {

	//fonction indiquant si un utilisateur est connecté ou non (booléen)
  public static function isConnected() {
    return !empty($_SESSION['user']);
  }

	//fonction pour récupérer le nom de l'utilsateur connecté
  public static function getUser() {
    if (self::isConnected()) {
        return $_SESSION['user'];
    }
    return false;
  }

//fonction qui rentre l'utilisateur en session
  public static function setUser($userModel) {
      if (is_object($userModel)) {
          $_SESSION['user'] = $userModel;
      }
  }

}
