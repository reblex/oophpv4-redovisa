<?php

namespace reblex\DiceGame;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class PlayerTest extends TestCase
{
    public function testRollReturns3IndexArray()
    {
        $player = new Player(3, "tester");
        $roll = $player->roll();

        $this->assertEquals(count($roll), 3);
    }

    public function testGetNameReturnsCorrectName()
    {
        $player = new Player(3, "tester");
        $name = $player->getName();

        $this->assertEquals($name, "tester");
    }

    public function testSumGetTotalCorrectSumTotal()
    {
        $player = new Player(3, "tester");
        $roll = $player->roll();

        $total = array_sum($roll);

        $player->sum();
        $testTotal = $player->getTotal();

        $this->assertEquals($total, $testTotal);
    }
}
