<?php
$conn = new mysqli("localhost", "root", "root", "hodnotenie_filmov");
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
}
?>