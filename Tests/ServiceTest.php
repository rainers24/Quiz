<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 15/08/2018
 * Time: 8:56 AM
 */

namespace quiz\Tests;


use PHPUnit\Framework\TestCase;
use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\QuizRepository;
use Quiz\QuizService;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;

class ServiceTest extends TestCase
{
    private $quizRepository;
    private $quizService;
    private $UserAnswerRepository;


    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp();

        $this->quizRepository = new QuizRepository;

        $data = [
            'Country capitals' => [
                'Latvia' => [
                    'Riga' => true,
                    'Ventspils' => false,
                    'Jurmala' => false,
                    'Daugavpils' => false,
                ],
                'Lithuania' => [
                    'Kaunas' => false,
                    'Siaulia' => false,
                    'Vilnius' => true,
                    'Mazeikiai' => false,
                ],
                'Estonia' => [
                    'Talling' => true,
                    'Paarnu' => false,
                    'Tartu' => false,
                    'Valga' => false,
                ],
            ],
            'Questions' => [
                'Animal' => [
                    'Bear' => true,
                    'Ship' => false,
                    'Computer' => false,
                    'Shampoo' => false,
                ],
                'Car' => [
                    'Audi' => true,
                    'Dog' => false,
                    'Desk' => false,
                    'Ship' => false,
                ],
                'Computer' => [
                    'Animal' => false,
                    'Lenovo' => true,
                    'Refrigerator' => false,
                    'Apple' => true,
                ],

            ],
        ];


        $quizIds = 0;
        $questionIds = 0;
        $answerIds = 0;

        foreach ($data as $quizTitle => $questions) {
            $quiz = new QuizModel;
            $quiz->id = ++$quizIds;
            $quiz->name = $quizTitle;

            $this->quizRepository->addQuiz($quiz);

            foreach ($questions as $questionText => $answers) {
                $question = new QuestionModel;
                $question->quizId = $quiz->id;
                $question->id = ++$questionIds;
                $question->question = $questionText;

                $this->quizRepository->addQuestion($question);

                foreach ($answers as $answerText => $isCorrect) {
                    $a = new AnswerModel;
                    $a->id = ++$answerIds;
                    $a->answer = $answerText;
                    $a->isCorrect = $isCorrect;
                    $a->questionId = $question->id;
                }
            }
        }
    }

    public function testAnswerService()
    {


        $answers = $this->quizService->getAnswers(1);
        self::assertCount(4, $answers, 'Answer count matches');

    }

    public function testQuestionService()
    {
        $questions = $this->quizService->getQuestion(1);
        self::assertCount(3, $questions, 'Question count matches');

    }

    public function testListService()
    {

        $this->quizService = new QuizService;


        $lists = $this->quizService->getQuizes();
        self::assertCount(2, $lists, 'Quiz count matches');

    }


    public function testSubmitAnswerService()
    {
        $this->quizService = new QuizService;
        $this->UserAnswerRepository = new UserAnswerRepository;

        $answer = $this->quizService->submitAnswer(80 , 90 , 100);
        $answerfound = $this->UserAnswerRepository->getAnswers (80 ,90);
        $answerfound = array_shift($answerfound);
        self::assertEquals($answer, $answerfound, 'ok');

    }

    public function testisQuizCompletedService()
    {

    }

    public function testGetScoreService()
    {


    }


}

