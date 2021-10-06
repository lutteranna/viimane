<?php
// . = "logic"
// .. = "replybot"
// fail asub database/Connection.php
include_once('./../models/Message.php');
include_once('./../database/Connection.php');

// initsialiseerime andmebaasi ühenduse:
$connection = new Connection();

$message = ''; // algväärtustame muutuja

// kontrollime, kas muutuja 'message' on saadetud ning kas see pole tühi
if (isset($_POST['message']) && $_POST['message'] !== '') {
    $message = $_POST['message'];

    // Salvestame iseenda sõnumi:
    $connection->insertMessage($message);
    // sleep(rand(1, 4)); // Pausime skripti 1-4 sekundiks - jätame mulje, et BOT mõtleb

    $reply = processMessage($message);

    // Salvestame Bot'i poolt genereeritud sõnumi ka andmebaasi:
    $connection->insertMessage($reply, 100);

    sendResponse([ 'reply' => $reply ]);
} else {
    // Tegeleme veaga. Kui message'it ei saadeta serverisse, siis saadame vastuseks veateate
    echo json_encode($_POST);
    sendResponse([ 'error' => 'No message sent' ], 422);
}

/**
 * BOT'i aju, siia lisame reegleid, kuidas BOT peaks vastame mingitele sisenditele
 * str_contains($phrase, $string) - otsib, kas fraasis sisaldub:
 *   $phrase=tekst, kust otsitakse midagi;
 *   $string=sõna, mida otsime,
 *   väljastab boolean'i e tõeväärtuse, nt true või false
 * strtolower($string) - kõik tähed lowercase'iks
 * strtoupper($string) - kõik tähed uppercase'iks
 * trim($string) - eemaldab tähemärke tekstist, vaikimi tühikuid/tab'e/ridu eest ja lõpust, nt "   tere    " => trim("   tere    ") = "tere"
 */
function processMessage(string $message): string {
    switch ($message) {
        case str_contains(strtolower($message), 'läheb'):
            $possibleReplies = ['Hästi', 'Enam-vähem', 'Pole viga. Kuidas endal?'];
            return (string)$possibleReplies[array_rand($possibleReplies, 1)];
        case str_contains(strtolower($message), 'nimi'):
            return 'TestBot';
        case str_contains(strtolower($message), 'aastane'):
            case str_contains(strtolower($message), 'vanus'):
            case str_contains(strtolower($message), 'vana'):
            return 'Ma olen ' . (new DateTime('2021-09-27'))->diff(new DateTime())->format('%d') . ' aastane.'; // 1päev=1 bot'i aasta
        default:
            $possibleReplies = ['Ei saanud aru.', 'Ma ei ole veel nii osav', 'Olen väsinud, küsi homme uuesti, äkki siis tean'];
            return (string)$possibleReplies[array_rand($possibleReplies, 1)]; // $possibleReplies[0] = Ei saanud aru.
    }
}

/**
 * Saadame päringu browserisse
 * Lisame päiseid ning vormindame data JSON kujule
 */
function sendResponse(array $data, int $statusCode = 200) {
    header('Content-Type: application/json; charset=UTF-8'); // määrame ära, et kõik sereri vastused on json kujul
    http_response_code($statusCode);
    echo json_encode($data);
}