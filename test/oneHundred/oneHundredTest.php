<?php

/**
 * Created by PhpStorm.
 * User: Ledel
 * Date: 2019-05-10
 * Time: 09:42
 */

use PHPUnit\Framework\TestCase;

class OneHundredTest extends TestCase
{

//    RollDices
    public function testRollDice()
    {
        $oneH = new Joll18\OneHundred\OneHundred();
        $rolls = $oneH->rollDices();
        $this->assertSame(3, count($rolls));
    }


    public function testCalculateScore()
    {
        $oneH = new Joll18\OneHundred\OneHundred();
        $testArray = [3, 6, 3];
        $res = $oneH->calculateScore($testArray);
        $this->assertSame(12, $res);
    }

    /*
     * Create 2 players, make a "roll" and se if myTurn variables in
     * each player is still diffrent after the roll.
     */
    public function testDoRoll()
    {
        $testPlayer1 = [
            "score" => 0,
            "tempScore" => 0,
            "roll" => [],
            "myTurn" => true,
        ];
        $testPlayer2 = [
            "score" => 0,
            "tempScore" => 0,
            "roll" => [],
            "myTurn" => false,
        ];
        $oneH = new Joll18\OneHundred\OneHundred();
        $res = $oneH->doRoll($testPlayer1, $testPlayer2);
        $player1 = $res["target"];
        $player2 = $res["opponent"];

        $this->assertSame(!$player1['myTurn'], $player2['myTurn']);
        $this->assertSame(3, count($player1['rolls']));
    }
}
