<?php
namespace Oquiz\Controllers;

use Oquiz\Repositories\QuizRepository;

class MainController extends CoreController
{
    public function home()
    {
        $quizzes =QuizRepository::findAll(['*'], true);
        dump($quizzes);
        exit;
        


        echo $this->templates->render('main/home', [
             'quizzes'=>$quizzes,
        
             ]) ;
    }


    public function error404()
    {
        header("HTTP/1.0 404 Not Found");
        echo 'page non trouvée';
        exit;
    }
}
