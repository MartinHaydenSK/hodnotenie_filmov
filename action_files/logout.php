<?php 
    session_start();
    session_unset();
    session_destroy();
    setcookie("user", $cookie_data, time() - (86400 * 1), "/");
    header("Location: ../index.php");
    exit;
    ?>
