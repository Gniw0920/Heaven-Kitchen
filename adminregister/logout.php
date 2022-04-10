<?php
    session_start();
    if($_SESSION['name'] &&
        $_SESSION['email']) {
            // If this file is executed,
            // The session details will be destroyed thus logging the user out
            session_unset();
            session_destroy();
            header('Location: login.php');
    } 
    header('Location: login.php');
    