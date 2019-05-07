<?php
namespace Joll18\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
require "GuessException.php";

class Guess
{
    /**
     * @var int $secretNumber The current secret number.
     * @var int $triesLeft Number of tries a guess_org has been made.
     */

    private $secretNumber = 0;
    private $triesLeft = 0;


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

            $this->random();
            $this->triesLeft = $tries;
            $this->secretNumber = $numb;
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

}
