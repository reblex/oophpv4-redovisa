<?php
namespace reblex\DiceGame;

class Player
{
    private $diceHand;
    private $rolls;
    private $score;
    private $name;
    private $histogram;

    public function __construct($numDices, $name)
    {
        $this->diceHand = new DiceHand($numDices, 6);
        $this->histogram = new Histogram();
        $this->name = $name;
        $this->rolls = [];
        $this->score = 0;
    }

    public function getHistogram()
    {
        return $this->histogram->getAsText();
    }

    /**
     * Roll all dices in dicehand
     * @return array The roll
     */
    public function roll()
    {
        $roll = $this->diceHand->roll();
        array_push($this->rolls, $roll);

        $this->histogram->injectData($this->diceHand);
        return $roll;
    }

    /**
     * Return player name
     * @return string Name of player
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sum current rolls and add to score.
     * Then clear the rolls.
     */
    public function sum()
    {
        $this->score += $this->getRollSum();
        $this->clearRolls();
    }

    /**
     * Reset all rolls
     */
    public function clearRolls()
    {
        $this->rolls = [];
    }

    /**
     * Return score sum of current rounds rolls.
     * @return int Current roll total
     */
    public function getRollSum()
    {
        $rollSum = 0;
        foreach ($this->rolls as $roll) {
            $rollSum += array_sum($roll);
        }
        return $rollSum;
    }

    /**
     * Get the sum of all current rolls and the current score.
     * @return int Total score
     */
    public function getTotal()
    {
        return $this->getRollSum() + $this->score;
    }
}
