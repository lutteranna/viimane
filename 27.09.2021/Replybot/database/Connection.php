<?php
class Connection {
    protected string $servername = 'localhost';
    protected string $username = 'root';
    protected string $password = 'Kiisa75518';
    protected string $database = 'replybot';

   /**
    * Error container
    *
    */
    public $connect_error;

    /**
     * MySQL connection object
     */
    private $connection;

    /**
     * kui kutsuda välja new Connection() käsk, siis käivitub __contruct()
     */
    public function __construct(bool $showDebug = false)
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($conn->connect_error) {
            $this->connect_error = $conn->connect_error;
            throw new Exception('Andmebaasi ühendus nurjus.');
        }

        if ($showDebug) {
            echo !($conn->connect_error) ? 'Ühendus õnnestus!' : 'Ühendus ebaõnnestus';
        }
        // salvestame loodud ühenduse ka klassi muutujasse:
        $this->connection = $conn;
    }

    /**
     * Kõikide sõnumite pärimiseks loodud funktsioon
     * @return array
     */
    public function getMessages(): array
    {
        $sql = 'SELECT * FROM messages';
        $results =$this->connection->query($sql);

        // Peidame SQL-i vigu, Vea kuvamise asemel saadame tagasi tühjad read
        if ($results === false) {
            return [];
        }

        return $this->parseMessages($results->fetch_all());
    }

    /**
     * Kõikide sõnumite pärimiseks loodud funktsioon
     * meetodi kasutus (new Connection())->insertMessage('my message');
     * @param string $message
     * @return bool
     */
    public function insertMessage(string $message, int $userId = null): bool
    {
        // // Only when using PDO! new PDO()
        // $sql = 'INSERT INTO messages
        //     (content, user_id) VALUES
        //     (:message, :userId)';
        // $statement = $this->connection->prepare($sql);
        // $statement->bindParam(':message', $message);
        // $statement->bindParam(':userId', $userId);

        $sql = 'INSERT INTO messages
            (content, user_id) VALUES
            (?, ?)';
        $statement = $this->connection->prepare($sql);
        $statement->bind_param('ss', $message, $userId);

        return $statement->execute(); // true if success, false otherwise
    }

    /**
     * Loome Message objektidega massiivi andmebaasi massiivist
     * @param array $rawMessage
     * @return array
     */
    private function parseMessages(array $rawMessages): array
    {
        $messages = [];
        foreach ($rawMessages as $rawMessage) {
            $message = new Message();
            $message->id = (int) $rawMessage[0];
            $message->content = (string) $rawMessage[1];
            $message->userId = (int) $rawMessage[2];
            $message->createdAt = new DateTime($rawMessage[3]);
            $messages[] = $message;
        }

        return $messages;
    }

    // TODO! siia lisada deleteMessage funktsioon
}