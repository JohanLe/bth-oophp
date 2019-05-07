<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
echo("<h2>" . $title . "</h2>")
?>
<form method="post">
    <input type="number" name="userGuess" value="" placeholder="Number">
    <?php
    if ($triesLeft > 0) {
        echo('<input type = "submit" name = "submitGuess" value = "Guess">');
    }
    ?>
    <input type="submit" name="reset" value="Reset">
    <input type="submit" name="doCheat" value="Cheat">


</form>

<?php
echo("You have " . $triesLeft . " tries left.");
if ($doCheat) {
    echo("</br>Secret number is: " . $number);
}
echo("</br>" . $result);

?>

</div>
</body>
</html>
