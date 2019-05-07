<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Init the game, redirect to play the game
 */
$app->router->get("guess/init", function () use ($app) {
    // init the session for the gamestart

    $guess = new Joll18\Guess\Guess();
    $name = preg_replace("/[^a-z\d]/i", "", __DIR__);

    session_name($name);
    session_start();
    $guess->random();
    $_SESSION['number'] = $guess->number();
    $_SESSION['triesLeft'] = 6;
    $_SESSION['doCheat'] = false;
    $_SESSION['reset'] = false;
    $_SESSION['result'] = "";


    return $app->response->redirect("guess/play");
});


/**
 * Gathers data from $_session
 * Play the game, adds view to app and then renders the page with data.
 */
$app->router->get("guess/play", function () use ($app) {

    $title = "Guess the number";
    $data = [
        "title" => $title,
        "number" => $_SESSION['number'],
        "triesLeft" => $_SESSION['triesLeft'],
        "doCheat" => $_SESSION['doCheat'],
        "reset" => $_SESSION['reset'],
        "result" => $_SESSION['result']
    ];

    $app->page->add("/guess/play", $data);
//    $app->page->add("/guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/*
 * $_post - handler
 * When user pressed any of Guess/Cheat/Reset buttons.
 * Checks user input, responds and set new values to $_session
 * Redirects to guess/play
 */
$app->router->post("guess/play", function () use ($app) {


    $number = $_SESSION['number'];
    $triesLeft = $_SESSION['triesLeft'];
    $userGuess = $_POST['userGuess'] ?? null;
    $doCheat = $_POST['doCheat'] ?? null;
    $reset = $_POST['reset'] ?? null;
    $result = "";

    if ($doCheat) {
        $_SESSION['doCheat'] = true;
    }
    if ($reset) {
        return $app->response->redirect("guess/init");
    }
    if (!$doCheat) {
        $triesLeft = $triesLeft - 1;
        if ($userGuess == $number) {
            $result = $userGuess . " is correct! Well done";
            $_SESSION['triesLeft'] = 0;
        } elseif ($userGuess > $number) {
            $result = "Your guess (" . $userGuess . ")  was to HIGH. Try again";
            $_SESSION['triesLeft'] = $triesLeft;
        } else {
            $result = "Your guess (" . $userGuess . ") was to LOW. Try again";
            $_SESSION['triesLeft'] = $triesLeft;
        }
        if ($triesLeft < 1 && $userGuess != $number) {
            $result = "You are out of guesses. Thank you for playing." .
                "</br>Correct number was: " . $number;
        }
    }
    $_SESSION['result'] = $result;

    return $app->response->redirect("guess/play");
});
