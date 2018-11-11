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
    $checked= false;
    $questions = QuestionModel::findQuestionsByQuiz($id);
    $style= '';
    // On instancie le QuestionModel que l' on envoie en donnée dans notre vue afin de pouvoir utiliser la méthode shuffleProps et findLevel dans quiz.php
    $questionModel = new QuestionModel;



    echo $this->templates->render('front/quiz', [
        'quiz' => $quiz,
        'questions' => $questions,
        'question' => $questionModel,
        'author' => $author,
        
        ]);
    }

    public function quizPost($allParams){
        // On sauvegarde la liste des erreurs dans un tableau
        $errorList = array();
        $score= 0;
        // Je récupère les données
        $answers = array();
        $answers = ($_POST);
        $checked= true;
        $id = (int) $allParams['id'];
        
        foreach ($answers as $answer=>$value) {
            if ($value === QuestionModel::findQuestionById($answer)->getProp1())
            {
                $score ++;
                $style = 'style="background-color:green"';
            } else {
                $style = 'style="background-color:yellow"';
            }
        }
          $this->redirectToRoute('quiz',$params =[
              'id' => $id,
              'checked' => $checked,
              'style' => $style,

          ])
            ;
    }





}
