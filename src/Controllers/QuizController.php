<?php
namespace Oquiz\Controllers;

use AltoRouter;
use Oquiz\Models\QuizModel;
use Oquiz\Models\QuestionModel;
use Oquiz\Repositories\QuizRepository;
use Oquiz\Utils\Quizz;

class QuizController extends CoreController
{
    public function __construct(AltoRouter $router, QuizRepository $quizzRep)
    {
        parent::__construct($router);
        $this->entityManager = $quizzRep;
    }

    public function quiz($allParams)
    {

//on récupère l'id de $allParams qu'on transforme en entier
        $id = (int) $allParams['id'];
        $quiz = $this->entityManager->findById($id);
        dump($quiz);
        $author = QuizModel::findAuthorByQuiz($id);
        $played= false;
        $questions = QuestionModel::findQuestionsByQuiz($id);
        $style= '';
        $score=0;


        $answers =[];


        echo $this->templates->render('front/quiz', [
        'quiz' => $quiz,
        'questions' => $questions,
        'author' => $author,
        'played' => $played,
        'style' => $style,
        'score' => $score,
        'answers' => $answers,
        ]);
    }

    /**
     * Fonction qui s'occupe de traiter le formulaire
     *
     */

    public function quizPost($allParams)
    {
        // On sauvegarde la liste des erreurs dans un tableau
        
        $errorList = array();
        
        // Je récupère les données
        $answers = array();
        $answered = array_keys($_POST);
    
        $played= true;
        $id = (int) $allParams['id'];
        $results = Quizz::validate($id, $answered);

        $this->sendJSON([
            'code' => 2,
            'results' => $results['results'],
            'score' => $results['score'],
            'total' => count($results['results']),
        ]);
        // $quiz = QuizModel::findById($id);
        // $author = QuizModel::findAuthorByQuiz($id);

        // echo $this->templates->render('front/quiz', [
        //     //   'quiz' => $quiz,
        //     // 'questions' => $questions,
        //     // 'author' => $author,
        //     //   'played' => $played,
        //       'style' => $style,
        //       'score' => $score,
        //       'router' => $this->router,
        //       'answers' => $answers,
    }
}
