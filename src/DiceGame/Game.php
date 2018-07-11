<?php

namespace reblex\DiceGame;

class Game
{
    private $players;
    private $currentPlayer;
    private $status;
    private $gameOver;
    private $aiGame;
    private $history;
    private $score;


    public function __construct(int $numPlayers, int $numDices, bool $aiGame = true)
    {
        // Initiate Players
        $this->players = [];
        for ($i=0; $i < $numPlayers; $i++) {
            $player = new Player($numDices);
            array_push($this->players, $player);
        }

        // Determine first player at random.
        $this->currentPlayer = rand(0, $numPlayers - 1);

        $this->gameOver = false;
        $current = $this->currentPlayer + 1;
        $this->aiGame = $aiGame;
        $this->status = "Each player rolls a die to find out who goes first...<br>";
        $this->status .= "Player $current starts!<br><br>";
        $this->score = " Round: " . $player->getRollSum() . " Total: " . $player->getTotal() . "<br>";
        $this->history = [];
        $this->addHistory("Player $current starts.<br>");
    }


    /*
        --- Public Functions --
     */


    /**
     * Get the game status
     * @return string The current game status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the current score string
     * @return string The current score string
     */
    public function getScore()
    {
        return $this->score;
    }


    /**
     * Get gameOver boolean
     */
    public function getGameOver()
    {
        return $this->gameOver;
    }


    /**
     * Get currentPlayer
     * @return int The current player
     */
    public function getCurrentPlayer()
    {
        return $this->currentPlayer;
    }

    /**
     * Return the game history, alt. what has happened during the game
     * @return array History of what has happened
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Return if the other players are AI.
     * @return bool If it is an AI game or not
     */
    public function hasAI()
    {
        return $this->aiGame;
    }

    /**
     * Roll the diceHand of currentPlayer
     */
    public function roll()
    {
        if ($this->gameOver) {
            return;
        }
        $player = $this->players[$this->currentPlayer];
        $outcome = $player->roll();

        $current = $this->currentPlayer + 1;
        $this->status = "Your Roll: " . $this->getRollString($outcome) . "<br>";
        $readableOutcome = $this->getRollString($outcome);
        $this->addHistory("Player $current rolls: $readableOutcome<br>");

        // If one of the dices rolled a 1
        if (in_array(1, $outcome)) {
            $player->clearRolls();

            // Go to the next player in turn
            $this->nextPlayer();
            $current = $this->currentPlayer + 1;
            $this->status = "You rolled a 1 and lost this rounds points. The turn passes to player $current.<br>";
            $this->addHistory("Player $current's turn<br>");
        } else {
            $this->score = " Round: " . $player->getRollSum() . " Total: " . $player->getTotal() . "<br>";
            if ($player->getTotal() >= 100) {
                $this->gameOver = true;
                $current = $this->currentPlayer + 1;
                $this->status .= "<br>Player {$current} wins!<br>";
                $this->addHistory("Player $current wins!<br>");
            }
        }
    }


    /**
     * Sum current round score with total and advance
     * game to next player.
     */
    public function stop()
    {
        $player = $this->players[$this->currentPlayer];
        $player->sum();
        $current = $this->currentPlayer + 1;
        $this->addHistory("Player $current stops. Current score: {$player->getTotal()}<br>");
        $this->nextPlayer();
        $current = $this->currentPlayer + 1;
        $this->addHistory("Player $current's turn.<br>");
    }


    /**
     * Play all AIs
     */
    public function playAIs()
    {
        // While it is not the humans turn yet.
        while ($this->currentPlayer != 0) {
            $player = $this->players[$this->currentPlayer];

            // The super fancy AI logic.
            // Roll while current rounds total is less than 10.
            if ($player->getRollSum() < 10) {
                $this->roll();
            } else {
                $this->stop();
            }
        }
    }



    /*
        --- Private Functions --
     */



    /**
     * Add event to game history.
     * Latest event first in array.
     * @param string $str The event
     */
    private function addHistory($str)
    {
        array_unshift($this->history, $str);
    }

    /**
     * Go to the next player in turn
     */
    private function nextPlayer()
    {
        if ($this->currentPlayer == count($this->players) - 1) {
            $this->currentPlayer = 0;
        } else {
            $this->currentPlayer++;
        }
        $player = $this->players[$this->currentPlayer];
        $this->score = " Round: " . $player->getRollSum() . " Total: " . $player->getTotal() . "<br>";
    }

    /**
     * Get human readable roll outcome
     * @param array $roll roll outcome
     * @return string
     */
    private function getRollString($roll)
    {
        $str = "";
        for ($i=0; $i < count($roll); $i++) {
            $str .= $roll[$i];

            if ($i != count($roll) - 1) {
                $str .= ", ";
            }
        }
        return $str;
    }
}
