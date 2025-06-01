<?php

$user_data = json_decode($_COOKIE['user'], true);
$user_name = $user_data['meno'] . " " . $user_data['priezvisko'];
include_once './parts_of_website/nav_bar.php';
include_once './action_files/connecting_to_database.php';



?>
<form action="" method="post"> <input type="submit" name="submit1" value="vymazať"> </form>

<section>
    <h1>Profil</h1>
    <?php
    if (isset($_COOKIE['user'])) {
        echo "<h2>Vitaj, $user_name</h2>";
        echo "<p>Email: " . $user_data['email'] . "</p>";
        echo "<p>Meno: " . $user_data['meno'] . "</p>";
        echo "<p>Priezvisko: " . $user_data['priezvisko'] . "</p>";
        $id = $user_data['id'];
        $sqlSel = "SELECT hodnotenie.ID, hodnotenie.nazov, hodnotenie.recenzia, hodnotenie.žáner, hodnotenie.rating, hodnotenie.datum, hodnotenie.ID_pouzivatel, použivateľ.meno, použivateľ.id FROM hodnotenie 
 JOIN použivateľ ON hodnotenie.ID_pouzivatel = použivateľ.id WHERE hodnotenie.ID_pouzivatel='$id' ORDER BY hodnotenie.datum DESC;";
    $result = mysqli_query($conn, $sqlSel);
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    echo "film: ". $row['nazov'] . " recenzia: ". $row['recenzia'] . "</br>hodnotenie: ". $row['rating'] . " zverejnené: " . $row['datum'] .
    ' <form action="" method="get"> <input type="hidden" name="ID" value="' .$row['ID'] .'"><input type="submit" name="submit1" value="vymazať"> </form></br></br>';
    if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['submit1']) && $_GET['submit1'] == "vymazať") {
    $ID = $_GET['ID'];
    $sqlDel = "DELETE FROM hodnotenie_filmov.hodnotenie WHERE hodnotenie.ID='$ID';";
    mysqli_query($conn, $sqlDel);
    header("Location: profil.php");
    }
    
    }  
}else{
    echo "Zatiel nemátie žiadnu racenziu <a href='nove_hodnotenie.php'>NAPÍSAŤ RECENZIU</a>";
}
    } else {
        header("Location: index.php");
    }
    
    ?>
    <a href="./index.php">Späť na domovskú stránku</a>
    <br>
    <a href="action_files/logout.php">Odhlásiť sa</a>
</section>