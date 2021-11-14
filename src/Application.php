<?php
namespace Oquiz;

use \AltoRouter;
use Oquiz\Repositories\QuizRepository;
use Oquiz\Utils\DataFormatter;
use Oquiz\Utils\QuizService;

class Application
{
    public $router;
    private $container;
    public function __construct()
    {
        $this->router = new AltoRouter();
        $this->container =new Container();
    
        
        $basePath = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';
        
        $this->router->setBasePath($basePath);
      
        $this->mapping();
    }
    private function mapping()
    {
        // On mappe toutes nos URL
        // La page d'accueil
        $this->router->map('GET', '/', ['MainController', 'home',['QuizRepository']], 'home');
        $this->router->map('GET', '/quiz/[i:id]', ['QuizController', 'quiz',['QuizRepository','DataFormatter']], 'quiz');
        $this->router->map('POST', '/quiz/[i:id]', ['QuizController', 'quizPost',['QuizRepository','DataFormatter','QuizService']], 'quiz_post');
        $this->router->map('GET', '/compte/[i:id]', ['UserController', 'profile'], 'profile');
        $this->router->map('GET', '/signin/', ['UserController', 'signin'], 'signin');
        $this->router->map('POST', '/signin/', ['UserController', 'signinPost'], 'signin_post');
        $this->router->map('GET', '/signout/', ['UserController', 'signout'], 'signout');
        $this->router->map('GET|POST', '/signup/', ['UserController', 'signup'], 'signup');
    }

    public function run()
    {
        // starts service container
        $this->bootContainer();
        $match = $this->router->match();
        if (!$match) { // if no routes
            
            $controllerName = "\Oquiz\Controllers\MainController";
            $methodName = 'error404';
        } else {
            $controllerName = "\Oquiz\Controllers\\" . $match['target'][0];
            $methodName = $match['target'][1];
        }

        if (count($match['target'])>2) { //if service injection needed
            $requiredServices = $match['target'][2];
            $injectedServices= $this->container->loadServices($requiredServices);
           
            // dynamic instanciation of controller, with services
            $controller = new $controllerName($this->router, ...$injectedServices);
        } else {
            $controller = new $controllerName($this->router);
        }
        // On en profite pour transmettre les paramètres
        // contenus dans notre URL (si il y en a)
        $controller->$methodName($match['params']);
    }

    // Getter plus précis pour la propriété config
    public function getConfig($key)
    {
        // Si $key existe dans $this->config
        if (array_key_exists($key, $this->config)) {
            // Je ne retourne pas toute la propriété config
            // mais uniquement une des données du tableau
            return $this->config[$key];
        }
        return false;
    }

    private function bootContainer()
    {
        $this->container->addService('QuizRepository', function () {
            return new QuizRepository();
        });
        $this->container->addService('DataFormatter', function () {
            return new DataFormatter();
        });
        $this->container->addService('QuizService', function () {
            return new QuizService();
        });
    }
}
