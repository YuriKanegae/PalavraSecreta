<?php
    unset($_COOKIE["USER"]);

    session_start();
    session_destroy();
    
    header("Location: ../php/login.php");
?>
