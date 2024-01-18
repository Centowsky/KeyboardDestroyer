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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteModule"])) {
    $moduleIdToDelete = $_POST["deleteModule"];
    echo $moduleIdToDelete;

    // Usuń moduł
    $deleteModuleSql = "DELETE FROM lessonmodules WHERE ModuleID = $moduleIdToDelete";
    echo $deleteModuleSql; // Add this line for debugging

    if ($conn->query($deleteModuleSql) === TRUE) {
        echo "Moduł został usunięty.";
    } else {
        echo "Błąd podczas usuwania modułu: " . $conn->error;
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
        <ul class="admin-menu">
            <li class="admin-menu-item"><a href="/admin">Powrót</a></li>
            <li class="admin-menu-item"><a href="/admin/modules">Moduły</a></li>
            <li class="admin-menu-item"><a href="/admin/lessons">Lekcje</a></li>
        </ul>
        <h2 class="naglowki-h2">Lista modułów</h2>
        <ol class="modules-list">
            <?php foreach ($existingModules as $moduleData): ?>
                <li class="modules-list-element">
                    <?= $moduleData['moduleName'] . ' (ID: ' . $moduleData['moduleId'] . ')' ?>
                    <button type="button" class="delete-module-btn" data-module-id="<?= $moduleData['moduleId'] ?>">
                        <i class="fas fa-trash-alt" style="color: red"></i>
                    </button>

                    <?php if (!empty($moduleData['lessons'])): ?>
                        <ul>
                            <?php foreach ($moduleData['lessons'] as $lesson): ?>
                                <li class="lesson-item-list">
                                    <?= $lesson['LessonName'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>

        <h2 class="naglowki-h2">Dodawanie Modułu</h2>

        <form method="post" action="/admin/add_module">
            <label for="moduleName">Nazwa Modułu:</label>
            <input class="form-element" type="text" id="moduleName" name="moduleName" required>

            <label for="difficultyLevel">Poziom Trudności:</label>
            <input class="form-element" type="text" id="difficultyLevel" name="difficultyLevel" required>

            <button class="btn">
                <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1"
                    class="sparkle">
                    <path
                        d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                    </path>
                </svg>

                <span class="btn-text">Dodaj Moduł</span>
            </button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModuleButtons = document.querySelectorAll('.delete-module-btn');

            deleteModuleButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const moduleIdToDelete = this.getAttribute('data-module-id');
                    const moduleElement = this.closest('.modules-list-element');

                    fetch('/admin/modules', {
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
        });
    </script>
</body>

</html>