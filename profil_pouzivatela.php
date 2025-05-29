<?php

include_once 'parts_of_website/nav_bar.php';
include_once './action_files/connecting_to_database.php';



?>

<section>
    <h1>Profil</h1>
    <?php
    if (isset($_GET['id'])) {
        $sql = "SELECT meno, priezvisko, email FROM hodnotenie_filmov.použivateľ WHERE id = " . $_GET['id'];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo "<h2> ". $row['meno'] . " " . $row['priezvisko']. "</h2>";
        echo "<p>Email: " . $row['email'] . "</p>";
    } else {
        header("Location: index.php");
    }
    ?>
    <br>
    <a href="profily.php">Späť na profily</a>
</section>