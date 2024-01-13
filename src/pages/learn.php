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
    <link rel="stylesheet" type="text/css" href="../src/css/lekcja.css">
</head>
<body>
    <h1>Witaj, <i class="text-primary"><?php echo htmlspecialchars($username); ?></i>!</h1>
    <?php if ($username == "admin") echo '<a href="/admin">Panel admina</a>'?>
    <h2>Naucz się szybko pisać.</h2>
    <h3>Dostępne moduły</h3>

    <div id="arrows">
        <div id="leftArrow" class="arrow" onclick="navigate(-1)">←</div>
        <div id="rightArrow" class="arrow" onclick="navigate(1)">→</div>
    </div>

    <div id="container-m">
        <?php
        function getUserStatFromDatabase() {
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
            if ($flaga = 1) {
                echo "<p class='d_name'>{$procentUkonczenia}%</p>";
                $flaga = 0;
                $procentUkonczenia = 0;
            }
            else
                echo "<p class='d_name'>0%</p>";
            echo "</div>";
        }
        ?>
    </div>

    <script>
        let currentIndex = 0; // Indeks bloku środkowego
        let cont = document.getElementById("container-m")
        let maxIndex = cont.children.length;
        let divNumber

        document.getElementById("hidden").setAttribute("id", "mainBlock");
        for (let i = 1; i <= 4; i++)
        {
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
            if (direction > 0 && currentIndex!=maxIndex)
            {
                if (currentIndex+4 < maxIndex) {
                    document.getElementById("hidden").removeAttribute('id');
                    document.getElementById("mainBlock").setAttribute("id", "hidden");
                    cont.children[currentIndex].setAttribute("id", "mainBlock");
                } else {
                    document.getElementById("mainBlock").setAttribute("id", "hidden");
                    cont.children[currentIndex].setAttribute("id", "mainBlock");
                }
            }
            else if (currentIndex!=maxIndex)
            {
                document.getElementById("mainBlock").removeAttribute('id');
                cont.children[currentIndex].setAttribute("id", "mainBlock");
                cont.children[currentIndex+5].setAttribute("id", "hidden");
            }


        }
    </script>

    <a href="/logout">Wyloguj</a>
</body>
</html>
