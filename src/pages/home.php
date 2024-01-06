<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna | Keyboard Destroyer</title>
    <link rel="stylesheet" type="text/css" href="../src/css/home.css">
</head>
<body>
    <?php
    // session_start();
    
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

    <h1>Welcome to the Home Page!</h1>

    <form method="post" action="/login">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
