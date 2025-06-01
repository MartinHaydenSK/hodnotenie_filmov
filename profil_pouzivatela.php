<?php

include_once 'parts_of_website/nav_bar.php';
include_once './action_files/connecting_to_database.php';

?>

<section>
    <h1>Profil</h1>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT meno, priezvisko, email FROM hodnotenie_filmov.použivateľ WHERE id = " . $id;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo "<h2> ". $row['meno'] . " " . $row['priezvisko']. "</h2>";
        echo "<p>Email: " . $row['email'] . "</p>";
    } else {
        header("Location: index.php");
    }
    echo"<h2>Napísané recenzie</h2>";
        $sqlSel = "SELECT hodnotenie.nazov, hodnotenie.recenzia, hodnotenie.žáner, hodnotenie.rating, hodnotenie.datum, hodnotenie.ID_pouzivatel, použivateľ.meno, použivateľ.id FROM hodnotenie 
 JOIN použivateľ ON hodnotenie.ID_pouzivatel = použivateľ.id WHERE hodnotenie.ID_pouzivatel='$id' ORDER BY hodnotenie.datum DESC;";
    $result = mysqli_query($conn, $sqlSel);
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    echo "film: ". $row['nazov'] . " recenzia: ". $row['recenzia'] . " hodnotenie: ". $row['rating'] . ' od: ' . $row['meno'] . " zverejnené: " . $row['datum'] . "</br> </br>";
 }  
}else{
    echo "Užívatel zatial nemá žiadne recenzie";
}
    ?>
    <br>
    <a href="profily.php">Späť na profily</a>
</section>
