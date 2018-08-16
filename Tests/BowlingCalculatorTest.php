<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 16/08/2018
 * Time: 10:30 AM
 */


namespace quiz\Tests;


use PHPUnit\Framework\TestCase;
use Quiz\BowlingCalculator;

class BowlingCalculatorTest extends TestCase
{
    /** @var BowlingCalculator */
    private $calculator;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp();
        $this->calculator = new BowlingCalculator();

    }

    public function test_with_simple_hits()
    {

        for ($i = 0; $i < 20; $i++) {
            $this->calculator->throw(1);
        }
        $score = $this->calculator->getScore();
        $this->assertEquals(20, $score);
    }


    public function test_with_spare()
    {


        $this->calculator->throw(5);
        $this->calculator->throw(5);
        $this->calculator->throw(3);

        for ($i = 0; $i < 17; $i++) {
            $this->calculator->throw(1);
        }

        $score = $this->calculator->getScore();
        $this->assertEquals(33, $score);

    }


    public function test_withnohits_returns0()
    {
        for ($i = 0; $i < 20; $i++) {
            $this->calculator->throw(0);
        }
        $score = $this->calculator->getScore();
        $this->assertEquals(0, $score);
    }

    public function test_withstrike_should_add_points_to_next_throws(){

        $this->calculator->throw(10);
        $this->calculator->throw(5);
        $this->calculator->throw(1);


        for ($i = 0; $i < 16; $i++) {
            $this->calculator->throw(1);
        }

        $score = $this->calculator->getScore();
        $this->assertEquals(38, $score);

    }

    /// todo uzmest 10 straikus

}