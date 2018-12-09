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
        dump($_POST);
        $errorList = array();
        $score= 0;
        // Je récupère les données
        $answers = array();
        $answered = array_keys($_POST);
        
        $played= true;
        $id = (int) $allParams['id'];
        $questions = QuestionModel::findQuestionsByQuiz($id);

        // on récupère les id des questions du quiz
        foreach ($questions as $question) {
            $answers[] = $question->getId();
        }
        //on vérifie si  toutes les questions (leur id) ont une réponse et on récupère celles qui n'en ont pas dans diffs
        $diffs= array_diff($answers, $answered);
        //on donne une valeur '' aux questions non répondues 
        $diffs = array_fill_keys($diffs, '');
        
        //on réinitialise $answers avec $_post pour en faire un tableau clé => valeur
        $answers = $_POST;
        //on ajoute $diffs à la fin d'answers pour que toutes les id soient présentes (pour éviter d'avoir une erreur "undefined offset")
        $answers = $answers + $diffs;
        dump($answers);
        $style = [];
        
        foreach ($answers as $questionId=>$value) {

            // Pour savoir si une réponse est juste , il faut la comparer à la propostion 1 (prop1)de chaque question
            if ($value === QuestionModel::findQuestionById($questionId)->getProp1())
            {
                $score ++;
                $style[$questionId] = 'style="background-color:#d4edda"';
            } elseif ('' === $value) {
                 $style[$questionId] = '';
            }else {
                $style[$questionId] = 'style="background-color:#f03737"';
            }

        }

        
        $quiz = QuizModel::findById($id);
        $author = QuizModel::findAuthorByQuiz($id);

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
