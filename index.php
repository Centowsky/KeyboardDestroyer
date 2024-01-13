<?php
session_start();
// error_reporting(E_ERROR | E_WARNING);
// aktualny URL
$request_uri = $_SERVER['REQUEST_URI'];

// Routing
switch ($request_uri) {
    case '/':
        echo renderPage('glowna');
        break;
    case '/learn':
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }
        $modules = getModulesFromDatabase();
        echo renderPage('learn', ['modules' => $modules]);
        break;
    case '/admin':
        //session_start();
        if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin') {
            echo renderPage('admin');
        } else {
            header('Location: /learn');
        }
        break;
    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if (authenticateUser($username, $password)) {
                $_SESSION['user'] = $username;

                error_log('User logged in: ' . $username);

                header('Location: /learn');
                exit();
            } else {
                echo '<p style="color: red;">Błędne dane logowania.</p>';
            }
        }
        break;

    case '/glowna':
        echo renderPage('glowna');
        break;

    case '/klawiatura':
        echo renderPage('klawiatura');
        break;

    case '/logout':
        session_start();
        session_destroy();
        header('Location: /home');
        exit();
        break;

    case '/admin/add_module':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['moduleName'], $_POST['difficultyLevel'])) {
                $moduleName = $_POST['moduleName'];
                $difficultyLevel = $_POST['difficultyLevel'];

                if (saveModuleToDatabase($moduleName, $difficultyLevel)) {
                    header('Location: /admin');
                } else {
                    echo "Błąd podczas dodawania modułu.";
                }
            }
        }
        break;
    case '/admin/add_lesson':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['moduleId'], $_POST['lessonName'], $_POST['textContent'])) {
                $moduleId = $_POST['moduleId'];
                $lessonName = $_POST['lessonName'];
                $textContent = $_POST['textContent'];

                if (saveLessonToDatabase($moduleId, $lessonName, $textContent)) {
                    header('Location: /admin');
                } else {
                    echo "Błąd podczas dodawania modułu.";
                }
            }
        }
        break;
    case '/admin/modify_lesson':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['lessonId'], $_POST['newTextContent'])) {
                $lessonId = $_POST['lessonId'];
                $newTextContent = $_POST['newTextContent'];

                if (modifyLessonInDatabase($lessonId, $newTextContent)) {
                    header('Location: /admin');
                } else {
                    echo "Błąd podczas modyfikowania lekcji.";
                }
            }
        }
        break;
    default:
        echo renderPage('home');
        break;
}

function authenticateUser($username, $password) {
    try {
        $db = new PDO('mysql:host=localhost;dbname=keyboard_destroyer', 'root', '');

        $query = 'SELECT * FROM users WHERE Username = :username AND Password = :password';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($user !== false); // Zwraca true, jeśli użytkownik istnieje w bazie danych
    } catch (PDOException $e) {
        die('Błąd bazy danych: ' . $e->getMessage());
    }
}

function saveModuleToDatabase($moduleName, $difficultyLevel) {
    try {
        $db = new PDO('mysql:host=localhost;dbname=keyboard_destroyer', 'root', '');

        $query = 'INSERT INTO lessonmodules (ModuleName, DifficultyLevel) VALUES (:moduleName, :difficultyLevel)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':moduleName', $moduleName);
        $stmt->bindParam(':difficultyLevel', $difficultyLevel);

        return $stmt->execute();
    } catch (PDOException $e) {
        die('Błąd bazy danych: ' . $e->getMessage());
    }
}

function saveLessonToDatabase($moduleId, $lessonName, $textContent) {
    try {
        $db = new PDO('mysql:host=localhost;dbname=keyboard_destroyer', 'root', '');

        $query = 'INSERT INTO lessons (ModuleID, LessonName, TextContent) VALUES (:moduleId, :lessonName, :textContent)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':moduleId', $moduleId);
        $stmt->bindParam(':lessonName', $lessonName);
        $stmt->bindParam(':textContent', $textContent);

        return $stmt->execute();
    } catch (PDOException $e) {
        die('Błąd bazy danych: ' . $e->getMessage());
    }
}
function modifyLessonInDatabase($lessonId, $newTextContent) {
    try {
        $db = new PDO('mysql:host=localhost;dbname=keyboard_destroyer', 'root', '');

        $query = 'UPDATE lessons SET TextContent = :newTextContent WHERE LessonID = :lessonId';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':newTextContent', $newTextContent);
        $stmt->bindParam(':lessonId', $lessonId);

        return $stmt->execute();
    } catch (PDOException $e) {
        die('Błąd bazy danych: ' . $e->getMessage());
    }
}

function getModulesFromDatabase() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=keyboard_destroyer', 'root', '');

        $query = 'SELECT lm.ModuleID, lm.ModuleName, lm.DifficultyLevel, l.LessonID, l.LessonName, l.TextContent
                  FROM lessonmodules lm
                  LEFT JOIN lessons l ON lm.ModuleID = l.ModuleID
                  ORDER BY lm.ModuleID ASC, l.LessonID ASC';

        $stmt = $db->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Przetworzenie wyników na strukturę zagnieżdżoną dla łatwiejszej obsługi w PHP
        $modules = [];

        foreach ($result as $row) {
            $moduleId = $row['ModuleID'];
            $moduleName = $row['ModuleName'];
            $difficultyLevel = $row['DifficultyLevel'];
            $lessonId = $row['LessonID'];
            $lessonName = $row['LessonName'];
            $textContent = $row['TextContent'];

            // Dodanie modułu, jeśli nie istnieje
            if (!isset($modules[$moduleId])) {
                $modules[$moduleId] = [
                    'ModuleID' => $moduleId,
                    'ModuleName' => $moduleName,
                    'DifficultyLevel' => $difficultyLevel,
                    'Lessons' => []
                ];
            }

            // Dodanie lekcji do modułu
            $modules[$moduleId]['Lessons'][] = [
                'LessonID' => $lessonId,
                'LessonName' => $lessonName,
                'TextContent' => $textContent
            ];
        }

        return $modules;
    } catch (PDOException $e) {
        die('Błąd bazy danych: ' . $e->getMessage());
    }
}

// Funkcja renderująca stronę
function renderPage($page, $data = [])
{
    extract($data);  // Wyciąga zmienne z tablicy asocjacyjnej
    ob_start();
    include "src/pages/$page.php";
    return ob_get_clean();
}

?>
