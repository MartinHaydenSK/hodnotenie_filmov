<?php

$user_data = json_decode($_COOKIE['user'], true);
$user_name = $user_data['meno'] . " " . $user_data['priezvisko'];
include_once './parts_of_website/nav_bar.php';



?>

<section>
    <h1>Profil</h1>
    <?php
    if (isset($_COOKIE['user'])) {
        echo "<h2>Vitaj, $user_name</h2>";
        echo "<p>Email: " . $user_data['email'] . "</p>";
        echo "<p>Meno: " . $user_data['meno'] . "</p>";
        echo "<p>Priezvisko: " . $user_data['priezvisko'] . "</p>";
    } else {
        header("Location: index.php");
    }
    ?>
    <a href="./index.php">Späť na domovskú stránku</a>
    <br>
    <a href="action_files/logout.php">Odhlásiť sa</a>
</section>