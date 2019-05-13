<?php

namespace Anax\View;

/**
 * Render content
 */
// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<div class="container">
    <div class="game-half">
        <div class="game-header">
            <h3>Player</h3>
            <p> Score: <?= $player['score'] ?> / 100 </p>
        </div>
        <div class="game-dice-field">
            <?php
            echo("<p> Roll: ");
            foreach ($player['rolls'] as $roll) {
                echo($roll . ", ");
            }
            if ($player['rolls'] != []) {
                echo($player['tempScore'] . "p");
            }
            echo("</p>");
            ?>
        </div>
        <?php if ($player['myTurn']) { ?>
            <div>
                <form method="post">
                    <input type="submit" class="btn game-btn-roll" name="roll" value="Roll">
                    <?php
                    if ($player['tempScore'] > 0) {
                        echo('<input type="submit" class="btn game-btn-save" name="save" value="Save">');
                    }
                    ?>
                </form>
            </div>
        <?php }
        if ($player['win']) {
            echo("You won !");
        }
        ?>

    </div>

    <div class="game-half">
        <div class="game-header">
            <h3>Computer</h3>
            <p> Score: <?= $computer['score'] ?> / 100 </p>
        </div>
        <div class="game-dice-field">
            <?php
            echo("<p> Roll: ");
            foreach ($computer['rolls'] as $roll) {
                echo($roll . ", ");
            }
            if ($computer['rolls'] != []) {
                echo($computer['tempScore'] . "p");
            }
            echo("</p>");
            ?>
        </div>
        <?php if ($computer['myTurn']) { ?>
            <form method="post">
                <input type="submit" class="btn game-btn-roll" name="compRoll" value="computer">
            </form>
        <?php }
        if ($computer['win']) {
            echo("Computer won !");
        }
        ?>
    </div>
</div>
</body>
</html>
