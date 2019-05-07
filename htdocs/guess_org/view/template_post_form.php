<?php
/**
 * Created by PhpStorm.
 * User: Ledel
 * Date: 2019-04-11
 * Time: 21:29
 */


?>

<form method="post" action="process.php">
    <input type="number" name="userGuess" value="" placeholder="Number">
    <?php
    if (!$_SESSION['completed']) {
        echo '<input type="submit" name="submitGuess" value="Guess">';
    }

    ?>
    <input type="submit" name="restart" value="Restart">
    <input type="submit" name="cheat" value="Cheat">


</form>

<?php
if (isset($_SESSION['cheat']) && $_SESSION['cheat']) {
    echo '</br>Secret number: ' . $_SESSION['game']->number() . '</br>';
}
if (isset($_SESSION['gameStatus'])) {
    echo '<h4>' . $_SESSION['gameStatus'] . '</h4>';
    echo '<h5> You have: ' . $_SESSION['game']->tries() . ' tries left.</h5>';
} else {
    echo "</br>Make a guess";
}
?>

</div>
</body>
</html>
