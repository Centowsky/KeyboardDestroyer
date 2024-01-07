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
    <link rel="stylesheet" type="text/css" href="../src/css/moduly.css">
</head>
<body>
    <h1>Witaj, <i class="text-primary"><?php echo htmlspecialchars($username); ?></i>!</h1>
    <?php if ($username == "admin") echo '<a href="/admin">Panel admina</a>'?>
    <h2>Naucz się szybko pisać.</h2>
    <h3>Dostępne moduły</h3>

    <script>
        let currentIndex = 1; // Indeks bloku środkowego
        let maxIndex = 10;
        let divNumber

        function navigate(direction) {
            currentIndex += direction;

            if (currentIndex < 1) {
                currentIndex = 1;
            } else if (currentIndex > maxIndex) {
                currentIndex = maxIndex;
            }

            let cont = document.getElementById("container-m")
            document.getElementById("mainBlock").remove();
            const newDiv = document.createElement("div");
            newDiv.setAttribute('class', 'block')
            if (direction < 0)
            {
                const newContent = document.createTextNode(""+currentIndex);
                newDiv.appendChild(newContent);
                cont.insertBefore(newDiv, cont.children[0])
            }
            else
            {
                divNumber = currentIndex+5
                const newContent = document.createTextNode(""+divNumber);
                newDiv.appendChild(newContent);
                cont.appendChild(newDiv);
            }

            cont.children[0].setAttribute("id", "mainBlock");
            let ind= currentIndex
            for (const child of cont.children) {
                let text = document.createTextNode(ind)
                child.innerHTML = "";
                child.appendChild(text)
                ind+=1
            }
        }
    </script>
    <div id="arrows">
        <div id="leftArrow" class="arrow" onclick="navigate(-1)">←</div>
        <div id="rightArrow" class="arrow" onclick="navigate(1)">→</div>
    </div>

    <div id="container-m">
        <?php
        $i=0;
        foreach ($modules as $module) {
            if ($i<=5)
            {
                if($i==0)
                {
                    echo "<div class='block' id='mainBlock'>";
                }
                else
                {
                    echo "<div class='block'>";
                }
                echo "<p class='m_name'>{$module['ModuleName']}</p>";
                echo "<p class='d_name'>Difficulty Level: {$module['DifficultyLevel']}</p>";
                $liczbalekcji = sizeof($module['Lessons']);
                echo "<p class='d_name'>Number of lessons: {$liczbalekcji}</p>";
                echo "</div>";
                $i=$i+1;
            }
        }
        ?>
    </div>

    <a href="/logout">Wyloguj</a>
</body>
</html>
