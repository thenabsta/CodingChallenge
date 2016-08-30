<?php

require_once('../Includes/Includes.php');

$searchValue = htmlspecialchars($_GET['searchValue']);

$game = new game();

$game->findGames($searchValue);

?>