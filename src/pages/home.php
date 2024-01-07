<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna | Keyboard Destroyer</title>
    <link rel="stylesheet" type="text/css" href="../src/css/home.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">


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
