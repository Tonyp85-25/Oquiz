<?php
namespace Oquiz\Controllers;

use AltoRouter;
use Oquiz\Models\QuizModel;
use Oquiz\Models\QuestionModel;
use Oquiz\Repositories\QuestionRepository;
use Oquiz\Repositories\QuizRepository;
use Oquiz\Utils\DataFormatter;
use Oquiz\Utils\Quizz;

class QuizController extends CoreController
{
    public function __construct(AltoRouter $router, QuizRepository $quizzRep, DataFormatter $formatter,$validator=null)
    {
        parent::__construct($router);
        $this->entityManager = $quizzRep;
        $this->formatter = $formatter;
        if($validator){
            $this->validator =$validator;
        }
    }

    public function quiz($allParams)
    {

//on récupère l'id de $allParams qu'on transforme en entier
        $id = (int) $allParams['id'];
        $questionsRepo = new QuestionRepository();
        $questions =  $questionsRepo->findQuestionsByQuiz($id,'*',true);
        $questions = $this->formatter->formatQuizzQuestions($questions);
        $style= '';
        $score=0;
        $rawQuizz = $this->entityManager->findById($id, true);
        $quiz = $this->formatter->formatQuizzWithAuthor($rawQuizz);
     
        $played=null;
        $answers =[];
        echo $this->templates->render('front/quiz', [
        'quiz' => $quiz,
        'questions' => $questions,
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
        $results = $this->validator->validate($id, $answered);

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
