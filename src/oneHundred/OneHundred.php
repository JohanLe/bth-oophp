<?php
/**
 * Created by PhpStorm.
 * User: Ledel
 * Date: 2019-05-10
 * Time: 09:43
 */

namespace Joll18\OneHundred;

class OneHundred
{
    private $dices;
    private $sides;

    public function __construct($dices = 3, $sides = 6)
    {
        $this->dices = $dices;
        $this->sides = $sides;
    }

    public function rollDices()
    {
        $rolls = [];
        for ($i = 0; $i < $this->dices; $i++) {
            $roll = mt_rand(1, $this->sides);
            array_push($rolls, $roll);
        }
        return $rolls;
    }

    public function calculateScore($rolls)
    {
        $total = 0;
        foreach ($rolls as $value) {
            $total += $value;
        }
        return $total;
    }

    public function doRoll($target, $opponent)
    {
        $opponent['rolls'] = [];
        $roll = $this->rollDices();
        $opponent['tempScore'] = 0;

        if (!in_array(1, $roll)) {
            $tempScore = $this->calculateScore($roll);
            $target['rolls'] = $roll;
            $target['tempScore'] = $target['tempScore'] + $tempScore;
        } else {
            $target['rolls'] = $roll;
            $target['tempScore'] = 0;
            $target['myTurn'] = false;
            $opponent['myTurn'] = true;
        }
        return [
            "target" => $target,
            "opponent" => $opponent
        ];
    }
}
