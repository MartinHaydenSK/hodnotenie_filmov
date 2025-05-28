<?php
include_once './action_files/connecting_to_database.php';
include_once 'protect.php';


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit_login'])) {
    $email = Eprotect($_GET['email_login']);
    $heslo = Tprotect($_GET['heslo_login']);

    if (empty($email) || empty($heslo)) {
        echo "Všetky polia sú povinné!<br>";
        exit;
    } else {
        $sql = "SELECT * FROM hodnotenie_filmov.použivateľ WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($heslo, $row['heslo'])) {
                echo "Prihlásenie úspešné!";
                $data = [
                    "meno" => $row['meno'],
                    "priezvisko" => $row['priezvisko'],
                    "email" => $row['email'],
                ];
                $cookie_data = json_encode($data);

                setcookie("user", $cookie_data, time() + (86400 * 1), "/");
                header("Location: index.php");
            } else {
                echo "Nesprávne heslo!";
            }
        } else {
            echo "Používateľ s týmto emailom neexistuje!";
        }
    }
} else {
    echo "Neplatná požiadavka!";
}

?>
