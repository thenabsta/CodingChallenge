<?php

require_once('../Includes/Includes.php');

$game = new game();

if (isset($_REQUEST['game_id']) && $_REQUEST['game_id'] > 0)
{
    $game->load($_REQUEST['game_id']);
}
if (isset($_POST['game_id'])) 
{

    $game->setData($_POST);
    
    $errors = $game->validate();
    
    if (count($errors) == 0) 
    {
        $game->save();
        ?><div class="centerClass"><?php echo ltrim(htmlspecialchars($_POST["game_title"]));?> "has been saved.</div>" <?php
        die;
    }
    
}
?>

<html>
    <body>
        
        <?php 
        
            if(isset($errors)){
                var_dump($errors);
            } 
        ?>
       <div class="gameWrapper">        
           <h1>Add/Edit/Update Your Game</h1>
             <div class="container">
                <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="game_title" class="leftClass">Title: 
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="game_title" id="game_title" class="" required value=
                                <?php
                                    if(isset($_GET["game_title"]))
                                        {
                                                
                                            echo "\"" . ltrim(htmlspecialchars($_GET["game_title"])) . "\"";
                                            
                                        }
                                    else
                                        {
                                            
                                            echo "\"" . $game->gameTitle . "\"";
                                            
                                        } ?>
                                />
                            </label><br>
                        </div>
                    <br /><br />
                    <div class="row">
                        <div class="col-md-9">
                            <label for="game_content" class="leftClass">Content: 
                        </div>
                        <div class="col-md-9">
                            <textarea rows="4" cols="50" name="game_content" id="game_content" class="leftClass" size="255">
                                <?php
                                    if(isset($_GET["game_content"]))
                                        {
                                                
                                            echo ltrim(htmlspecialchars($_GET["game_content"]));
                                            
                                        }
                                    else
                                        {
                                            
                                            echo $game->gameContent;
                                            
                                        } ?>
                            </textarea>
                            </label><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <label for="game_publisher" class="leftClass">Publisher: 
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="game_publisher" id="game_publisher" class="leftClass" required value=
                                <?php
                                    if(isset($_GET["game_publisher"]))
                                    {
                                                
                                        echo "\"" . trim(htmlspecialchars($_GET["game_publisher"])) . "\"";
                                            
                                    }
                                    else
                                        {
                                            
                                            echo "\"" . $game->gamePublisher . "\"";
                                            
                                        } ?>
                                />
                            </label><br>
                        </div>
                        <div class="col-md-9">
                            <label for="game_publication_date" class="leftClass">Date:
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="game_publication_date" id="game_publication_date" class="leftClass" required value=
                                <?php
                                    if(isset($_GET["game_publication_date"]))
                                        {
                                                
                                            echo "\"" . trim(htmlspecialchars($_GET["game_publication_date"])) . "\"";
                                            
                                        }
                                    else
                                        {
                                            
                                            echo "\"" . $game->publicationDate . "\"";
                                            
                                        } ?>
                                />
                            </label><br>     
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9"> 
                            <input type="hidden" name="game_id" value=
                                <?php
                                            
                                    if(isset($_GET["game_id"]))
                                        {
                                                
                                            echo "\"" . trim(htmlspecialchars($_GET["game_id"])) . "\"";
                                            
                                        }
                                    elseif(isset($game->gameId)){
                        
                                            ?><?php echo "\"" . $game->gameId . "\""; ?><?php
                                            
                                        }
                                    else{ ?>""<?php

                                        } ?>
                                /><br>
                            <input type="submit" name="submit">
                        </div>
                    </div>
                </form>        
            </div>
        </div>
    </body>
</html>