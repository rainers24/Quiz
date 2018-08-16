<?php
/**
 * Created by PhpStorm.
 * User: rainerskniss
 * Date: 16/08/2018
 * Time: 10:29 AM
 */

namespace Quiz;


class BowlingCalculator

{

    private $throws = [];

    public function throw(int $hits)
    {
        $this->throws[] = $hits;

    }

    public function getScore(): int
    {
        $score = 0;
        $currentthrow = 0;
        for ($i = 0; $i < 10; $i++) {
            if($this->isStrike($currentthrow)){
            if ($this->isSpare($currentthrow)) {
                $score += $this->addSpare($currentthrow);

            } else {
                $score += $this->throws[$currentthrow] + $this->throws[$currentthrow + 1];
            }


            $currentthrow += 2;
        }}
        return $score;
    }

    /**
     * @param $currentthrow
     * @return bool
     */
    public function isSpare($currentthrow): bool
    {
        return $this->throws[$currentthrow] + $this->throws[$currentthrow + 1] == 10;
    }

    /**
     * @param $currentthrow
     * @return int
     */
    public function addSpare($currentthrow): int
    {
        return $this->addNormal($currentthrow) + $this->throws[$currentthrow + 2];
    }

    /**
     * @param $currentthrow
     * @return bool
     */
    public function isStrike($currentthrow): bool
    {

        return $this->addNormal($currentthrow) == 10;

    }

    /**
     * @param $currentthrow
     * @return int
     */
    public function addStrike ($currentthrow): int{

        return 10 + $this->throws[$currentthrow +1] + $this->throws[$currentthrow+2];


    }

    /**
     * @param $currentthrow
     * @return int
     */
    public function addNormal($currentthrow): int
    {
        return $this->throws[$currentthrow] + $this->throws[$currentthrow + 1];
    }
}