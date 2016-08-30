<?php

require_once('../Includes/Includes.php');

$player = new Player();

if (isset($_REQUEST['player_id']) && $_REQUEST['player_id'] > 0)
{
    // $player->load($_REQUEST['player_id']);
}
if (isset($_POST['player_id'])) 
{

    $player->setData($_POST);
    $errors = $player->validate();

    if (count($errors) == 0) 
    {
        $player->save();
          ?><div class="centerClass">
                <div class="gameWrapper">
                    The player for <?php echo ltrim(htmlspecialchars($_POST["player_id"]));?> "has been updated.
                </div>
            </div>"
        <?php
        die;
    }
    else {
        echo "There are errors" . var_dump($errors);
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
           <h1>Edit Player</h1>
             <div class="container">
                <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="first_name" class="leftClass">First Name: 
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="first_name" id="first_name" class="" required value=
                                <?php
                                    if(isset($_GET["first_name"]))
                                        {
                                                
                                            echo "\"" . ltrim(htmlspecialchars($_GET["first_name"])) . "\"";
                                            
                                        }
                                    else
                                        {
                                            
                                            echo "";
                                            
                                        } ?>
                                >
                            </label><br>
                        </div>
                        <div class="col-md-2">
                            <label for="last_name" class="leftClass">Last Name: 
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="last_name" id="last_name" class="" required value=
                                <?php
                                    if(isset($_GET["last_name"]))
                                        {
                                                
                                            echo "\"" . ltrim(htmlspecialchars($_GET["last_name"])) . "\"";
                                            
                                        }
                                    else
                                        {
                                            
                                            echo "";
                                            
                                        } ?>
                                >
                            </label>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-2">
                            <label for="username" class="leftClass">username: 
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="username" id="username" class="" required value=
                                <?php
                                    if(isset($_GET["username"]))
                                        {
                                                
                                            echo "\"" . ltrim(htmlspecialchars($_GET["username"])) . "\"";
                                            
                                        }
                                    else
                                        {
                                            
                                            echo "";
                                            
                                        } ?>
                                >
                            </label><br>
                        </div>
                        <div class="col-md-2">
                            <label for="password" class="leftClass">Password: 
                        </div>
                        <div class="col-md-2">
                            <input type="password" name="password" id="password" class="" required></label><br>
                        </div>
                    </div>
                    <div class="row"><br />
                        <div class="col-md-2">
                            <label for="email_address" class="leftClass">Email: 
                        </div>
                        <div class="col-md-1">
                            <input type="email_address" name="email_address" id="email_address" class="" required value=
                                <?php
                                    if(isset($_GET["email_address"]))
                                        {
                                                
                                            echo "\"" . ltrim(htmlspecialchars($_GET["email_address"])) . "\"";
                                            
                                        }
                                    else
                                        {
                                            
                                            echo "";
                                            
                                        } ?>
                                >
                            </label><br>
                        </div>
                    </div>
                            <input type="hidden" name="username" value=
                                <?php
                                            
                                    if(isset($_GET["username"]))
                                        {
                                                
                                            echo "\"" . trim(htmlspecialchars($_GET["username"])) . "\"";
                                            
                                        }
                                    elseif(isset($player->player_id)){
                        
                                            ?><?php echo "\"" . $player->username . "\""; ?><?php
                                            
                                        }
                                    else{ ?>""<?php

                                        } ?>
                                /><br>
                            <input type="hidden" name="admin_privileges" value="1">
                    <div class="row">
                        <div class="col-md-9">
                        <br />
                            <input type="submit" name="submit" value="Submit Changes" class="btn btn-primary">
                        </div>
                    </div>
                </form>        
            </div>
        </div>
    </body>
</html>