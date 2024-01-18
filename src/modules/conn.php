<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "keyboard_destroyer";

// Utwórz połączenie z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie z bazą danych
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}
?>
