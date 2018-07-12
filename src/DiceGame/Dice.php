<?php

namespace reblex\DiceGame;

class Dice
{
    private $faces;
    protected $outcome;

    /**
     * Constructor to create a Dice.
     *
     * @param int    $faces  Number of dice faces.
     */
    public function __construct(int $faces = 6)
    {
        if (!(is_int($faces) && $faces >= 0)) {
            throw new Exception("Unallowed faces value.");
        }

        $this->faces = $faces;
    }

    public function getFaces()
    {
        return $this->faces;
    }


    /**
     * Get the outcome of the last roll
     * @return int Last roll outcome
     */
    public function getOutcome()
    {
        return $this->outcome;
    }


    /**
     * Roll the dice and return the outcome
     * @return int The roll outcome
     */
    public function roll()
    {
        $this->outcome = rand(1, $this->faces);
        return $this->outcome;
    }
}
