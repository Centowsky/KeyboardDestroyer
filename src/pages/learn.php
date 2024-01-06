<?php
// session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nauka | Keyboard Deestroyer</title>
    <link rel="stylesheet" type="text/css" href="../src/css/learn.css">
</head>
<body>
    <h1>Witaj, <i><?php echo htmlspecialchars($username); ?></i>!</h1>
    <?php if ($username == "admin") echo '<a href="/admin">Panel admina</a>'?>
    <h2>Naucz się szybko pisać.</h2>
    <a href="/logout">Wyloguj</a>
</body>
</html>
