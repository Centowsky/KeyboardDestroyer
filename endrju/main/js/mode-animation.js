let dzien = document.getElementById('dzien-ikonka');
let noc = document.getElementById('noc-ikonka');

// zmienne banera
let root = document.documentElement;
let kolorTlaBaneraDarkmode = getComputedStyle(root).getPropertyValue('--kolor-tla_banera-darkmode');
let kolorTlaBaneraLightmode = getComputedStyle(root).getPropertyValue('--kolor-tla_banera-lightmode');

let kolorTlaPrzyciskuDarkmode= getComputedStyle(root).getPropertyValue('--kolor-tla_przycisku-darkmode');
let kolorTlaPrzyciskuLightmode= getComputedStyle(root).getPropertyValue('--kolor-tla_przycisku-lightmode');

let kolorCzcionkiPrzyciskuDarkmode =  getComputedStyle(root).getPropertyValue('--kolor-czcionki-przycisku-darkmode');
let kolorCzcionkiPrzyciskuLightmode =  getComputedStyle(root).getPropertyValue('--kolor-czcionki-przycisku-lightmode');

let kolorTlaIkonkiLightmode = getComputedStyle(root).getPropertyValue('--kolor-tla-ikonki-lightmode');
let kolorTlaIkonkiDarkmode = getComputedStyle(root).getPropertyValue('--kolor-tla-ikonki-darkmode');

let kolorHoverPrzyciskuDarkmode = getComputedStyle(root).getPropertyValue('--hover-tla_przycisku-darkmode');
let kolorHoverPrzyciskuLightmode= getComputedStyle(root).getPropertyValue('--hover-tla_przycisku-lightmode');

let kolorGlowDarkmode = getComputedStyle(root).getPropertyValue('--kolor-glow-darkmode');
let kolorGlowLightmode = getComputedStyle(root).getPropertyValue('--kolor-glow-lightmode');



//zmienne containerow
let kolorTlaContainerowDarkmode = getComputedStyle(root).getPropertyValue('--kolor-tla-kart-darkmode');
let kolorTlaContainerowLightmode = getComputedStyle(root).getPropertyValue('--kolor-tla-kart-lightmode');

let kolorTlaDeskrypcjiContainerowDarkmode = getComputedStyle(root).getPropertyValue('--kolor-tla-deskrypcji-darkmode');
let kolorTlaDeskrypcjiContainerowLightmode = getComputedStyle(root).getPropertyValue('--kolor-tla-deskrypcji-lightmode');

let kolorCzcionkiDeskrypcjiDarkmode = getComputedStyle(root).getPropertyValue('--kolor-tekstu-deskrypcji-darkmode');
let kolorCzcionkiDeskrypcjiLightmode =  getComputedStyle(root).getPropertyValue('--kolor-tekstu-deskrypcji-lightmode');

//zmienne jasności strony
let brightnessDarkmode = getComputedStyle(root).getPropertyValue('--brightnessDarkmode');
let brightnessLightmode = getComputedStyle(root).getPropertyValue('--brightnessLightmode');


let kolorCzcionkiOnasH1Darkmode = getComputedStyle(root).getPropertyValue('--kolor-czcionki-onas-h1-darkmode');
let kolorCzcionkiOnasH1Lightmode = getComputedStyle(root).getPropertyValue('--kolor-czcionki-onas-h1-lightmode');

let kolorCzcionkiOnasPDarkmode = getComputedStyle(root).getPropertyValue('--kolor-czcionki-onas-p-darkmode');
let kolorCzcionkiOnasPLightmode = getComputedStyle(root).getPropertyValue('--kolor-czcionki-onas-p-lightmode');


let kolorTlaHoverOnasDarkmode = getComputedStyle(root).getPropertyValue('--kolor-tla-hover-onas-darkmode');
let kolorTlaHoverOnasLightmode  = getComputedStyle(root).getPropertyValue('--kolor-tla-hover-onas-lightmode');

let kolorShadowOnasDarkmode= getComputedStyle(root).getPropertyValue('--kolor-shadow-onas-darkmode');
let kolorShadowOnasLightmode= getComputedStyle(root).getPropertyValue('--kolor-shadow-onas-lightmode');


let kolorNewsletterH1Darkmode = getComputedStyle(root).getPropertyValue('--kolor-czcionki-newsletter-h1-darkmode');
let kolorNewsletterH1Lightmode = getComputedStyle(root).getPropertyValue('--kolor-czcionki-newsletter-h1-lightmode');

let kolorTlaNewsleteraDarkmode = getComputedStyle(root).getPropertyValue('--kolor-tla-newslettera-darkmode');
let kolorTlaNewsleteraLightmode = getComputedStyle(root).getPropertyValue('--kolor-tla-newslettera-lightmode');


let kolorTlaPrzyciskuNewsleteraDarkmode= getComputedStyle(root).getPropertyValue('--kolor-tla-przycisku-newslettera-darkmode');
let kolorTlaPrzyciskuNewsleteraLightmode= getComputedStyle(root).getPropertyValue('--kolor-tla-przycisku-newslettera-lightmode');

let kolorCzcionkiPrzyciskuNewsleteraDarkmode = getComputedStyle(root).getPropertyValue('--kolor-czcionki-przycisku-newsletera-darkmode');
let kolorCzcionkiPrzyciskuNewsleteraLightmode = getComputedStyle(root).getPropertyValue('--kolor-czcionki-przycisku-newsletera-lightmode');

let kolorTlaInputuDarkmode = getComputedStyle(root).getPropertyValue('--kolor-tla-inputu-darkmode');
let kolorTlaInputuLightmode= getComputedStyle(root).getPropertyValue('--kolor-tla-inputu-lightmode');



// kolorki klawiatury
let kolorTlaCalejKlawiaturyDarkmode =  getComputedStyle(root).getPropertyValue('--kolor-tla-calej-klawiatury-darkmode');
let kolorTlaCalejKlawiaturyLightmode=  getComputedStyle(root).getPropertyValue('--kolor-tla-calej-klawiatury-lightmode');

let kolorTlaKlawiszaDarkmode =  getComputedStyle(root).getPropertyValue('--kolor-tla-klawisza-darkmode');
let kolorTlaKlawiszaLightmode =  getComputedStyle(root).getPropertyValue('--kolor-tla-klawisza-lightmode');

let kolorCzcionkiKlawiszaDarkmode =  getComputedStyle(root).getPropertyValue('--kolor-czcionki-klawisza-darkmode');
let kolorCzcionkiKlawiszaLightmode =  getComputedStyle(root).getPropertyValue('--kolor-czcionki-klawisza-lightmode');




// funkcja pobierająca jaki jest obecny tryb
function checkMode() {
    return fetch('../mode.json')
        .then(response => response.json())
        .then(data => {
            const mode = data.mode;

            if (mode === 'light') {
                return 'light';
            } else if (mode === 'dark') {
                return 'dark';
            } else {
                return 'error';
            }
        })
        .catch(error => {
            console.error('Błąd wczytywania pliku JSON:', error);
            return 'Błąd wczytywania pliku JSON';
        });
}

//funkcja nadpisujaca plik json na inny tryb
function updateMode(newMode) {
    fetch('../update_mode.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ mode: newMode }),
    })
        .then(response => response.text())
        .then(data => {
            //console.log(data);
        })
        .catch(error => console.error('Błąd podczas aktualizacji trybu:', error));
}

function SetDarkTheme(){
    root.style.setProperty('--brightness', brightnessDarkmode.toString());

    //zmienne banera
    root.style.setProperty('--kolor-tla_banera', kolorTlaBaneraDarkmode.toString());
    root.style.setProperty('--kolor-tla_przycisku', kolorTlaPrzyciskuDarkmode.toString());
    root.style.setProperty('--kolor-czcionki-przycisku', kolorCzcionkiPrzyciskuDarkmode.toString());
    root.style.setProperty('--kolor-tla-ikonki', kolorTlaIkonkiDarkmode.toString());
    root.style.setProperty('--hover-tla_przycisku', kolorHoverPrzyciskuDarkmode.toString());

    root.style.setProperty('--kolor-glow', kolorGlowDarkmode.toString());

    let przyciski = document.getElementsByClassName('button');
    for (let i = 0; i < przyciski.length; i++) {
        przyciski[i].style.fontWeight = 'lighter';
    }

    noc.style.display = 'none';
    dzien.style.display = 'initial';

    //zmienne containera
    root.style.setProperty('--kolor-tla-kart', kolorTlaContainerowDarkmode.toString());
    root.style.setProperty('--kolor-tla-deskrypcji', kolorTlaDeskrypcjiContainerowDarkmode.toString());
    root.style.setProperty('--kolor-tekstu-deskrypcji', kolorCzcionkiDeskrypcjiDarkmode.toString());



/////////////////////////////////////////////////
    root.style.setProperty('--kolor-czcionki-onas-h1', kolorCzcionkiOnasH1Darkmode.toString());
    root.style.setProperty('--kolor-czcionki-onas-p', kolorCzcionkiOnasPDarkmode.toString());

    root.style.setProperty('--kolor-tla-hover-onas', kolorTlaHoverOnasDarkmode.toString());

    root.style.setProperty('--kolor-shadow-onas', kolorShadowOnasDarkmode.toString());

    root.style.setProperty('--kolor-czcionki-newsletter-h1', kolorNewsletterH1Darkmode.toString());

    root.style.setProperty('--kolor-tla-newslettera', kolorTlaNewsleteraDarkmode.toString());


    root.style.setProperty('--kolor-tla-przycisku-newslettera', kolorTlaPrzyciskuNewsleteraDarkmode.toString());


    root.style.setProperty('--kolor-czcionki-przycisku-newsletera', kolorCzcionkiPrzyciskuNewsleteraDarkmode.toString());

   // root.style.setProperty('--kolor-tla-onas', kolorTlaContainerowDarkmode.toString());
   // root.style.setProperty('--kolor-czcionki-onas-p', kolorCzcionkiDeskrypcjiDarkmode.toString());

    root.style.setProperty('--kolor-tla-inputu', kolorTlaInputuDarkmode.toString());
/////////////////////////////////////////////////
    // klawiatura
    root.style.setProperty('--kolor-tla-calej-klawiatury', kolorTlaCalejKlawiaturyDarkmode.toString());
    root.style.setProperty('--kolor-tla-klawisza', kolorTlaKlawiszaDarkmode.toString());
    root.style.setProperty('--kolor-czcionki-klawisza', kolorCzcionkiKlawiszaDarkmode.toString());
}

function SetLightTheme(){
    // brightness strony
    root.style.setProperty('--brightness', brightnessLightmode.toString());

    root.style.setProperty('--kolor-tla_banera', kolorTlaBaneraLightmode.toString());
    root.style.setProperty('--kolor-tla_przycisku', kolorTlaPrzyciskuLightmode.toString());
    root.style.setProperty('--kolor-czcionki-przycisku', kolorCzcionkiPrzyciskuLightmode.toString());
    let przyciski = document.getElementsByClassName('button');
    for (let i = 0; i < przyciski.length; i++) {
        przyciski[i].style.fontWeight = 'bolder';
    }
    root.style.setProperty('--kolor-tla-ikonki', kolorTlaIkonkiLightmode.toString());
    root.style.setProperty('--hover-tla_przycisku', kolorHoverPrzyciskuLightmode.toString());
    root.style.setProperty('--kolor-glow', kolorGlowLightmode.toString());

    dzien.style.display = 'none';
    noc.style.display = 'initial';


    //zmienne containera

    root.style.setProperty('--kolor-tla-kart', kolorTlaContainerowLightmode.toString());
    root.style.setProperty('--kolor-tla-deskrypcji', kolorTlaDeskrypcjiContainerowLightmode.toString());
    root.style.setProperty('--kolor-tekstu-deskrypcji', kolorCzcionkiDeskrypcjiLightmode.toString());



    /////////////////////////////////
    //root.style.setProperty('--kolor-tla-onas', kolorTlaContainerowLightmode.toString());
    //root.style.setProperty('--kolor-czcionki-onas-p', kolorCzcionkiDeskrypcjiLightmode.toString());

    root.style.setProperty('--kolor-czcionki-onas-h1', kolorCzcionkiOnasH1Lightmode.toString());
    root.style.setProperty('--kolor-czcionki-onas-p', kolorCzcionkiOnasPLightmode.toString());
    root.style.setProperty('--kolor-tla-hover-onas', kolorTlaHoverOnasLightmode.toString());

    root.style.setProperty('--kolor-shadow-onas', kolorShadowOnasLightmode.toString());


    root.style.setProperty('--kolor-czcionki-newsletter-h1', kolorNewsletterH1Lightmode.toString());

    root.style.setProperty('--kolor-tla-newslettera', kolorTlaNewsleteraLightmode.toString());

    root.style.setProperty('--kolor-tla-przycisku-newslettera', kolorTlaPrzyciskuNewsleteraLightmode.toString());

    root.style.setProperty('--kolor-czcionki-przycisku-newsletera', kolorCzcionkiPrzyciskuNewsleteraLightmode.toString());


    root.style.setProperty('--kolor-tla-inputu', kolorTlaInputuLightmode.toString());
    ///////////////////////
    //klawiatura

    root.style.setProperty('--kolor-tla-calej-klawiatury', kolorTlaCalejKlawiaturyLightmode.toString());
    root.style.setProperty('--kolor-tla-klawisza', kolorTlaKlawiszaLightmode.toString());
    root.style.setProperty('--kolor-czcionki-klawisza', kolorCzcionkiKlawiszaLightmode.toString());
}

//funkcja ustawiająca kolory na stronie po odpaleniu
function SetColors() {
    checkMode().then(result => {
        //console.log(result);

        // darkmode
        if (result === 'dark') {
            SetDarkTheme();
        }

        //lightmode
        if (result === 'light') {
            SetLightTheme();
        }
    });
}

//funkcja zmienia kolory na stronie i update'uje json po kliknieciu zeby sie zachowalo
function ChangeMode(){
    checkMode().then(result => {
        //console.log(result);

        if (result === 'dark') {
            SetLightTheme();
            updateMode('light');
        }
        if (result === 'light') {
            SetDarkTheme();
            updateMode('dark');
        }
    });
}


SetColors();
document.getElementById('trig').onclick = function () {
    ChangeMode();
}
