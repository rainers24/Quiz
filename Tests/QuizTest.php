<?php

namespace quiz\Tests;

use PHPUnit\Framework\TestCase;
use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Models\UserAnswerModel;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;

class QuizTest extends TestCase
{
    /** @var QuizRepository */
    private $quizRepository;


    public function setUp()
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

    public function testQuizRetrievalById()
    {
        $quiz = $this->quizRepository->getById(100);
        self::assertEquals(null, $quiz->id);

    }

    public function testSubmittedAnswerIsFound()
    {
        $repo = new UserAnswerRepository;

        $answer = new UserAnswerModel;
        $answer->quizId = 666;
        $answer->questionId = 13343;
        $answer->answerId = 23321;
        $answer->userId = 1117867;
        $repo->saveAnswer($answer);
        $answer = new UserAnswerModel;
        $answer->quizId = 222;
        $answer->questionId = 1;
        $answer->answerId = 1;
        $answer->userId = 111;

        $repo->saveAnswer($answer);


        $answersFound = $repo->getAnswers(111, 222);
        $answerFound = array_shift($answersFound);
        print_r($answersFound);

        self::assertEquals($answer, $answerFound);
    }


    public function testAddQuiz()
    {

        $quiz = $this->quizRepository->addQuiz(new QuizModel(0, 'another one '));

        $findQuiz = $this->quizRepository->getById(3);

        self::assertEquals($quiz, $findQuiz, 'Quiz successfully added');
    }

    function testAddAndGetQuestion()
    {
        $repo = new QuizRepository;
        $question = new QuestionModel;
        $question->quizId = 3;
        $question->question = "Capital of Latvia?";
        $repo->addQuestion($question);
        $testResult = $repo->getQuestions(3);
        $answerFound = reset($testResult);
        self::assertEquals("Riga", $answerFound->question);
    }

    function testAddAndGetQuizzes()
    {
        $repo = new QuizRepository();

        $quiz = new QuizModel();
        $quiz->name = "Latvia";
        $repo->addQuiz($quiz);

        $testResult = $repo->getList();

        $quiz1 = array_shift($testResult);


        self::assertEquals("Latvia", $quiz1->name);

    }
}




