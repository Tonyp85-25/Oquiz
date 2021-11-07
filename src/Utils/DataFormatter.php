<?php
namespace Oquiz\Utils;

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
}
