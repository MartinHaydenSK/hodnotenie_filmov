<?php


include_once './parts_of_website/nav_bar.php';



?>

<section>
    <h1>Komunita</h1>
    <?php
    if (isset($_COOKIE['user'])) {
        $user_data = json_decode($_COOKIE['user'], true);
        $user_name = $user_data['meno'] . " " . $user_data['priezvisko'];
        echo "<h2>Si prihlásený ako, $user_name</h2>";
    } else {
        echo "Ste príhlásený ako hosť (ak chceťe zverejňovať príspevky, musíte sa prihlásiť).";
    }
    ?>
    <br>
    <a href="./profily.php">Prezerať si profily</a>
    <br>
    <a href="chat.php">Chatová nástenka</a>
</section>