<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Keyboard Destroyer</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">


    <link rel="stylesheet" type="text/css" href="/src/main/css/body.css">


    <link rel="stylesheet" type="text/css" href="/src/main/css/baner.css">
    <link rel="stylesheet" type="text/css" href="/src/main/css/klawiatura.css">
    <link rel="stylesheet" type="text/css" href="/src/main/css/klawiatura-effects.css">
    <link rel="stylesheet" type="text/css" href="/src/main/css/zegar.css">
    <link rel="stylesheet" type="text/css" href="/src/main/css/pole_tekstowe.css">
    <link rel="stylesheet" type="text/css" href="/src/main/css/puste.css">






    <link rel="icon" href="/images/logo.png"> <!--  czekamy na og pliki loga -->


    <!-- Ikonka nocy -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Ikonka light mode -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Ikonka loga -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,300,0,0" />



    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Redacted+Script:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=RocknRoll+One&display=swap" rel="stylesheet">


</head>
<body>
<?php
$username = isset($_SESSION['user']) ? $_SESSION['user'] : 'admin';
?>
<nav class="banner">

    <div id="x" class="button-container">
        <button id="button1" class="button" onclick="window.location.href=''">


            <!--         <image id="logo" src="/images/logo.png"></image> -->

        </button>
        <button id="button2" class="button" onclick="window.location.href='home'">Zaloguj</button>
        <button id="button3" class="button" onclick="window.location.href='learn'">Moduł Lekcji</button>

        <!--        <button id="button4" class="button" onclick="window.location.href=''">O nas</button>-->
        <!--        <button id="button4" class="button" onclick="window.location.href=''"></button>-->
    </div>

    <div id='trig' class="button-container">
        <div id="mode" class="button">
            <span id ="noc-ikonka" class="material-symbols-outlined">clear_night</span>
            <span id ="dzien-ikonka" class="material-symbols-outlined">light_mode</span>
        </div>
    </div>

</nav>



<div class="pole_tekstowe_do_pisania">
    <label>
        <textarea id="input_gorny" class="input_do_pisania" type="text"  spellcheck="false" oninput="sprawdzTekst() "></textarea>  <!-- Po tym piszesz -->
        <textarea id="input_dolny" class="input_do_pisania" type="text" placeholder="" disabled></textarea>
    </label>
</div>

<div id="timer">
    <p id="czas"></p>
    <p id="accuracy"></p>
</div>



<div class="keyboard">
    <button data-key="Escape">esc</button>
    <button data-key="1">1</button>
    <button data-key="2">2</button>
    <button data-key="3">3</button>
    <button data-key="4">4</button>
    <button data-key="5">5</button>
    <button data-key="6">6</button>
    <button data-key="7">7</button>
    <button data-key="8">8</button>
    <button data-key="9">9</button>
    <button data-key="0">0</button>
    <button data-key="-">-</button>
    <button data-key="=">=</button>
    <button data-key="Backspace">⬅</button>
    <button data-key="Delete">del</button>


    <button data-key="Tab">tab</button>
    <button data-key="q">Q</button>
    <button data-key="w">W</button>
    <button data-key="e">E</button>
    <button data-key="r">R</button>
    <button data-key="t">T</button>
    <button data-key="y">Y</button>
    <button data-key="u">U</button>
    <button data-key="i">I</button>
    <button data-key="o">O</button>
    <button data-key="p">P</button>
    <button data-key="[">[</button>
    <button data-key="]">]</button>
    <button data-key="|">\</button>
    <button data-key="PageUp">pg up</button>




    <button id="caps" data-key="CapsLock">caps</button>
    <button data-key="a">A</button>
    <button data-key="s">S</button>
    <button data-key="d">D</button>
    <button data-key="f">F</button>
    <button data-key="g">G</button>
    <button data-key="h">H</button>
    <button data-key="j">J</button>
    <button data-key="k">K</button>
    <button data-key="l">L</button>
    <button data-key=";">;</button>
    <button data-key="'">'</button>
    <button id='enter' data-key="Enter">enter</button>
    <button data-key="PageDown">pg dn</button>


    <button data-key="Shift" id="l-shift">shift</button>
    <button data-key="z">Z</button>
    <button data-key="x">X</button>
    <button data-key="c">C</button>
    <button data-key="v">V</button>
    <button data-key="b">B</button>
    <button data-key="n">N</button>
    <button data-key="m">M</button>
    <button data-key=",">,</button>
    <button data-key=".">.</button>
    <button data-key="/">/</button>
    <button data-key="Shift">shift</button>
    <!-- <button></button> -->
    <button data-key="ArrowUp">⬆</button>
    <button data-key="Insert">ins</button>
    <button data-key="Control">ctrl</button>

    <button class="btn" data-key="Meta">
        <svg stroke="#ffffff" xml:space="preserve" viewBox="0 0 80 80" xmlns:xlink="http://www.w3.org/1999/xlink"
             xmlns="http://www.w3.org/2000/svg" id="Capa_1" version="1.1" fill="#ffffff">
        <g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round"
                                                          id="SVGRepo_tracerCarrier"></g>
            <g id="SVGRepo_iconCarrier"> <g>
                    <path d="M64,48L64,48h-8V32h8c8.836,0,16-7.164,16-16S72.836,0,64,0c-8.837,0-16,7.164-16,16v8H32v-8c0-8.836-7.164-16-16-16 S0,7.164,0,16s7.164,16,16,16h8v16h-8l0,0l0,0C7.164,48,0,55.164,0,64s7.164,16,16,16c8.837,0,16-7.164,16-16l0,0v-8h16v7.98 c0,0.008-0.001,0.014-0.001,0.02c0,8.836,7.164,16,16,16s16-7.164,16-16S72.836,48.002,64,48z M64,8c4.418,0,8,3.582,8,8 s-3.582,8-8,8h-8v-8C56,11.582,59.582,8,64,8z M8,16c0-4.418,3.582-8,8-8s8,3.582,8,8v8h-8C11.582,24,8,20.417,8,16z M16,72 c-4.418,0-8-3.582-8-8s3.582-8,8-8l0,0h8v8C24,68.418,20.418,72,16,72z M32,48V32h16v16H32z M64,72c-4.418,0-8-3.582-8-8l0,0v-8 h7.999c4.418,0,8,3.582,8,8S68.418,72,64,72z"></path> </g> </g></svg>
        command
    </button>

    <button data-key="Alt">alt</button>
    <button data-key=" " id="space">space</button>
    <!--    jakby byly problemy to zamienic space na wpisana spacje -->
    <button data-key="Alt" id="p-alt">alt</button>
    <button data-key="fn">fn</button>
    <!-- przegladarki nie obsluguja fn, a wykrywa alta jako ctrl tez przez przegladarke    -->
    <button data-key="Control">ctrl</button>
    <button data-key="ArrowLeft">⬅</button>
    <button data-key="ArrowDown">⬇</button>
    <button data-key="ArrowRight">➡</button>




</div>





<div class="puste">
    d
</div>





<script src="/src/main/js/mode-animation.js"></script>
<script src="/src/main/js/click-animation.js"></script>
<script src="/src/main/js/podmiana-placeholdera.js"></script>
</body>
</html>