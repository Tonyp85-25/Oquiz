<?php
namespace Oquiz\Controllers;

use Oquiz\Models\QuizModel;
class MainController extends CoreController{


	public function home() {

        $quizzes =QuizModel::findAll();
        $quizModel = new QuizModel;


         echo $this->templates->render('main/home', [
             'quizzes'=>$quizzes,
             'quiz' => $quizModel
             ]) ;
	}


    public function error404(){
         header("HTTP/1.0 404 Not Found");
         echo 'page non trouvée';
         exit;
    }
}
