<?php
namespace Oquiz\Utils;

use Oquiz\Models\QuestionModel;
use Oquiz\Models\QuizModel;
use Oquiz\Models\UserModel;

class DataFormatter
{
    public function formatQuizzWithAuthor($results)
    {
        $quiz =new QuizModel();
        $author= new UserModel();

        $quiz->setId($results['id']);
        $quiz->setTitle($results['title']);
        $quiz->setDescription($results['description']);
        // $author->setId($id_author);
        $author->setFirstName($results['first_name']);
        $author->setLastName($results['last_name']);
        $author->setId($results['author_id']);

        $quiz->setAuthor($author);
        return $quiz;
    }

    public function formatQuizzQuestions($rawQuestions)
    {
        $questions =[];
        foreach ($rawQuestions as $rawQuestion) {
            $question = new QuestionModel();
            $question->setQuestion($rawQuestion['question']);
            $question->setLevel($rawQuestion['level']);
            $question->setProp1($rawQuestion['prop1']);
            $question->setProp2($rawQuestion['prop2']);
            $question->setProp3($rawQuestion['prop3']);
            $question->setProp4($rawQuestion['prop4']);
            $question->setWiki($rawQuestion['wiki']);
            $question->setAnecdote($rawQuestion['anecdote']);
            $questions[] = $question;
        }
        return $questions;
    }
}
