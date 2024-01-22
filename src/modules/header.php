<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
}

$currentFileName = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
$cssFilePath = "../src/css/{$currentFileName}.css";

$currentUrl = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Keyboard Destroyer</title>
    <link rel="icon" href="/images/logo.png"> <!--  czekamy na og pliki loga -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssFilePath; ?>">
    <link rel="stylesheet" type="text/css" href="/src/css/header.css">
    <!-- <link rel="stylesheet" type="text/css" href="/src/css/main/body.css">
    <link rel="stylesheet" type="text/css" href="/src/css/main/baner.css">
    <link rel="stylesheet" type="text/css" href="/src/css/main/cytat.css">
    <link rel="stylesheet" type="text/css" href="/src/css/main/container.css">
    <link rel="stylesheet" type="text/css" href="/src/css/main/newsletter.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,300,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Redacted+Script:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=RocknRoll+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">

</head>
<?php
if (strpos($currentUrl, '/login_page') === false) {
    ?>
    <nav class="banner">
        <div id="x" class="button-container">
            <button id="button3" class="button" onclick="window.location.href='home'">Home</button>
            <button id="button3" class="button" onclick="window.location.href='learn'">Nauka</button>
            <button id="button4" class="button"
                onclick="window.location.href='klawiatura'; localStorage.setItem('selectedLearning', 'true');">Sprawdź
                siebie</button>

            <?php
            if (isset($_SESSION['user'])) {
                echo '<button id="button2" class="button" disabled>Zalogowany jako: ' . $username . '</button>';
            }
            ?>
            <?php
            if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin') {
                echo '<button id="button2" class="button" onclick="window.location.href=\'admin\'">Panel Admina</button>';
            }
            ?>
            <?php
            if (isset($_SESSION['user'])) {
                echo '<button id="button3" class="button" onclick="window.location.href=\'logout\'">Wyloguj</button>';
            } else {
                echo '<button id="button3" class="button" onclick="window.location.href=\'login_page\'">Zaloguj</button>';
            }
            ?>
        </div>

        <!-- <div id='trig' class="button-container">
            <div id="mode" class="button">
                <span id="noc-ikonka" class="material-symbols-outlined">clear_night</span>
                <span id="dzien-ikonka" class="material-symbols-outlined">light_mode</span>
            </div>
        </div> -->
    </nav>
    <?php
}
?>