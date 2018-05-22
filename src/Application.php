<?php
namespace Oquiz;
use \AltoRouter;

class Application {
    public $router;
  public function __construct()
  {
    // Création du routeur
    $this->router = new AltoRouter();
    // On ignore une partie de l'URL
    // On récupère donc la partie de l'URL qui
    // est fixe grâce à $_SERVER['BASE_URI']
    $basePath = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';
    // On renseigne la partie de l'URL fixe
    $this->router->setBasePath($basePath);
    // On lance le mapping
    $this->mapping();
  }
  private function mapping(){
    // On mappe toutes nos URL
    // La page d'accueil
    $this->router->map('GET', '/', ['MainController', 'home'], 'home');
    $this->router->map('GET', '/quiz/[i:id]', ['QuizController', 'quiz'], 'quiz');
    $this->router->map('POST', '/quiz/[i:id]', ['QuizController', 'quizPost'], 'quiz_post');
    $this->router->map('GET', '/compte/', ['UserController', 'profile'], 'profile');
    $this->router->map('GET', '/signin/', ['UserController', 'signin'], 'signin');
    $this->router->map('POST', '/signin/', ['UserController', 'signinpost'], 'signin_post');
    $this->router->map('GET', '/signout/', ['UserController', 'signout'], 'signout');




    }

  public function run () {
      // Je récupère les données de Altorouter
      $match = $this->router->match();
      // print_r($match);
      if (!$match) {
          // On a pas trouvé la route, on indique le nouveau chemin
          // $controller = new \Oquiz\Controllers\MainController();
          // $controller->error404();
          $controllerName = "\Oquiz\Controllers\MainController";
          $methodName = 'error404';
      }
      else {
          // Je regarde quel controller et quelle
          // méthode je dois exécuter
          // On pense à ajouter le namespace devant
          // le nom de la classe et à échapper le
          // dernier "\" pour ne pas perturber notre code
          $controllerName = "\Oquiz\Controllers\\" . $match['target'][0];
          $methodName = $match['target'][1];
      }
      // J'exécute la bonne et méthode
      // $controller = new Oquiz\Controllers\MainController();
      $controller = new $controllerName( $this->router );
      // On en profite pour transmettre les paramètres
      // contenus dans notre URL (si il y en a)
      $controller->$methodName( $match['params'] );
  }

    // Getter plus précis pour la propriété config
    public function getConfig($key) {
        // Si $key existe dans $this->config
        if (array_key_exists($key, $this->config)) {
            // Je ne retourne pas toute la propriété config
            // mais uniquement une des données du tableau
            return $this->config[$key];
        }
        return false;
    }







}
