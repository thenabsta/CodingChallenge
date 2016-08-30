<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
//require_once('inc/functions.php');
require_once('../Controllers/BaseController.php');
require_once('../Controllers/DatabaseController.php');
require_once('../Controllers/PlayersController.php');
require_once('../Models/Repositories/PlayerRepository.php');
require_once('../Controllers/GameController.php');
require_once('../Models/Repositories/GameRepository.php');
require_once('../Migrations/Migrations.php');
require_once('../css/styles.php');
require_once('../js/functions.php');
require_once('../Views/Navigation.php');
$migrations = new Migrations;
$migrations->createTables();
?>