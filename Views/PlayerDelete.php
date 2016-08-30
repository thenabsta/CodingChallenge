<?php

require_once('../Includes/Includes.php');

$player = new Player();

if(isset($_GET['player_id'])){
    $player_id = htmlspecialchars($_GET['player_id']);
    $player->deletePlayer($player_id);
    ?>
    <div class="jumbotron">
        <div class="centerClass">The account for " 
        <?php echo htmlspecialchars($_GET['player_id']); ?>
        " has been deleted.
         </div>
    </div>
    <?php
}
?>