<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie | Keyboard Destroyer</title>
</head>
<body>
    <h2>Logowanie</h2>

    <?php if (isset($this->error)): ?>
        <p style="color: red;"><?= $this->error ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="username">Login:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Zaloguj</button>
    </form>
</body>
</html>
