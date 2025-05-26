<?php
include_once './parts_of_website/header.php';
?>


<?php

include_once './parts_of_website/nav_bar.php';
include_once './action_files/registration_user.php';
?>
<h1>Registrácia</h1>
<form action="" method="post">
    <label for="">Meno</label>
    <input type="text" name="meno" />
    <label for="">Priezvisko</label>
    <input type="text" name="priezvisko" />
    <label for="">Email:</label>
    <input type="text" name="email" id="" />
    <label for="">Heslo:</label>
    <input type="password" name="heslo" />
    <input type="submit" name="submit" id="" value="Poslať" />
</form>