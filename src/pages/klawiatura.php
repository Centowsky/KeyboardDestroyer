<?php
$headerPath = __DIR__ . "/../modules/header.php";

if (file_exists($headerPath)) {
    include($headerPath);
} else {
    echo "Błąd: Nie udało się załadować pliku header.php.";
}
?>
<form id="keybordSettings" style="display: none;">
    <div id="keyboardSoundOptions" >
        <label for="keyboardSound">Dźwięki klawiatury:</label>
        <select id="keyboardSound" name="keyboardSound">
            <option value="brak">brak</option>
            <option value="keystroke1">Dźwięk 1</option>
            <option value="keystroke2">Dźwięk 2</option>
            <option value="duck">kaczka</option>
        </select>
    </div>
    <div id="kolor" >
        <label for="kolork">motyw:</label>
        <select id="kolorki" name="kolorki">
            <option value="brak">brak</option>
            <option value="pink">pink</option>
            <option value="blue">blue</option>
            <option value="stars">gwiazdy</option>
            <option value="krajobraz">krajobraz</option>
            <option value="flowers">kwiaty</option>
            <option value="duck">kaczki</option>
        </select>
    </div>
    <div id="czcionka" >
        <label for="fonts">czcionka:</label>
        <select onchange="font(this)">
            <option>Georgia</option>
            <option>Palatino Linotype</option>
            <option>Book Antiqua</option>
            <option>Times New Roman</option>
            <option >Arial</option>
            <option>'Sevillana',cursive</option>
            <option>'Lemon', serif</option>
            <option>Impact</option>
            <option>Lucida Sans Unicode</option>
            <option>Tahoma</option>
            <option>Verdana</option>
            <option>Courier New</option>
            <option >'Grape Nuts',cursive</option>
        </select>
    </div>
    <div id="kolorCzcionki">
        <label for="colors">Kolor czcionki:</label>
        <select onchange="changeColor(this)">
            <option value="white">Biały</option>
            <option value="black">Czarny</option>
            <option value="red">Czerwony</option>
            <option value="blue">Niebieski</option>
            <option value="green">Zielony</option>
            <option value="purple">Fioletowy</option>
        </select>
    </div>

</form>


<div class="pole_tekstowe_do_pisania" id="pisanie">
    <label>
        <textarea id="input_gorny" class="input_do_pisania" type="text" spellcheck="false" oninput="sprawdzTekst()"></textarea>
        <textarea id="input_dolny" class="input_do_pisania" type="text" placeholder="" disabled></textarea>
    </label>
</div>



<div id="timer"
         style="
        display: none;
        background-color: rgba(0,0,0,0.79);
        padding: 10px;
        position: absolute;
        top:46%;
        margin-left: 250px;

">

    <p id="czas"></p>
    <p id="accuracy"></p>
</div>

<form id="customTextForm" style="display: none;">
    <textarea spellcheck="false" id="customText" style='width: 70%; color=rgba(227,14,14,0.64); background-color: rgba(80,77,77,0.64); font-size: 1.5em;' rows="6" name="customText" placeholder="Wprowadź tekst własny"></textarea>
    <br>
    <button type="button" style='margin-bottom: 100px;' onclick="updateCustomText()">Aktualizuj tekst</button>
</form>




<button type="button" id="wlasny-text" class="btn-custom"
        style="padding: 10px 20px;
         font-size: 16px;
            border: none;
            border-radius: 5px;
             cursor: pointer;
            position: relative;
                  top: -340px;
                  left: 20px;"
        onclick="toggleCustomTextForm()">
    Własny tekst</button>

<button type="button" id="ustawienia" class="btn-custom"
        style="padding: 10px 20px;
               font-size: 16px;
               border: none;
               border-radius: 5px;
               cursor: pointer;
               position: relative;
               top: -340px;
               right:  20px;"
        onclick="toggleSettings()">
    Ustawienia</button>


<div class="progress-bar-container">
    <div class="progress-bar" id="progressBar"></div>
</div>






<div class="keyboard" id="kk" style="margin-bottom: 100px;">
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

<div style="color: transparent;">d</div>




<script src="/src/main/js/predkosc.js"></script>

<script src="/src/main/js/mode-animation.js"></script>
<script src="/src/main/js/click-animation.js"></script>
<script src="/src/main/js/podmiana-placeholdera.js"></script><script>
        function updateCustomText() {
    let customTextForm = document.getElementById("customTextForm");
    const customText = document.getElementById('customText').value;
    const inputGorny = document.getElementById('input_gorny');
    const inputDolny = document.getElementById('input_dolny');
    const timer = document.getElementById('czas');
    const acc = document.getElementById('accuracy');

    // Zresetuj czas i dokładność
    czas_startu = null;
    czas_konca = null;
    c = 0;
    c_startu = 0;
    timer.style.display = 'none';
    acc.style.display = 'none';

    if (customText.trim() !== '') {
        inputDolny.placeholder = customText;
        originalnyTekstDolny = customText;

    } else {
        // Jeśli pole tekstowe jest puste, zresetuj też inputDolny
        inputDolny.placeholder = '';
    }

    // Zresetuj pole tekstowe input_gorny
    inputGorny.value = '';

    customTextForm.style.display='none';


}


function info() {
    let wpisany_tekst = document.getElementById('input_gorny').value;
    let accuracy = calculateAccuracy(originalnyTekstDolny, wpisany_tekst);
    dokladnosc = accuracy;
    let info = document.getElementById('timer');
    info.style.display='initial';
}

function toggleCustomTextForm() {
    let customTextForm = document.getElementById("customTextForm");
    let wlasny = document.getElementById("wlasny-text");

    if (customTextForm.style.display === "none") {
        customTextForm.style.display = "initial";
        wlasny.style.display = "none";


    } else {
        customTextForm.style.display = "none";
    }
}

function toggleSettings(){
    let settingForm = document.getElementById("keybordSettings");

    if (settingForm.style.display === "none") {
        settingForm.style.display = "initial";

    } else {
        settingForm.style.display = "none";
    }
}



    </script>
    <link rel="stylesheet" type="text/css" href="/src/css/main/baner.css">
    <link rel="stylesheet" type="text/css" href="/src/css/main/klawiatura.css">
    <link rel="stylesheet" type="text/css" href="/src/css/main/klawiatura-effects.css">
    <link rel="stylesheet" type="text/css" href="/src/css/main/zegar.css">
    <link rel="stylesheet" type="text/css" href="/src/css/main/pole_tekstowe.css">
    <link rel="stylesheet" type="text/css" href="/src/css/main/puste.css">

    <link rel="stylesheet" type="text/css" href="/src/css/main/predkos.css">

</body>
</html>