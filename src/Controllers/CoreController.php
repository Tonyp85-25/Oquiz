<?php
namespace Oquiz\Controllers;

use Oquiz\Utils\User;

abstract class CoreController{

  // Je stocke le moteur de template dans une propriété de la classe pour que ce soit accessible à toutes ses méthodes
    protected $templates;

    // Je stocke l'objet AltoRouter dans une propriété de la classe pour que ce soit accessible à toutes ses méthodes (et tous ses enfants)
    protected $router;

  // $app = Application passé en paramètre lors du "dispatch"
    public function __construct($router) {
        // Je crée une instance du moteur de Templates
        $this->templates = new \League\Plates\Engine(ABS_BASE_PATH.'/src/Views');

        // Je récupère le router
        $this->router = $router;

        // Je définis des données utiles pour toutes les templates
        $this->templates->addData([
            'title' => 'Oquiz', // => $title
            'basePath' => $_SERVER['BASE_URI'] ?:'', // => $basePath
            'router' => $this->router, // => $router
            'connectedUser' => User::getUser()  // => $connectedUser
        ]);
    }


     // Méthode permettant d'afficher un résultat sous forme de JSON
    // (utile quand la page est appelée via Ajax)
    public static function sendJSON($data) {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    // Méthode permettant de rediriger vers une URL passée en paramètre
    public function redirect($url) {
        header('Location: '.$url);
        exit;
    }

// Méthode permettant de rediriger vers une route de l'application
    public function redirectToRoute($routeName, $params=array()) {
        $this->redirect($this->router->generate($routeName, $params));
    }

}
