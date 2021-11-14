<?php

namespace Oquiz\Models;

class QuestionModel
{
    private $id;
    private $id_quiz;
    private $question;
    private $prop1;
    private $prop2;
    private $prop3;
    private $prop4;
    private $anecdote;
    private $wiki;
    private $level;
    private $props;

    /*GETTERS */
    public function getId()
    {
        return $this->id;
    }

    public function getIdQuiz()
    {
        return $this->id_quiz;
    }
    public function getQuestion()
    {
        return $this->question;
    }
    public function getProp1()
    {
        return $this->prop1;
    }
    public function getProp2()
    {
        return $this->prop2;
    }
    public function getProp3()
    {
        return $this->prop3;
    }
    public function getProp4()
    {
        return $this->prop4;
    }
    public function getLevel()
    {
        return $this->level;
    }
    public function getAnecdote()
    {
        return $this->anecdote;
    }
    public function getWiki()
    {
        return $this->wiki;
    }

    public function getProps()
    {
        return $this->props;
    }



    /*SETTERS*/
    public function setId(int $id)
    {
        if (!empty($id)) {
            $this->id = $id;
        }
    }
    public function setIdQuiz($idQuiz)
    {
        if (!empty($idQuiz)) {
            $this->id_quiz = $idQuiz;
        }
    }

    public function setQuestion($question)
    {
        if (!empty($question)) {
            $this->question = $question;
        }
    }
    public function setProp1($prop1)
    {
        if (!empty($prop1)) {
            $this->prop1 = $prop1;
        }
    }
    public function setProp2($prop2)
    {
        if (!empty($prop2)) {
            $this->prop2 = $prop2;
        }
    }
    public function setProp3($prop3)
    {
        if (!empty($prop3)) {
            $this->prop3 = $prop3;
        }
    }
    public function setProp4($prop4)
    {
        if (!empty($prop4)) {
            $this->prop4 = $prop4;
        }
    }

    public function setLevel($level)
    {
        if (!empty($level)) {
            $this->level= $level;
        }
    }
    public function setAnecdote($anecdote)
    {
        if (!empty($anecedote)) {
            $this->anecdote = $anecdote;
        }
    }

    public function setWiki($wiki)
    {
        if (!empty($wiki)) {
            $this->wiki= $wiki;
        }
    }

    public function setProps($props)
    {
        if (!empty($props)) {
            $this->props = $props;
        }
    }
}
