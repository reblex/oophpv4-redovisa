<?php

namespace reblex\DiceGame;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceHandTest extends TestCase
{
    public function testConstructDefaultGeneratesDices()
    {
        $diceHand = new DiceHand();

        $outcome = $diceHand->getOutcome();

        $this->assertTrue(isset($outcome));
    }

    public function testRoll()
    {
        $diceHand = new DiceHand(5);

        $outcome = $diceHand->roll();

        $this->assertEquals(count($outcome), 5);
    }
}
