const progressBar = document.getElementById('progressBar');
let typingSpeed = 0; // Przykładowa szybkość pisania
let lastKeyPressTime = Date.now();

// Aktualizacja paska postępu
function updateProgressBar() {
    progressBar.style.width = `${typingSpeed}%`;
}

// Funkcja do stopniowego zmniejszania szybkości, gdy nie klika się żadnego klawisza
function decreaseSpeed() {
    if (typingSpeed > 0) {
        typingSpeed = Math.max(0, typingSpeed - 0.3); // Zmniejsz szybkość (minimalnie do 0%)
        updateProgressBar();
        requestAnimationFrame(decreaseSpeed);
    }
}

// Rozpocznij stopniowe zmniejszanie szybkości po zakończeniu akcji kliknięcia
function startDecreaseSpeed() {
    requestAnimationFrame(decreaseSpeed);
}

// Obsługa zdarzenia klawiatury
document.addEventListener('keydown', function (event) {
    const currentTime = Date.now();
    const timeSinceLastKeyPress = currentTime - lastKeyPressTime;

    // Ignoruj klawisze specjalne
    if (event.key.length === 1) {
        typingSpeed = Math.min(100, typingSpeed + 40); // Zwiększ szybkość (maksymalnie do 100%)
        updateProgressBar();
    }

    lastKeyPressTime = currentTime;

    // Rozpocznij stopniowe zmniejszanie szybkości po zakończeniu akcji kliknięcia
    startDecreaseSpeed();
});