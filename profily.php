<?php
$error = "";
$message = "";
include_once './action_files/connecting_to_database.php';
include_once 'parts_of_website/nav_bar.php';

$sql = "SELECT id, meno, priezvisko, email FROM hodnotenie_filmov.použivateľ";
$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Výpis každého používateľa ako odkaz
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="profil_pouzivatela.php?id=' . $row["id"] . '">' . $row['meno'] . '</a><br><br>';
        }
    } else {
        echo "Žiadni používatelia.";
    }
} else {
    $error = "Chyba pri získavaní údajov: " . mysqli_error($conn);
    echo "<p style='color: red;'>$error</p>";
}
?>