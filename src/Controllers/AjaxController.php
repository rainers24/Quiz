<?php

namespace Quiz\Controllers;

use Quiz\Models\User;
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

    public function __construct(
        UserRepository $userRepository,
        QuizRepository $quizRepository,
        QuestionRepository $questionRepository,
        AnswerRepository $answerRepository
    ) {
        if (!session_id()) {
            session_start();
        }
        $this->userRepository = $userRepository;
        $this->quizRepository = $quizRepository;
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
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

    public function getQuestion()
    {
        //return $this->questionRepository->getQuestions();
        return $this->answerAction();
    }

    public function answerAction()
    {

        $data =[] ;
        $data1 = [] ;
        $data2 = [];
        $data =  $this->questionRepository->getQuestions();
        $data1 = $this->answerRepository->getAnswers();
        $data2 = array_merge($data , $data1);
        //$data2 = array_map("unserialize", array_unique(array_map("serialize", $data2)));

        return $data2;

    }

    public function mergeAction($quizId){
       $data =[] ;
       $data1 = [] ;
       $data2 = [];
       $data =  $this->questionRepository->getQuestions($quizId);
       $data1 = $this->answerRepository->getAnswers();
       $data2 = array_merge($data , $data1);
        $data2 = array_map("unserialize", array_unique(array_map("serialize", $data2)));

        sort( $data2 );
        var_dump($data2);
       return $data2;




    }


    public function startAction()
    {
        $quizId = $this->post->get('quizId');
        $_SESSION['questionIndex'] = 0;
        $_SESSION['activeQuizId'] = $quizId;
        $name = $this->post->get('name');
        $user = $this->userRepository->create();
        $user->name = $name;
        $this->userRepository->save($user);

        return $this->getQuestion($quizId);
    }

    public function dfghjll(int $index = 0)
    {
        $questions = [
            [
                'id' => 1,
                'question' => 'asdasd',
                'answers' => [
                    [
                        'id' => 1,
                        'answer' => 'Visual Basic'
                    ],
                    [
                        'id' => 2,
                        'answer' => 'DirectX'
                    ],
                    [
                        'id' => 3,
                        'answer' => 'Batch'
                    ],
                    [
                        'id' => 4,
                        'answer' => 'C++'
                    ],
                ],
            ],
            [
                'id' => 2,
                'question' => 'What does HTML stand for?',
                'answers' => [
                    [
                        'id' => 1,
                        'answer' => 'Hyper Text Markup Language'
                    ],
                    [
                        'id' => 2,
                        'answer' => 'Home Tool Markup Language'
                    ],
                    [
                        'id' => 3,
                        'answer' => 'Hyperlinks and Text Markup Language'
                    ],
                ],
            ]
        ];

        if (!isset($questions[$index])) {
            return 'Have a nice day ! ';
        }

    }

    public function fff()
    {
        $answerId = $this->post->get('answerId');


        $index = isset($_SESSION['questionIndex']) ? (int)$_SESSION['questionIndex'] : 0;
        $index++;
        $answerId++;
        $_SESSION['questionIndex'] = $index;

        return $this->getQuestion($index);
    }
}