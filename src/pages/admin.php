<?php
$headerPath = __DIR__ . "/../modules/header.php";

if (file_exists($headerPath)) {
    include($headerPath);
} else {
    echo "Błąd: Nie udało się załadować pliku header.php.";
}
?>

<body>


    <h1 id="admin-napis" class="center-naglowki">PANEL ADMINISTRATORA</h1>

    <div id="background">
        <ul class="admin-menu">
            <li class="admin-menu-item"><a href="/admin">Powrót</a></li>
            <li class="admin-menu-item"><a href="/admin/modules">Moduły</a></li>
            <li class="admin-menu-item"><a href="/admin/lessons">Lekcje</a></li>
        </ul>



        <h2 class="naglowki-h2">Modyfikowanie Lekcji</h2>
        <form method="post" action="/admin/modify_lesson">
            <label for="lessonId">ID Lekcji:</label>
            <input class="form-element" type="text" id="lessonId" name="lessonId" required>

            <label for="newTextContent">Nowy Tekst Lekcji:</label>
            <textarea class="form-element" id="newTextContent" name="newTextContent" required></textarea>

            <!--            <button class="form-element" type="submit">Modyfikuj Lekcję</button>-->
            <button class="btn">
                <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1"
                    class="sparkle">
                    <path
                        d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                    </path>
                </svg>

                <span class="text">Modyfikuj Lekcję</span>
            </button>

        </form>

        <h2 class="naglowki-h2">Wszystkie Lekcje</h2>
        <div class="lessons text">
            <?php
            try {
                $db = new PDO('mysql:host=localhost;dbname=keyboard_destroyer', 'root', '');
                $query = 'SELECT * FROM lessons';
                $stmt = $db->query($query);

                echo '<ul class="delete-lessons">';
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<li>';
                    echo "<b>Lekcja ID:</b> {$row['LessonID']} - <b>Module:</b> {$row['ModuleID']} - {$row['LessonName']} <b>Tekst:</b> {$row['TextContent']}";
                    echo '<i class="fas fa-trash delete-lesson" data-lesson-id="' . $row['LessonID'] . '"></i>';
                    echo '</li>';
                }
                echo '</ul>';
            } catch (PDOException $e) {
                die('Błąd bazy danych: ' . $e->getMessage());
            }
            ?>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteLessonIcons = document.querySelectorAll('.delete-lesson');

            deleteLessonIcons.forEach(icon => {
                icon.addEventListener('click', function () {
                    const lessonId = this.getAttribute('data-lesson-id');

                    if (confirm('Czy na pewno chcesz usunąć tę lekcję?')) {

                        fetch('/admin/delete_lesson', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                lessonIdToDelete: lessonId,
                            }),
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {

                                    location.reload();
                                } else {
                                    alert('Błąd podczas usuwania lekcji.');
                                }
                            })
                            .catch(error => {
                                console.error('Błąd fetch:', error);
                                alert('Błąd podczas usuwania lekcji.');
                            });
                    }
                });
            });
        });
    </script>

</body>

</html>