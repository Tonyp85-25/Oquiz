<?php
namespace Oquiz\Controllers;
use Oquiz\Models\QuizModel;
use Oquiz\Models\QuestionModel;

class QuizController extends CoreController {


public function quiz($allParams){

//on récupère l'id de $allParams qu'on transforme en entier
    $id = (int) $allParams['id'];
    $quiz = QuizModel::findById($id);
    $questions = QuestionModel::findQuestionsByQuiz($id);



    echo $this->templates->render('front/quiz', [
        'quiz' => $quiz,
        'questions' => $questions,
        
    ]);
}





}
