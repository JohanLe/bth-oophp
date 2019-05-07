<?php

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
require "GuessException.php";

class Guess
{
    /**
     * @var int $numb The current secret number.
     * @var int $tries Number of tries a guess_org has been made.
     */

    private $secretNumber = 0;
    private $triesLeft = 0;
    private $isStarted = false;
    private $isCompleted = false;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $numb The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries Number of tries a guess_org has been made,
     *                    default 6.
     */

    public function __construct(int $numb = -1, int $tries = 6)
    {
        if (!$this->isStarted) {
            $this->random();
            $this->triesLeft = $tries;
            $this->hasStarted();
            $this->secretNumber = $numb;
        }
    }


    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        $this->secretNumber = rand(0, 100);
    }

    public function isStarted()
    {
        return $this->isStarted;
    }

    public function hasStarted()
    {
        $this->isStarted = true;
    }

    public function hasEnded()
    {
        $this->isStarted = false;
        $this->triesLeft = 6;
        $this->random();
        $this->isCompleted = false;
    }

    public function isCompleted()
    {
        return $this->isCompleted;
    }

    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return $this->triesLeft;
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->secretNumber;
    }


    /**
     * Make a guess_org, decrease remaining guesses and return a string stating
     * if the guess_org was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess_org made.
     */

    public function makeGuess($numb, $result = "")
    {
        if ($numb > 100 || $numb < 0 || $numb == "") {
            try {
                $gex = new GuessExeption();
                $gex->outOfRange();
            } catch (Exception $e) {
                $result = $e;
            }
        } elseif ($this->triesLeft <= 0) {
            $result = "All out of guesses";
            $this->isCompleted = true;
        } else {
            if ($numb < $this->secretNumber) {
                $result = "Your guess_org(" . $numb . ") is to low";
            } elseif ($numb > $this->secretNumber) {
                $result = "Your guess_org(" . $numb . ") is to high";
            } else {
                $result = "Your guess_org: " . $numb . " is CORRECT ";
                $this->isCompleted = true;
            }
            $this->triesLeft -= 1;
        }

        return $result;
    }
}
