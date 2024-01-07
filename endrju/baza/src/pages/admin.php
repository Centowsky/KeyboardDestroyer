<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
<!--    <link rel="stylesheet" type="text/css" href="../src/css/admin.css">-->
    <link rel="stylesheet" type="text/css" href="../css/admin.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">


</head>
<body>


    <h1 id="admin-napis" class="center-naglowki">PANEL ADMINISTRATORA</h1>

    <div id="background">

        <h2 class="naglowki-h2">Dodawanie Lekcji</h2>
        <form method="post" action="/admin/add_lesson">
            <label for="moduleId">Numer modułu:</label>
            <input class="form-element" type="text" id="moduleId" name="moduleId" required>

            <label for="lessonName">Nazwa Lekcji:</label>
            <input class="form-element" type="text" id="lessonName" name="lessonName" required>

            <label for="textContent">Tekst lekcji:</label>
            <textarea class="form-element" id="textContent" name="textContent" required></textarea>

<!--            <button class="form-element" type="submit">Dodaj Lekcję</button>-->
            <button class="btn">
                <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1" class="sparkle">
                    <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z"></path>
                </svg>

                <span class="text">Dodaj Lekcję</span>
            </button>



        </form>

        <h2 class="naglowki-h2">Dodawanie Modułu</h2>
        <form method="post" action="/admin/add_module">
            <label for="moduleName">Nazwa Modułu:</label>
            <input class="form-element" type="text" id="moduleName" name="moduleName" required>

            <label for="difficultyLevel">Poziom Trudności:</label>
            <input class="form-element" type="text" id="difficultyLevel" name="difficultyLevel" required>

<!--            <button class="form-element" type="submit">Dodaj Moduł</button>-->
            <button class="btn">
                <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1" class="sparkle">
                    <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z"></path>
                </svg>

                <span class="text">Dodaj Moduł</span>
            </button>
        </form>


        <h2 class="naglowki-h2">Modyfikowanie Lekcji</h2>
        <form method="post" action="/admin/modify_lesson">
            <label for="lessonId">ID Lekcji:</label>
            <input class="form-element" type="text" id="lessonId" name="lessonId" required>

            <label for="newTextContent">Nowy Tekst Lekcji:</label>
            <textarea class="form-element" id="newTextContent" name="newTextContent" required></textarea>

<!--            <button class="form-element" type="submit">Modyfikuj Lekcję</button>-->
            <button class="btn">
                <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1" class="sparkle">
                    <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z"></path>
                </svg>

                <span class="text">Modyfikuj Lekcję</span>
            </button>

        </form>

        <h2 class="naglowki-h2">Wszystkie Lekcje</h2>

        <?php
        try {
            $db = new PDO('mysql:host=localhost;dbname=keyboard_destroyer', 'root', '');
            $query = 'SELECT * FROM lessons';
            $stmt = $db->query($query);

            echo '<ul>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>Lekcja ID: {$row['LessonID']} - {$row['LessonName']} <b>Tekst:</b> {$row['TextContent']}</li>";
            }
            echo '</ul>';
        } catch (PDOException $e) {
            die('Błąd bazy danych: ' . $e->getMessage());
        }
        ?>
    </div>
</body>
</html>