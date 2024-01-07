// po wcisnieciu
document.addEventListener('keydown', function(event) {
    const key = event.key;
    const button = document.querySelector(`button[data-key="${key}"]`);

    if (button) {
        button.style.transform = 'perspective(80px) rotateX(5deg) rotateY(1deg) translateY(3px) scale(0.96)';
        button.style.height = '64px';
        button.classList.add('active');
        button.style.setProperty('--kolor-tla-klawisza', 'rgba(0,0,0,0.68)');
        button.style.transition = 'background-color 0.01s ease';

        button.style.setProperty('--kolor-startu', 'rgba(255, 255, 255, 0.2)'); //zmiana koloru startu na kolor konca

        setTimeout(function() {
            button.style.transform = '';
            button.style.height = '65px';
            button.classList.remove('active');
        }, 500);


        setTimeout(function() {
            button.style.removeProperty('--kolor-tla-klawisza');
            button.style.transition = 'all .1s ease-in-out 0s';
            button.style.removeProperty('--kolor-startu');
        }, 100);

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


// //specjalna funkcja zeby spacja reagowała na wciskanie
// document.addEventListener('keydown', function(event) {
//     if (event.key === ' ' || event.keyCode === 32) {
//         const isInputFocused = document.activeElement.tagName === 'INPUT' && document.activeElement.type === 'text';
//         // document.activeElement.value += ' '; //wstawia spacje bo input ma problem
//
//         if (isInputFocused) {
//             let space = document.getElementById('space');
//             space.style.transform = 'perspective(80px) rotateX(5deg) rotateY(1deg) translateY(3px) scale(0.96)';
//             space.style.height = '64px';
//             space.classList.add('active');
//             space.style.setProperty('--kolor-tla-klawisza', 'rgba(0,0,0,0.68) ');
//             space.style.setProperty('--kolor-startu', 'rgba(255, 255, 255, 0.2)');
//
//             setTimeout(function() {
//                 space.style.transform = '';
//                 space.style.height = '65px';
//                 space.classList.remove('active');
//                 space.style.removeProperty('--kolor-tla-klawisza');
//                 space.style.removeProperty('--kolor-startu');
//             }, 500);
//
//             event.preventDefault();
//         }
//     }
// });
