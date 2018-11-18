<?php
namespace Oquiz\Controllers;
use Oquiz\Models\QuizModel;
use Oquiz\Models\QuestionModel;

class QuizController extends CoreController {


public function quiz($allParams){

//on récupère l'id de $allParams qu'on transforme en entier
    $id = (int) $allParams['id'];
    $quiz = QuizModel::findById($id);
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

    public function quizPost($allParams){
        // On sauvegarde la liste des erreurs dans un tableau
        $errorList = array();
        $score= 0;
        // Je récupère les données
        $answers = array();
        $answers = ($_POST);
        $played= true;
        $id = (int) $allParams['id'];
        $style = [];
        
        foreach ($answers as $questionId=>$value) {

            if (!isset ($_POST[$questionId])) {
                $style[$questionId] ='';
            } 
            
            if ($value === QuestionModel::findQuestionById($questionId)->getProp1())
            {
                $score ++;
                $style[$questionId] = 'style="background-color:green"';
            } else {
                $style[$questionId] = 'style="background-color:yellow"';
            }

        }

        $id = (int) $allParams['id'];
        $quiz = QuizModel::findById($id);
        $author = QuizModel::findAuthorByQuiz($id);
        $questions = QuestionModel::findQuestionsByQuiz($id);
        

        
        

        echo $this->templates->render('front/quiz', [
              'quiz' => $quiz,
            'questions' => $questions,
            'author' => $author,
              'played' => $played,
              'style' => $style,
              'score' => $score,
              'router' => $this->router, 
              'answers' => $answers,

          ])
            ;
    }





}
