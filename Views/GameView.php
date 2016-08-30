<?php

require_once('../Includes/Includes.php');

$game = new game();

?>

<!-- <h1 class="jumbotron"></h1> -->

<?php

if(isset($_GET["game_id"]))
{
    $game->load($_GET["game_id"]);
}
else
{
    $game->load(1);
}

$game->gamePublisher = "GG";

$game->save();

$game->setData(
    array(
        "game_title" => "New Title 1",
        "game_content" => "the new game content",
        "game_publisher" => "GEG",
        "game_publication_date" => "2014-12-12"
    )
);

$errors = $game->validate();

if (count($errors) == 0)   
{
    $game->save();
} 
else 
{
    var_dump($errors);
}

?>