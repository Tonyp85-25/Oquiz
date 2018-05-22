<?php
namespace Oquiz\Controllers;


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
            'basePath' => $_SERVER['BASE_URI'] , // => $basePath
            'router' => $this->router, // => $router
            //'connectedUser' => User::getUser() // $connectedUser
        ]);
    }

// Méthode permettant de rediriger vers une route de l'application
    public function redirectToRoute($routeName, $params=array()) {
        $this->redirect($this->router->generate($routeName, $params));
    }


}
