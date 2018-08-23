<?php

namespace Quiz\Controllers;

use Quiz\Models\User;
use Quiz\QuizService;
use Quiz\Repositories\AnswerRepository;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserRepository;

class AjaxController extends BaseAjaxController
{
    /** @var UserRepository */
    protected $userRepository;
    protected $quizRepository;
    protected $questionRepository;
    protected $answerRepository;
    private $quizService;

    public function __construct(
        UserRepository $userRepository,
        QuizRepository $quizRepository,
        QuestionRepository $questionRepository,
        AnswerRepository $answerRepository,
        Quizservice $quizService
    ) {
        if (!session_id()) {
            session_start();
        }
        $this->userRepository = $userRepository;
        $this->quizRepository = $quizRepository;
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->quizService = $quizService;
    }


    public function saveUserAction()
    {
        $name = $this->post->get('name');
        /** @var User $user */
        $user = $this->userRepository->create();
        $user->name = $name;
        $this->userRepository->save($user);

        return $user;
    }

    public function getAllQuizzesAction()
    {
        return $this->quizRepository->all();
    }

    public function getQuestions($quizId)
    {
        return $this->questionRepository->getQuestions($quizId);
    }

    public function hjklkjhgjklkjh()
    {

        $data = [];
        $data1 = [];
        $data2 = [];
        $data = $this->questionRepository->getQuestions(1);

        $data1 = $this->answerRepository->getAnswers(1);
        $data2 = array_merge($data, $data1);
        //$data2 = array_map("unserialize", array_unique(array_map("serialize", $data2)));

        return $data2;

    }

//    public function mergeAction($quizId)
//    {
//        $data = [];
//        $data1 = [];
//        $data2 = [];
//        $data = $this->questionRepository->getQuestions();
//        $data1 = $this->answerRepository->getAnswers();
//        $data2 = array_merge($data, $data1);
//        $data2 = array_map("unserialize", array_unique(array_map("serialize", $data2)));
//
//        sort($data2);
//        var_dump($data2);
//        return $data2;
//
//
//    }


    public function startAction()
    {
        $quizId = $this->post->get('quizId');
        $_SESSION['questionIndex'] = 1;
        $_SESSION['activeQuizId'] = $quizId;
        $name = $this->post->get('name');
        $user = $this->userRepository->create();
        $user->name = $name;
        $this->userRepository->save($user);

        return $this->getNextQuestionAnswer($quizId, $questionindex);
    }



//    public function fff()
//    {
//        $answerId = $this->post->get('answerId');
//
//
//        $index = isset($_SESSION['questionIndex']) ? (int)$_SESSION['questionIndex'] : 0;
//        $index++;
//        $answerId++;
//        $_SESSION['questionIndex'] = $index;
//
//        return $this->getQuestion($index);
//    }

    public function getNextQuestionAnswer($quizId, &$questionindex)
    {
        $question = $this->quizService->getNextQuestion($quizId, $questionindex);

        $answers = $this->answerRepository->getAnswers($question->id);
        $questionWithAnswers = [];

        $questionWithAnswers['id'] = $question->id;
        $questionWithAnswers['question'] = $question->question;

        $questionWithAnswers['answers'] = [];


        foreach ($answers as $questionAnswer) {
            $answer = [];
            $answer['id'] = $questionAnswer->id;
            $answer['answer'] = $questionAnswer->answer;

            array_push($questionWithAnswers['answers'], $answer);
        }
        return $questionWithAnswers;
    }


    public function answerAction()
    {

        $question = $this->getNextQuestionAnswer($_SESSION['activeQuizId'], $_SESSION['questionIndex']);

        if($question['id'] === null){
            return "malacis, tu esi kko pabeidzis";
        }


        return $question;
    }



}