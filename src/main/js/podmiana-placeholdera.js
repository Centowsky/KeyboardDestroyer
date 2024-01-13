let text =
    'muffin biscuit oat cake dessert soufflé cake wafer.' +
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
        check_empty();
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


function check_empty(){
    let textareaWartosc = document.getElementById('input_gorny').value;

    if (textareaWartosc === '') {
        //console.log('Pole textarea jest puste!');
        location.reload();

    }
    else {
        //console.log('Pole textarea nie jest puste.');
    }
}










