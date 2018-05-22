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

    $questions = QuestionModel::findQuestionsByQuiz($id);

    // On instancie le QuestionModel que l' on envoie en donnée dans notre vue afin de pouvoir utiliser la méthode shuffleProps et findLevel dans quiz.php
    $questionModel = new QuestionModel;



    echo $this->templates->render('front/quiz', [
        'quiz' => $quiz,
        'questions' => $questions,
        'question' => $questionModel,
        'author' => $author
    ]);
    }

    public function quizPost(){
        // On sauvegarde la liste des erreurs dans un tableau
        $errorList = array();
        dump($_POST);
        // Je récupère les données
        $answers = array();
    }





}
