<?php
$headerPath = __DIR__ . "/../modules/header.php";
$connPath = __DIR__ . "/../modules/conn.php";

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
$conn = new mysqli("localhost", "root", "", "keyboard_destroyer");

if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifyLesson"])) {
    $lessonIdToModify = $_POST["lessonId"];
    $newTextContent = $_POST["newTextContent"];

    // Zaktualizuj tekst lekcji
    $updateLessonSql = "UPDATE lessons SET TextContent = '$newTextContent' WHERE LessonID = $lessonIdToModify";

    if ($conn->query($updateLessonSql) === TRUE) {
        echo "Lekcja została zaktualizowana.";
    } else {
        echo "Błąd podczas aktualizacji lekcji: " . $conn->error;
    }
}

$sql = "SELECT * FROM lessonmodules";
$result = $conn->query($sql);

$existingModules = array();
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $moduleId = $row['ModuleID'];
        $moduleName = $row['ModuleName'];

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
        <ul class="admin-menu" style="margin-left: 25%">
            <li class="admin-menu-item"><a href="/admin">Powrót</a></li>
            <li class="admin-menu-item"><a href="/admin/modules">Moduły</a></li>
            <li class="admin-menu-item"><a href="/admin/lessons">Lekcje</a></li>
        </ul>
        <br>
        <br>
        <hr style="margin-bottom: 15px">



        <h2 class="naglowki-h2">Modyfikowanie Lekcji</h2>
        <form method="post" action="/admin/modify_lesson">
            <div class="select-wrapper">
                <label for="lessonId" class="white-text">ID Lekcji:</label>
                <select class="form-element white-text" id="lessonId" name="lessonId" required>
                    <?php foreach ($existingModules as $module): ?>
                        <?php foreach ($module['lessons'] as $lesson): ?>
                            <option value="<?php echo $lesson['LessonID']; ?>">
                                <?php echo "(ID: " . $lesson['LessonID'] . ') - ' . $lesson['LessonName'] . ' (' . $module['moduleName'] . ') - ' . $lesson['TextContent']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </select>
            </div>

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