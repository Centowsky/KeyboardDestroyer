<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Lekcję</title>
</head>
<body>
    <h2>Dodaj Lekcję</h2>
    <form method="post" action="/add_lesson_handler">
        <label for="module_id">ID Modułu:</label>
        <input type="text" id="module_id" name="module_id" required><br>
        
        <label for="lesson_name">Nazwa Lekcji:</label>
        <input type="text" id="lesson_name" name="lesson_name" required><br>
        
        <button type="submit">Dodaj Lekcję</button>
    </form>
</body>
</html>
