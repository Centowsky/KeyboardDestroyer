<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = file_get_contents('php://input');
    $handle = fopen('src/main/mode.json', 'w');
    fwrite($handle, $postData);
    fclose($handle);
    echo 'File updated successfully.';
} else {

    header('Content-Type: application/json');
    readfile('src/main/mode.json');
}
?>