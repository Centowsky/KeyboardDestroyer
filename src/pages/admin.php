<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="../src/css/admin.css">
</head>
<body>
    <h1>PANEL ADMINISTRATORA</h1>

    <h2>Dodawanie Lekcji</h2>
    <form method="post" action="/admin/add_lesson">
        <label for="moduleId">Numer modułu:</label>
        <input type="text" id="moduleId" name="moduleId" required><br>
        
        <label for="lessonName">Nazwa Lekcji:</label>
        <input type="text" id="lessonName" name="lessonName" required><br>

        <label for="textContent">Tekst lekcji:</label>
        <textarea type="text" id="textContent" name="textContent" required></textarea></br>
        
        <button type="submit">Dodaj Lekcję</button>
    </form>

    <h2>Dodawanie Modułu</h2>
    <form method="post" action="/admin/add_module">
        <label for="moduleName">Nazwa Modułu:</label>
        <input type="text" id="moduleName" name="moduleName" required><br>
        
        <label for="difficultyLevel">Poziom Trudności:</label>
        <input type="text" id="difficultyLevel" name="difficultyLevel" required><br>
        
        <button type="submit">Dodaj Moduł</button>
    </form>
</body>
</html>