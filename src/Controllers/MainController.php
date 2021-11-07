<?php
namespace Oquiz\Controllers;

use Oquiz\Repositories\QuizRepository;
use Oquiz\Utils\DataFormatter;

class MainController extends CoreController
{
    public function home()
    {
        $entityManager = new QuizRepository();
        $rawQuizzes =$entityManager->findAll(['quizzes.id','title','description'], true);
        $quizzes =[];
        $formatter =new DataFormatter();
        foreach ($rawQuizzes as $rawQuizz) {
            $quizz= $formatter->formatQuizzWithAuthor($rawQuizz);
            array_push($quizzes, $quizz);
        }
        


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
