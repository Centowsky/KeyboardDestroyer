<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nauka | Keyboard Destroyer</title>
</head>
<body>
    <h2>Witaj, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
    <h2>Lista Modułów</h2>
    <p>W budowie</p>

    <form method="post" action="/logout">
        <button type="submit">Wyloguj</button>
    </form>
</body>
</html>
