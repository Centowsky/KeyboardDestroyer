<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nauka</title>
</head>
<body>
    <h2>Strona Nauki</h2>
    
    <ul id="moduleList"></ul>

    <script>
        // Funkcja do odczytywania modułów z Local Storage
        function getModulesFromLocalStorage() {
            var modulesJSON = localStorage.getItem('modules') || '[]';
            return JSON.parse(modulesJSON);
        }

        // Funkcja do wyświetlania modułów na stronie
        function displayModules() {
            var moduleList = document.getElementById('moduleList');
            moduleList.innerHTML = '';

            // Pobierz listę modułów z Local Storage
            var modules = getModulesFromLocalStorage();

            // Wyświetl każdy moduł na stronie
            modules.forEach(function (module) {
                var listItem = document.createElement('li');
                listItem.textContent = module;
                moduleList.appendChild(listItem);
            });
        }

        // Wywołaj funkcję wyświetlania modułów przy ładowaniu strony
        displayModules();


    </script>
</body>
</html>
