<?php

require_once('../Includes/Includes.php');

if(isset($_SESSION['loggedIn'])){

    if($_SESSION['loggedIn'] == true){
    ?>
           <div class="gameWrapper">  
               <h1>Welcome <?php echo $_SESSION['username']; ?>!</h1>
            </div>
       <?php
    }
}
else{
$player->login();
?>

<html>
    <body>
        
        <?php 
        
            if(isset($errors)){
                var_dump($errors);
            } 
        ?>
       <div class="gameWrapper">        
           <h1>Login</h1>
             <div class="container">
                <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="username" class="leftClass">username: 
                            <input type="text" name="username" id="username" class="leftClass" required />
                            </label><br>
                        </div>
                    <br /><br />
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <label for="password" class="leftClass">Password: 
                            <input type="password" name="password" id="password" class="leftClass" required />
                            </label><br>
                            <input type="submit" name="submit" value="Login" class="btn btn-primary">
                            <a href="Signup.php" class="btn btn-primary">Sign Up Here!</a>
                        </div>
                    </div>
                </form>        
            </div>
        </div>
    </body>
</html>
<?php } ?>