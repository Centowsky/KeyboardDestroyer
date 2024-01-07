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
    <h1>Witaj, <i class="text-primary"><?php echo htmlspecialchars($username); ?></i>!</h1>
    <?php if ($username == "admin") echo '<a href="/admin">Panel admina</a>'?>
    <h2>Naucz się szybko pisać.</h2>
    <h3>Dostępne moduły</h3>

    <?php
    foreach ($modules as $module) {
        echo "<div>";
        echo "<h2>{$module['ModuleName']}</h2>";
        echo "<p>Difficulty Level: {$module['DifficultyLevel']}</p>";

        // Sprawdź, czy moduł ma lekcje
        if (!empty($module['Lessons'])) {
            echo "<ul>";
            foreach ($module['Lessons'] as $lesson) {
                echo "<li>{$lesson['LessonName']}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Brak lekcji w tym module.</p>";
        }

        echo "</div>";
    }
    ?>

    <a href="/logout">Wyloguj</a>
</body>
</html>
