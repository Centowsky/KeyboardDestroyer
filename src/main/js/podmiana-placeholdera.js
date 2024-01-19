let text =
    'muffin biscuit oat cake dessert souffle cake wafer.' +
    'carrot cake icing sugar plum icing brownie macaroon. ' +
    'sweet chocolate bar lollipop gummi bears dragée jujubes toffee chupa chups.';

document.getElementById('input_dolny').placeholder = text;
let originalnyTekstDolny = text;
let czas_konca = null;
let czas_startu = null;
let timer = document.getElementById('czas');
timer.style.display = 'none';

let acc = document.getElementById('accuracy');
acc.style.display = 'none';

let dokladnosc ='none';
/////////////////////////////////////////////////////////////////////////////////////////
function getDate(){
    const teraz = new Date();
    const godzina = teraz.getHours();
    const minuta = teraz.getMinutes();
    const sekunda = teraz.getSeconds();

    date = `${godzina}:${minuta}:${sekunda}`
    return date;
}

function policz_roznice(czas_startu, czas_konca) {
    const [godzinaStart, minutaStart, sekundaStart] = czas_startu.split(':').map(Number);
    const [godzinaKoniec, minutaKoniec, sekundaKoniec] = czas_konca.split(':').map(Number);

    const start = new Date(0, 0, 0, godzinaStart, minutaStart, sekundaStart);
    const koniec = new Date(0, 0, 0, godzinaKoniec, minutaKoniec, sekundaKoniec);

    const roznica = koniec.getTime() - start.getTime();

    const roznica_w_sekundach = roznica / 1000;

    let mess = 'Udało Ci się w ' + roznica_w_sekundach.toString() + ' sekund';

    return mess;
}




let c = 0;
function info() {
    //console.log("bylo:", text);
    let wpisany_tekst = document.getElementById('input_gorny').value;
    //console.log("wpisales:",wpisany_tekst);

    let accuracy = calculateAccuracy(text, wpisany_tekst);
    //console.log("Dokładność:", accuracy + "%");
    dokladnosc = accuracy;


}

function calculateAccuracy(originalText, enteredText) {
    originalText = originalText.toLowerCase().trim();
    enteredText = enteredText.toLowerCase().trim();

    let minLength = Math.min(originalText.length, enteredText.length);

    let matchingChars = 0;
    for (let i = 0; i < minLength; i++) {
        if (originalText[i] === enteredText[i]) {
            matchingChars++;
        }
    }

    let accuracy = (matchingChars / minLength) * 100;
    return accuracy.toFixed(2);
}

let c_startu = 0;



function sprawdzTekst() {
    const tekstGorny = document.getElementById('input_gorny').value;
    const inputDolny = document.getElementById('input_dolny');
    let nowyTekstDolny = '';

    if (originalnyTekstDolny === '') {
        originalnyTekstDolny = inputDolny.placeholder;
        return;
    }

    document.addEventListener('keydown', function(event) {
        const key = event.key;

        if(c_startu===0){
            czas_startu = getDate();
            //console.log(czas_startu);
            c_startu=1;
        }


        if (key === 'Delete') {
            nowyTekstDolny = originalnyTekstDolny;
        }
    });

    for (let i = 0; i < originalnyTekstDolny.length; i++) {
        // check_empty();
        if (i < tekstGorny.length) {
            if (tekstGorny[i] === originalnyTekstDolny[i]) {
                nowyTekstDolny += originalnyTekstDolny[i];
            } else {
                nowyTekstDolny += tekstGorny[i];
            }
        } else {
            nowyTekstDolny += originalnyTekstDolny[i];
        }
    }

    inputDolny.placeholder = nowyTekstDolny;



    if (tekstGorny.length >= inputDolny.placeholder.length) {
        if(c===0){
            info();
            czas_konca = getDate();
            //console.log(czas_konca);
            c=1;
            timer.innerHTML = policz_roznice(czas_startu, czas_konca);
            timer.style.display = 'grid';

            acc.innerHTML = `Twoja dokładność to: ${dokladnosc}%`;
            acc.style.display = 'grid';
        }

    }
}
////////////////////////////////////////////////////////





////////////////////////////////////////////////////////
// do tego miejsca tekst musi byc podmieniony
let currentIndex = 0;
let textareaWartosc = document.getElementById('input_gorny').value;
document.addEventListener('keydown', function(event) {

    // if (textareaWartosc === '')
    //     location.reload();

    if(currentIndex<0){
        currentIndex=0;
    }

    const pressedKey = event.key; // wcisniety klawisz
    const key_to_press = text[currentIndex]; // klawisz ktory powinien byc wcisniety

    currentIndex++; // jak juz wcisniety klawisz no to index ++

    const button = document.querySelector(`button[data-key="${pressedKey}"]`); // bo zmieniamy styl wcisnietego
    button.classList.remove('highlight-white');

    if (button) {
        // console.log("button: ", button)
        // console.log("pressedKey: ", pressedKey)
        // console.log("key_to_press: ", key_to_press)
        // console.log("currentIndex: ", currentIndex)
        // console.log("textareawartosc: ", textareaWartosc)
        // console.log("--------------------")

        if (pressedKey === key_to_press) {
            button.classList.add('highlight-green');
            button.classList.remove('highlight-red');


        } else if (pressedKey === "Backspace" && currentIndex > 0) { //jesli blad
            currentIndex=currentIndex-2;
            const prevButton = document.querySelector(`button[data-key="${text[currentIndex]}"]`);
            prevButton.classList.remove('highlight-green', 'highlight-red');

        } else {
            button.classList.add('highlight-red');
            button.classList.remove('highlight-green');
        }


        button.style.transform = 'perspective(80px) rotateX(5deg) rotateY(1deg) translateY(3px) scale(0.96)';
        button.style.height = '64px';
        button.classList.add('active');
        button.style.setProperty('--kolor-tla-klawisza', 'rgba(0,0,0,0.68)');
        button.style.transition = 'background-color 0.01s ease';
        button.style.setProperty('--kolor-startu', 'rgba(255, 255, 255, 0.2)');

        setTimeout(function() {
            button.style.transform = '';
            button.style.height = '65px';
            button.classList.remove('active');
        }, 500);

        setTimeout(function() {
            button.style.removeProperty('--kolor-tla-klawisza');
            button.style.transition = 'all .1s ease-in-out 0s';
            button.style.removeProperty('--kolor-startu');
            button.classList.remove('highlight-green', 'highlight-red');
        }, 600);
    }
});



function next_letter(index) {
    // console.log(text[index]);
    let litera = text[index];



    let high_white = document.querySelector(`button[data-key="${litera}"]`);
    high_white.classList.add('highlight-white');

}
let current = 0;
next_letter(current);

document.addEventListener('keydown', function(event) {
    const pressedKey = event.key;


    if (current < text.length - 1) {
        current++;
        next_letter(current);
    }
});























// po puszczeniu
document.addEventListener('keyup', function(event) {
    const key = event.key;
    const button = document.querySelector(`button[data-key="${key}"]`);

    if (button) {
        button.style.transform = '';
        button.style.height = '65px';
        button.classList.remove('active');
        // console.log('wykonalem sie');
    }

    // setTimeout(function() {
    //     button.style.removeProperty('--kolor-startu');
    // }, 900);


});













//wylaczenie funkcjonalnosci klawiszy
document.addEventListener('keydown', function(event) {
    if (event.key === 'PageUp' ||
        event.key === 'PageDown' ||
        event.key.startsWith('Arrow') ||
        event.key === 'Alt' ||
        event.key === 'space' ||
        event.key === 'Tab' ||
        event.key === 'Enter' || //tu moze warunek zeby zatrzymac czas
        event.key === 'Meta') {
        event.preventDefault();
    }
});









