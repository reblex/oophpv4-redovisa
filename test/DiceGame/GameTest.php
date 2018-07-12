<?php

namespace reblex\DiceGame;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class GameTest extends TestCase
{
    public function testGetStatusIsString()
    {
        $game = new Game(3, "tester");
        $status = $game->getStatus();

        $this->assertTrue(is_string($status), true);
    }

    public function testGetScoreIs0Initially()
    {
        $game = new Game(3, "tester");
        $score = $game->getScore();

        $this->assertEquals($score, " Round: 0 Total: 0<br>");
    }

    public function testGetGameOverFalseAtStart()
    {
        $game = new Game(3, "tester");
        $gameOver = $game->getGameOver();

        $this->assertFalse($gameOver);
    }

    public function testNextPlayerWithGetCurrentPlayerIndex()
    {
        $game = new Game(3, "tester");
        $reflector = new \ReflectionClass('\reblex\DiceGame\Game');
        $method = $reflector->getMethod('nextPlayer');
        $method->setAccessible(true);

        $firstPlayer = $game->getCurrentPlayerIndex();
        $method->invokeArgs($game, array());
        $secondPlayer = $game->getCurrentPlayerIndex();

        $exp = $firstPlayer == 0 ? 1 : 0;

        $this->assertEquals($secondPlayer, $exp);
    }

}
