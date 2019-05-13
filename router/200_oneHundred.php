<?php

$app->router->get("oneHundred/init", function () use ($app) {
    /* init the session for the gamestart
    * and send to game play
    */

    resetGame();

    return $app->response->redirect("oneHundred/game");
});

$app->router->get("oneHundred/game", function () use ($app) {
    /*
     * Gather data from session. Send it to view.
     */
    $playerPost = $_SESSION['player'] ?? [];
    $computerPost = $_SESSION['computer'] ?? [];
    $title = "OneHundred-Game";
    $player = [
        "score" => $playerPost['score'] ?? 0,
        "rolls" => $playerPost['rolls'] ?? [],
        "tempScore" => $playerPost['tempScore'] ?? 0,
        "myTurn" => $playerPost['myTurn'] ?? true,
        "win" => $playerPost['win'] ?? false
    ];
    $computer = [
        "score" => $computerPost['score'] ?? 0,
        "rolls" => $computerPost['rolls'] ?? [],
        "tempScore" => $computerPost['tempScore'] ?? 0,
        "myTurn" => $computerPost['myTurn'] ?? false,
        "win" => $computerPost['win'] ?? false
    ];

    if ($player['score'] >= 100) {
        $player['win'] = true;
        $computer['myTurn'] = false;
    } elseif ($computer['score'] >= 100) {
        $computer['win'] = true;
        $player['myTurn'] = false;
    }

    $data = [
        "player" => $player,
        "computer" => $computer
    ];

    // Add view to app
    $app->page->add("/oneHundred/game", $data);
    //$app->page->add("/oneHundred/debug");

    // Render app/View
    return $app->page->render([
        "title" => $title,
    ]);
});


$app->router->post("oneHundred/game", function () use ($app) {
    // When ever player / computer pressed "save" or lost play
    $request = new \Anax\Request\Request();
    $oneH = $_SESSION["game"] ?? new Joll18\OneHundred\OneHundred();
    $player = $_SESSION['player'] ?? [];
    $computer = $_SESSION['computer'] ?? [];

    $doRoll = $request->getPost("roll", false) ?? null;
    $doSave = $request->getPost("save", false) ?? null;
    $doCompRoll = $request->getPost("compRoll", false) ?? null;
    $doReset = $request->getPost("reset", false) ?? null;

    if ($doRoll) {
        $players = $oneH->doRoll($player, $computer);
        $player = $players['target'];
        $computer = $players['opponent'];
    }
    if ($doSave) {
        $player['score'] = $player['score'] + $player['tempScore'];
        $player['tempScore'] = 0;
        $player['myTurn'] = false;
        $computer['myTurn'] = true;
    }
    if ($doCompRoll) {
        $players = $oneH->doRoll($computer, $player);
        $player = $players['opponent'];
        $computer = $players['target'];
        $computer['score'] += $computer['tempScore'];
        $player['myTurn'] = true;
        $computer['myTurn'] = false;
    }
    $_SESSION['player'] = $player;
    $_SESSION['computer'] = $computer;


    return $app->response->redirect("oneHundred/game");
});

/*
 * Resets the game
 */
function resetGame()
{
    session_destroy();
    $oneH = new Joll18\OneHundred\OneHundred();
    $name = preg_replace("/[^a-z\d]/i", "", __DIR__);

    session_name($name);
    session_start();
    $_SESSION['game'] = $oneH;
    $_SESSION['player'] = [];
    $_SESSION['computer'] = [];
}
