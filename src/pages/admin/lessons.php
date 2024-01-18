<?php
$headerPath = __DIR__ . "/../../modules/header.php";
$connPath = __DIR__ . "/../../modules/conn.php";

if (file_exists($headerPath)) {
    include($headerPath);
} else {
    echo "Błąd: Nie udało się załadować pliku header.php.";
}

if (file_exists($connPath)) {
    include($connPath);
} else {
    echo "Błąd: Nie udało się załadować pliku conn.php.";
}

if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteLesson"])) {
    $lessonIdToDelete = $_POST["deleteLesson"];
    echo $lessonIdToDelete;

    // Usuń lekcję
    $deleteLessonSql = "DELETE FROM lessons WHERE LessonID = $lessonIdToDelete";
    echo $deleteLessonSql; // Add this line for debugging

    if ($conn->query($deleteLessonSql) === TRUE) {
        echo "Lekcja została usunięta.";
    } else {
        echo "Błąd podczas usuwania lekcji: " . $conn->error;
    }
}

$sql = "SELECT * FROM lessonmodules";
$result = $conn->query($sql);

$existingModules = array();
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $moduleId = $row['ModuleID'];
        $moduleName = $row['ModuleName'];

        // Pobierz lekcje dla danego modułu
        $lessonsSql = "SELECT * FROM lessons WHERE ModuleID = $moduleId";
        $lessonsResult = $conn->query($lessonsSql);

        $moduleData = array(
            'moduleId' => $moduleId,
            'moduleName' => $moduleName,
            'lessons' => array()
        );

        if ($lessonsResult && $lessonsResult->num_rows > 0) {
            while ($lessonRow = $lessonsResult->fetch_assoc()) {
                $moduleData['lessons'][] = $lessonRow;
            }
        }

        $existingModules[] = $moduleData;
    }
} else {
    echo "Brak modułów w bazie danych.";
}

$conn->close();
?>

<body>

    <h1 id="admin-napis" class="center-naglowki">PANEL ADMINISTRATORA</h1>

    <div id="background">

        <h2 class="naglowki-h2">Lista modułów</h2>
        <ol class="modules-list">
            <?php foreach ($existingModules as $moduleData): ?>
                <li class="modules-list-element">
                    <?= $moduleData['moduleName'] ?>


                    <?php if (!empty($moduleData['lessons'])): ?>
                        <ul>
                            <?php foreach ($moduleData['lessons'] as $lesson): ?>
                                <li class="lesson-item-list">
                                    <?= $lesson['LessonName'] ?>
                                    <button type="button" class="delete-lesson-btn" data-lesson-id="<?= $lesson['LessonID'] ?>">
                                        <i class="fas fa-trash-alt" style="color: red"></i>
                                    </button>
                                    <button type="button" class="show-text-content-btn" data-lesson-id="<?= $lesson['LessonID'] ?>">
                                        <i class="fas fa-info-circle" style="color: blue;"></i>
                                    </button>
                                    <div class="text-content" id="text-content-<?= $lesson['LessonID'] ?>" style="display: none;">
                                        <?= $lesson['TextContent'] ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>

        <h2 class="naglowki-h2">Dodawanie Lekcji</h2>
        <!-- Add a form for adding lessons -->
        <form method="post" action="/admin/add_lesson">
            <label for="moduleId">Numer modułu:</label>
            <input class="form-element" type="text" id="moduleId" name="moduleId" required>

            <label for="lessonName">Nazwa Lekcji:</label>
            <input class="form-element" type="text" id="lessonName" name="lessonName" required>

            <label for="textContent">Tekst lekcji:</label>
            <textarea class="form-element" id="textContent" name="textContent" required></textarea>

            <button class="btn">
                <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1"
                    class="sparkle">
                    <path
                        d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                    </path>
                </svg>

                <span class="text">Dodaj Lekcję</span>
            </button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const showTextContentButtons = document.querySelectorAll('.show-text-content-btn');

            showTextContentButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const lessonIdToShow = this.getAttribute('data-lesson-id');
                    const textContentElement = document.getElementById('text-content-' + lessonIdToShow);

                    // Toggle the visibility of text content
                    textContentElement.style.display = textContentElement.style.display === 'none' ? 'block' : 'none';
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModuleButtons = document.querySelectorAll('.delete-module-btn');
            const deleteLessonButtons = document.querySelectorAll('.delete-lesson-btn');

            deleteModuleButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const moduleIdToDelete = this.getAttribute('data-module-id');
                    const moduleElement = this.closest('.modules-list-element');

                    fetch('/admin/modules_lessons', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'deleteModule=' + moduleIdToDelete,
                    })
                        .then(response => response.text())
                        .then(data => {
                            // Usuń moduł z listy na stronie
                            moduleElement.remove();
                        })
                        .catch(error => {
                            console.error('Błąd fetch:', error);
                            alert('Błąd podczas usuwania modułu.');
                        });
                });
            });

            deleteLessonButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const lessonIdToDelete = this.getAttribute('data-lesson-id');
                    const lessonElement = this.closest('.lesson-item-list');

                    fetch('/admin/lessons', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'deleteLesson=' + lessonIdToDelete,
                    })
                        .then(response => response.text())
                        .then(data => {
                            // Usuń lekcję z listy na stronie
                            lessonElement.remove();
                        })
                        .catch(error => {
                            console.error('Błąd fetch:', error);
                            alert('Błąd podczas usuwania lekcji.');
                        });
                });
            });
        });
    </script>
</body>

</html>