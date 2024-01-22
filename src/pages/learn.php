<?php
$headerPath = __DIR__ . "/../modules/header.php";

if (file_exists($headerPath)) {
    include($headerPath);
} else {
    echo "Błąd: Nie udało się załadować pliku header.php.";
}

?>

<body>

    <div id="wejscie-div">
        <h1 style="font-family: Quicksand , sans-serif">Witaj, <i class="text-primary">
                <?php echo htmlspecialchars($username); ?>
            </i> !</h1>
        <br>

        <h3>Wybierz lekcję z dostępnych modułów</h3>

    </div>

    <div id="arrows">
        <div id="leftArrow" class="arrow" onclick="navigate(-1)">←</div>
        <div id="rightArrow" class="arrow" onclick="navigate(1)">→</div>
    </div>

    <div id="container-m">
        <?php
        function getUserStatFromDatabase()
        {
            try {
                $db = new PDO('mysql:host=localhost;dbname=keyboard_destroyer', 'root', '');

                $query = 'SELECT lm.ModuleID, COUNT(us.LessonID) AS LiczbaLekcji 
                FROM lessonmodules AS lm 
                    INNER JOIN lessons AS ls ON lm.ModuleID=ls.ModuleID 
                    INNER JOIN userstatistics AS us ON ls.LessonID=us.LessonID 
                GROUP BY lm.ModuleID;';

                $stmt = $db->query($query);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Przetworzenie wyników na strukturę zagnieżdżoną dla łatwiejszej obsługi w PHP
                $modules_2 = [];

                foreach ($result as $row) {
                    $moduleId_2 = $row['ModuleID'];
                    $modulesNumberOfLessons = $row['LiczbaLekcji'];

                    // Dodanie modułu, jeśli nie istnieje
                    if (!isset($modules_2[$moduleId_2])) {
                        $modules_2[$moduleId_2] = [
                            'ModuleID' => $moduleId_2,
                            'ModulesNumberOfLessons' => $modulesNumberOfLessons,
                        ];
                    }
                }

                return $modules_2;
            } catch (PDOException $e) {
                die('Błąd bazy danych: ' . $e->getMessage());
            }
        }

        function getLessonNames($moduleId)
        {
            try {
                $db = new PDO('mysql:host=localhost;dbname=keyboard_destroyer', 'root', '');

                $query = 'SELECT LessonID, LessonName FROM lessons WHERE ModuleID = :moduleId';
                $stmt = $db->prepare($query);
                $stmt->bindParam(':moduleId', $moduleId, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return $result;
            } catch (PDOException $e) {
                die('Błąd bazy danych: ' . $e->getMessage());
            }
        }

        $modules_2 = getUserStatFromDatabase();
        $flaga = 0;
        $procentUkonczenia = 0;

        foreach ($modules as $module) {
            $liczbalekcji = sizeof($module['Lessons']);
            foreach ($modules_2 as $module_2) {
                if ($module['ModuleID'] == $module_2['ModuleID']) {
                    $liczbaUkonczonychLekcji = $module_2['ModulesNumberOfLessons'];
                    if ($liczbaUkonczonychLekcji != 0) {
                        $procentUkonczenia = $liczbaUkonczonychLekcji / $liczbalekcji;
                        $procentUkonczenia *= 100;
                        $flaga = 1;
                    }
                }
            }

            echo "<div class='block' id='hidden'>";
            echo "<p class='m_name'>{$module['ModuleName']}</p>";
            echo "<p class='d_name'>Difficulty Level: {$module['DifficultyLevel']}</p>";
            echo "<p class='d_name'>Number of lessons: {$liczbalekcji}</p>";

            if ($flaga == 1) {
                echo "<p class='d_name'>{$procentUkonczenia}%</p>";
                $flaga = 0;
                $procentUkonczenia = 0;
            } else {
                echo "<p class='d_name'>0%</p>";
            }

            // Pobierz nazwy lekcji
            $lessonNames = getLessonNames($module['ModuleID']);
            ?>

            <ul class='lesson-list'>
                <?php foreach ($lessonNames as $lesson): ?>
                    <li onclick='saveAndGoToLesson(<?php echo $lesson['LessonID']; ?>)'>
                        <?php echo $lesson['LessonName']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php
            echo "<a href='/learn/usun?moduleId=" . $module['ModuleID'] . "' class='button-del' style='font-size: 0.8em;display: flex; align-items: center; justify-content: center; '>Resetuj</a>";
            echo "</div>";
        }
        ?>
    </div>

    <script>
        function saveAndGoToLesson(lessonId) {
            localStorage.setItem('selectedLesson', lessonId);
            localStorage.setItem('selectedLearning', false);
            window.location.href = '/klawiatura';
        }

    </script>

    <script>


        let currentIndex = 0;
        let cont = document.getElementById("container-m")
        let maxIndex = cont.children.length;
        let divNumber

        document.getElementById("hidden").setAttribute("id", "mainBlock");
        for (let i = 1; i <= 4; i++) {
            cont.children[i].removeAttribute('id');
        }

        function navigate(direction) {
            currentIndex += direction;

            if (currentIndex < 0) {
                currentIndex = 0;
            } else if (currentIndex > maxIndex) {
                currentIndex = maxIndex;
            }

            let cont = document.getElementById("container-m")
            if (direction > 0 && currentIndex != maxIndex) {
                if (currentIndex + 4 < maxIndex) {
                    document.getElementById("hidden").removeAttribute('id');
                    document.getElementById("mainBlock").setAttribute("id", "hidden");
                    cont.children[currentIndex].setAttribute("id", "mainBlock");
                } else {
                    document.getElementById("mainBlock").setAttribute("id", "hidden");
                    cont.children[currentIndex].setAttribute("id", "mainBlock");
                }
            }
            else if (currentIndex != maxIndex) {
                document.getElementById("mainBlock").removeAttribute('id');
                cont.children[currentIndex].setAttribute("id", "mainBlock");
                cont.children[currentIndex + 5].setAttribute("id", "hidden");
            }


        }

        let urlParams = new URLSearchParams(window.location.search);
        let lessonIdParam = urlParams.get('id_lesson');
        if (lessonIdParam) {
            goToLesson(lessonIdParam);
        }
    </script>
</body>

</html>