<?php
/**
 * Created by PhpStorm.
 * User: Ledel
 * Date: 2019-04-11
 * Time: 21:27
 */
require "autoload.php";

$guess = new Guess();
$name = preg_replace("/[^a-z\d]/i", "", __DIR__);

session_name($name);
session_start();

if (!$_SESSION) {
    $_SESSION['game'] = $guess;
}
