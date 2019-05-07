<?php
/**
 * Created by PhpStorm.
 * User: Ledel
 * Date: 2019-04-15
 * Time: 14:30
 */

require "config.php";

var_dump($_POST);
$number = $_POST['userGuess'];

if (isset($_POST['restart'])) {
    $_SESSION['gameStatus'] = null;
    $_SESSION['game']->hasEnded();
    $_SESSION['cheat'] = false;
    $_SESSION['completed'] = false;
} elseif ($_POST['cheat']) {
    $_SESSION['cheat'] = true;
} elseif ($_SESSION['game']) {
    $game = $_SESSION['game'];
    $_SESSION['gameStatus'] = $game->makeGuess($number);

    if ($game->isCompleted()) {
        $_SESSION['completed'] = true;
    }
}


$url = "index.php";
header("Location: $url");
