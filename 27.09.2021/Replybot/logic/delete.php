<?php
// . = "logic"
// .. = "delete"
// fail asub database/Connection.php
include_once('./../database/Connection.php');

// initsialiseerime andmebaasi ühenduse:
$connection = new Connection();

// kontrollime, kas muutuja 'message' on saadetud ning kas see pole tühi
// Kasutame GET HTTP protokolli - päring tuleb DELETE protokolli pealt,
// aga parameetri saame kätte GET-st
if (isset($_GET['message_id']) && $_GET['message_id'] !== '') {
    $messageId = $_GET['message_id'];

    // TODO! Looge deleteMessage() meetod Connection.php klassi
    sendResponse([ 'success' => $connection->deleteMessage($messageId) ]);
} else {
    sendResponse([ 'error' => 'No message id sent' ], 422);
}

/**
 * Saadame päringu browserisse
 * Lisame päiseid ning vormindame data JSON kujule
 */
function sendResponse(array $data, int $statusCode = 200) {
    header('Content-Type: application/json; charset=UTF-8'); // määrame ära, et kõik serveri vastused on json kujul
    http_response_code($statusCode);
    echo json_encode($data);
}