<?php
$error = "";
$message = "";
include_once './action_files/connecting_to_database.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $meno = $_POST['meno'];
    $priezvisko = $_POST['priezvisko'];
    $email = $_POST['email'];
    $heslo = password_hash($_POST['heslo'], PASSWORD_DEFAULT);
    $sql = "SELECT * FROM hodnotenie_filmov.použivateľ WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $error = "Používateľ s týmto emailom už existuje!";
    } else {
        if (!empty($meno) && !empty($priezvisko) && !empty($email) && !empty($heslo)) {
            $save = "INSERT INTO hodnotenie_filmov.použivateľ (meno, priezvisko, email, heslo) VALUES ('$meno', '$priezvisko', '$email', '$heslo')";
            if (mysqli_query($conn, $save)) {
                $message = "Registrácia úspešná!";
            } else {
                $error = "Nastala chyba pri ukladaní údajov: " . mysqli_error($conn);
            }
        } else {
            $error = "Všetky polia sú povinné!";
        }
    }
    if ($error) {
        echo "<p style='color: red;'>$error</p>";
    } elseif ($message) {
        echo "<p style='color: green;'>$message</p>";
    }


} else {

}

?>