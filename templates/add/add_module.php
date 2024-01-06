<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Moduł</title>
</head>
<body>
    <h2>Dodaj Moduł</h2>
    <form method="post" action="/add_module_handler">
        <label for="module_name">Nazwa Modułu:</label>
        <input type="text" id="module_name" name="module_name" required><br>
        
        <label for="difficulty_level">Poziom Trudności:</label>
        <input type="text" id="difficulty_level" name="difficulty_level" required><br>
        
        <button type="submit">Dodaj Moduł</button>
    </form>
</body>
</html>
