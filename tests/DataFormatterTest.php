<?php

use Oquiz\Models\QuizModel;
use Oquiz\Utils\DataFormatter;
use PHPUnit\Framework\TestCase;

class DataFormatterTest extends TestCase
{
    /**
     * @covers DataFormatter::formatQuizzWithAuthor
     */
    public function testFormatQuizzWithAuthor()
    {
        $data =['id'=>1,'title'=>'mytitle','description'=>'quiz description',
        'first_name'=>'john','last_name'=>'Doe','author_id'=>2];

        $dataFormatter = new DataFormatter();
        $quiz = $dataFormatter->formatQuizzWithAuthor($data);
        $this->assertInstanceOf(QuizModel::class, $quiz);
        return $quiz;
    }

    /**
     * @depends testFormatQuizzWithAuthor
     * @covers DataFormatter::formatQuizzWithAuthor
     */
    public function testFormatQuizzValues($quiz)
    {
        $this->assertEquals(1, $quiz->getId());
        $this->assertEquals('mytitle', $quiz->getTitle());
        $this->assertEquals('quiz description', $quiz->getDescription());
        $this->assertEquals('john', $quiz->getAuthor()->getFirstName());
        $this->assertEquals('Doe', $quiz->getAuthor()->getLastName());
        $this->assertEquals(2, $quiz->getAuthor()->getId());
    }

    /**
     * @covers DataFormatter::formatQuizzQuestions
     */
    public function testFormatQuizzQuestions()
    {
        $data=['qid'=>1,'question'=>'my question','level'=>'easy',
        'prop1'=>1,'prop2'=>2,'prop3'=>3,'prop4'=>4, 'wiki'=> 'my wiki', 'anecdote'=>'my anecdote'];
    }
}
