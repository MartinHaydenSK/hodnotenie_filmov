<?php
include_once './parts_of_website/header.php';
?>

<?php

include "./parts_of_website/nav_bar.php";
//Martin Hayden

?>
<section>
    <h1>Prihlasenie</h1>
    <form action="" method="GET">

        <label for="">Email:</label>
        <input type="text" name="email_login" id="" />
        <label for="">Heslo:</label>
        <input type="password" name="heslo_login" />
        <input type="submit" name="submit_login" id="" value="Poslať" />
    </form>
    <?php
    include_once './action_files/login_user.php';
    ?>
</section>