<?php
$headerPath = __DIR__ . "/../modules/header.php";

if (file_exists($headerPath)) {
    include($headerPath);
} else {
    echo "Błąd: Nie udało się załadować pliku header.php.";
}
?>

<body>
    <?php

    if (isset($_SESSION['user'])) {
        header('Location: /learn');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Sprawdzenie poprawności danych
        if (authenticateUser($username, $password)) {
            // Utworzenie sesji i przekierowanie
            $_SESSION['user'] = $username;
            header('Location: /learn');
            exit();
        } else {
            echo '<p style="color: red;">Błędne dane logowania.</p>';
        }
    }
    ?>



    <div id="tlo" class="card">
        <div class="card2">
            <h1 id="zaloguj">Zaloguj</h1>
            <form method="post" action="/login">
                <div class="input-container">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-container">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button class="btn">
                    <input type="submit" value="Login">
                </button>


            </form>
        </div>
    </div>
</body>
</html>
