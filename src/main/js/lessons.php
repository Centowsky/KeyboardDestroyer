<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=keyboard_destroyer', 'root', '');
} catch (PDOException $e) {
    die('Błąd bazy danych: ' . $e->getMessage());
}

// Pobranie lessonId z parametrów GET
$lessonId = isset($_GET['lessonId']) ? intval($_GET['lessonId']) : 0;
echo $lessonId; // Upewnij się, że lessonId jest poprawnie pobierane

try {
    // Przygotowanie zapytania SQL do pobrania tekstu lekcji
    $query = 'SELECT TextContent FROM lessons WHERE lessonId = :lessonId';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':lessonId', $lessonId, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo $result['TextContent'];
    } else {
        echo 'Błąd pobierania textcontent lekcji';
    }
} catch (PDOException $e) {
    echo 'Błąd bazy danych: ' . $e->getMessage();
}
