<?php
namespace Oquiz\Utils;

use Oquiz\Models\QuestionModel;

class QuizzService
{
    public static function validate(int $id, $answered)
    {
        $score= 0;
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

        // $style = [];

        $results = [];
        foreach ($answers as $questionId=>$value) {

    // Pour savoir si une réponse est juste , il faut la comparer à la propostion 1 (prop1)de chaque question
            if ($value === QuestionModel::findQuestionById($questionId)->getProp1()) {
                $score ++;
                // $style[$questionId] = 'style="background-color:#d4edda"';
                $results[$questionId] = 'true';
            } elseif ('' === $value) {
                $results[$questionId] = 'none';
            } else {
                $results[$questionId] = 'false';
            }
        }
        $data= ["results"=>$results,
        "score"=>$score];
        return $data;
    }
}
