<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moduły</title>
</head>
<body>
    <h2>Lista Modułów</h2>
    <ul>
        <?php foreach ($this->modules as $module) : ?>
            <li><?= htmlspecialchars($module) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>