<?php

namespace reblex\DiceGame;

class Game
{
    private $players;
    private $currentPlayer;
    private $status;
    private $gameOver;
    private $playerName;
    private $history;
    private $score;


    public function __construct($numDices, $playerName)
    {
        // Initiate Players
        $this->players = [];
        array_push($this->players, new Player($numDices, $playerName));
        array_push($this->players, new Player($numDices, "AI"));

        // Determine first player at random.
        $this->currentPlayer = rand(0, 1);

        $this->gameOver = false;
        $this->playerName = $playerName;
        $this->status = "Each player rolls a die to find out who goes first...<br>";
        $player = $this->players[$this->currentPlayer];
        $playerName = $player->getName();
        $this->status .= "$playerName starts!<br><br>";
        $this->score = " Round: " . $player->getRollSum() . " Total: " . $player->getTotal() . "<br>";
        $this->history = [];
        $this->addHistory("$playerName starts.<br>");
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
     * Get Current Players name
     * @return int The current players name
     */
    public function getCurrentPlayer()
    {
        return $this->players[$this->currentPlayer]->getName();
    }

    /**
     * Get currentPlayer index
     * @return int The current player
     */
    public function getCurrentPlayerIndex()
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
     * Roll the diceHand of currentPlayer
     */
    public function roll()
    {
        if ($this->gameOver) {
            return;
        }
        $player = $this->players[$this->currentPlayer];
        $outcome = $player->roll();

        $this->status = "Your Roll: " . $this->getRollString($outcome) . "<br>";
        $readableOutcome = $this->getRollString($outcome);
        $this->addHistory("{$player->getName()} rolls: $readableOutcome<br>");

        // If one of the dices rolled a 1
        if (in_array(1, $outcome)) {
            $player->clearRolls();

            // Go to the next player in turn
            $this->nextPlayer();
            $playerName = $this->players[$this->currentPlayer]->getName();
            $this->status = "You rolled a 1 and lost this rounds points. The turn passes to player $playerName.<br>";
            $this->addHistory("$playerName's turn<br>");
        } else {
            $this->score = " Round: " . $player->getRollSum() . " Total: " . $player->getTotal() . "<br>";
            if ($player->getTotal() >= 100) {
                $this->gameOver = true;
                $this->status .= "<br>$playerName wins!<br>";
                $this->addHistory("$playerName wins!<br>");
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
        $playerName = $this->players[$this->currentPlayer]->getName();
        $this->addHistory("$playerName stops. Current score: {$player->getTotal()}<br>");
        $this->nextPlayer();
        $playerName = $this->players[$this->currentPlayer]->getName();
        $this->addHistory("$playerName's turn.<br>");
    }


    /**
     * Play all AIs
     */
    public function playAI()
    {
        $player = $this->players[$this->currentPlayer];

        // While it is still the AI's turn.
        while ($this->currentPlayer != 0) {
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
