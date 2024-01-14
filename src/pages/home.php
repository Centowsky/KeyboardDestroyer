<?php
$headerPath = __DIR__ . "/../modules/header.php";

if (file_exists($headerPath)) {
    include($headerPath);
} else {
    echo "Błąd: Nie udało się załadować pliku header.php.";
}
?>

<body>
<div id="cytat-zachecajacy">
    <h1>Szybkie pisanie to nasza pasja. <br>
        Z nami odkryjesz swoją klawiaturę na nowo!</h1>
</div>

<div id="container">
    <div class="square" id="div1">
        <div id="img1" class="square-inner"></div>
        <div class="description-container">
            <a href="/klawiatura" class="description">Sprawdź swoje umiejętnosci ➡</a>
        </div>
    </div>

    <div class="square" id="div2">
        <div id="img2" class="square-inner"></div>
        <div class="description-container">
            <a href="/learn" class="description">Lekcje ➡</a>
        </div>
    </div>
    <!-- Dodac atrybucje-->

    <div class="square" id="div3">
        <div id="img3" class="square-inner"></div>
        <div class="description-container">
            <a href="home.html" class="description">Porady i wskazówki ➡</a>
        </div>
    </div>
    <!-- Dodac atrybucje-->

</div>

<div id="onas">
    <h1>
        Dowiedz się o nas!
    </h1>
    <p>
        Jesteśmy zespołem Keyboard Destroyers -
        pasjonatami szybkiego i precyzyjnego pisania na klawiaturze.
        Naszą misją jest nie tylko nauka skutecznego posługiwania się klawiaturą,
        ale również inspiracja innych do odkrycia potencjału,
        jaki drzemie w umiejętnościach szybkiego, bezwzrokowego pisania.

        Poprzez nasz zgraną ekipę specjalistów, oferujemy niezrównane narzędzia,
        strategie i szkolenia, które przekształcają codzienne pisanie
        w przyjemną i efektywną aktywność.

        Jesteśmy tu, by pomóc Ci
        zgłębić tajniki szybkiego pisania na klawiaturze i pokazać,
        że jest to nie tylko umiejętność, ale także radość i satysfakcja
        z wydajnej pracy przy komputerze.

        Dołącz do nas, by rozpocząć
        niezwykłą podróż ku mistrzostwu w korzystaniu z klawiatury!
    </p>
</div>

<div id="newsletter">
    <h1>
        Zapisz się do newslettera!
    </h1>
    <label>
        <input type="email" placeholder="wpisz email"></input>
    </label>
    <button id="button7" class="button" onclick="window.location.href=''">
        Zapisz mnie!
    </button>
</div>
<script src="/src/main/js/mode-animation.js"></script>
</body>
</html>