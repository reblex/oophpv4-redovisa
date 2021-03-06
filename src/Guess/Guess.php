<?php

namespace reblex\Guess;

/**
 * A class for handling guesses.
 */
class Guess
{
    /**
     * Variables
     */
    private $number;
    private $guessesLeft;
    private $guess;


    /**
     * Constructor
     * @param integer $num         Correct number, null to generate random.
     * @param integer $guessesLeft Number of guesses left, null for 6.
     */
    public function __construct($num, $guessesLeft)
    {
        $this->number = is_null($num) ? rand(1, 100) : $num;
        $this->guessesLeft = is_null($guessesLeft) ? 6 : $guessesLeft;
    }

    public function setGuess($guess)
    {
        $this->guess = $guess;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setGuessesLeft($guesses)
    {
        $this->guessesLeft = $guesses;
    }

    /**
     * Make a guess.
     * @param  integer $guess Guessed number.
     * @return String         Answer to guessed number compared with correct number.
     */
    public function makeGuess($guess)
    {
        if (!is_numeric($guess)) {
            throw new GuessException("Guess is not integer");
        }
        if ($guess < 1 || $guess > 100) {
            throw new GuessException("Guess is out of bounds");
        }
        if ($this->guessesLeft > 0) {
            $this->guessesLeft--;
            if ($guess == $this->number) {
                return "<b>correct!</b>";
            }
            if ($guess > $this->number) {
                return "<b>too high...</b>";
            }
            if ($guess < $this->number) {
                return "<b>too low...</b>";
            }
        }
    }


    /**
     * Return the correct number.
     * @return integer Correct number.
     */
    public function getNumber()
    {
        return $this->number;
    }


    public function getGuess()
    {
        return $this->guess;
    }

    /**
     * Return amount of guesses left.
     * @return integer Guesses left.
     */
    public function getGuessesLeft()
    {
        return $this->guessesLeft;
    }
}
