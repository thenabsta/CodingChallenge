<?php

require_once('../Includes/Includes.php');

$game = new game();

if(isset($_GET['game_id'])){
    $gameId = htmlspecialchars($_GET['game_id']);
    $game->deleteGame($gameId);
    ?>
    <div class="jumbotron">
        <div class="centerClass">
            <div class="gameWrapper"><h1>Your game " 
            <?php echo htmlspecialchars($_GET['game_title']); ?>
            " has been deleted.</h1>
            </div>
        </div>
    </div>
    <?php
}
?>