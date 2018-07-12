<?php

namespace reblex\DiceGame;

class DiceHand implements HistogramInterface
{
    use HistogramTrait;

    private $dices;

    /**
     * Constructor to create a Dice Hand.
     *
     * @param int    $dices  The number of dices.
     * @param int    $faces  The number of faces for the dices.
     */
    public function __construct(int $dices = 3, int $faces = 6)
    {
        if (!(is_int($faces) && $faces >= 0)) {
            throw new Exception("Unallowed faces value.");
        }

        if (!(is_int($dices) && $dices >= 0)) {
            throw new Exception("Unallowed dices value.");
        }

        $this->dices = [];
        for ($i=0; $i < $dices; $i++) {
            array_push($this->dices, new Dice($faces));
        }
    }

    // Overload get Max to always show maximum possible(faces),
    // not only maximum rolled.
    public function getHistogramMax()
    {
        return $this->dices[0]->getFaces();
    }

    /**
     * Roll all dices
     * @return array outcome of all dices
     */
    public function roll()
    {
        foreach ($this->dices as $dice) {
            $dice->roll();
        }
        $outcome = $this->getOutCome();
        array_push($this->serie, $outcome);

        return $outcome;
    }


    /**
     * Get the outcome of the last roll
     * @return array outcome of all dices
     */
    public function getOutcome()
    {
        $outcome = [];
        foreach ($this->dices as $dice) {
            array_push($outcome, $dice->getOutcome());
        }
        return $outcome;
    }
}
