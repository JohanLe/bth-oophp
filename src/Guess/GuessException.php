<?php
/**
 * Created by PhpStorm.
 * User: Ledel
 * Date: 2019-04-11
 * Time: 21:32
 *
 * Exeption / Error handling
 */

namespace Joll18\Guess;

class GuessExeption extends \Exception
{
    public function outOfRange()
    {
        throw new Exception('Guess out of range. Keep it 0-100');
    }
}
