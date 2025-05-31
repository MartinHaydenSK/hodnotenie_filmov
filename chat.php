<?php
include_once './parts_of_website/nav_bar.php';
include_once './action_files/connecting_to_database.php';
include_once 'action_files/protect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat</title>
</head>
<body>
    <?php
if (isset($_COOKIE['user'])) {
        $user_data = json_decode($_COOKIE['user'], true);
        $user_name = $user_data['meno'] . " " . $user_data['priezvisko'];
        echo "<h2>Si prihlásený ako, $user_name</h2>";
        echo '<form action="" method="post">
    <label for="sprava">Vaša správa do chatu</label>
    <input type="text" name="sprava" />
    <input type="submit" name="submit" id="" value="Poslať" /> </br>';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    if (!empty($_POST['sprava'])){
        $datum = date('Y-m-d');
        $sprava = Tprotect($_POST['sprava']);
        $ID_pouzivatel = $user_data['id'];
        
        $sql = "INSERT INTO hodnotenie_filmov.chat (ID_pouzivatel, sprava, datum) VALUES ('$ID_pouzivatel', '$sprava', '$datum');";
        mysqli_query($conn, $sql);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
        } else {
        echo "Ste príhlásený ako hosť (ak chceťe zverejňovať príspevky, musíte sa prihlásiť). </br></br>";
    }
    echo "</br>";
    //echo date('Y-m-d');
    //echo time();
?>
<?php 
 $sqlSel = "SELECT chat.sprava, chat.datum, použivateľ.meno, použivateľ.id FROM chat JOIN použivateľ ON chat.ID_pouzivatel = použivateľ.id ORDER BY chat.datum DESC;";
 $result = mysqli_query($conn, $sqlSel);

 while($row = mysqli_fetch_assoc($result)){
    echo "správa: ". $row['sprava'] . 'od: <a href="profil_pouzivatela.php?id=' . $row["id"] . '">' . $row['meno'] . '</a> ' . "zverejnené: " . $row['datum'] . "</br> </br>";
 }
?>
</form>
</body>
</html>
