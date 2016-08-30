<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

        if($_SESSION['loggedIn'] == true || isset($_SESSION['player_id']))
        {
            $_SESSION['loggedIn'] = "";
            $_SESSION['player_id'] = "";
            $_SESSION['timeout'] = "";
            session_destroy();
            header("Location:Login.php");  
            exit;
        }
        else
        {
            header("Location:Login.php");
        }
?>