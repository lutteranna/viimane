<?php
// Esileht, url=/
// teeme lehe avalikuks urlil: argo.local/replybot

// . = "replybot"
// fail asub database/Connection.php
include_once('./database/Connection.php'); // impordime andmebaasi ühenduse klassi teisest failist
include_once('./models/Message.php');
$connection = new Connection();

?>
<!DOCTYPE html>
<html>
    <?php
    // Lisame siia template'i, mis on taaskasutatav kõikide lehtede <head> osas
    // See annab meile võimaluse taaskasutada sama faili mitmes lehes
    // partials/head.php sisaldab endas JS ning CSS failide importe
    include_once('partials/head.php');
    ?>
    <title>ReplyBot</title>
<body>

    <h1>Tere tulemast ReplyBot-i!</h1>
    <subtitle>Võid siia kirjutada mida iganes ning ReplyBot vastab sulle alati.</subtitle>
    <section id="pastMessages">
        <?php
            $messages = $connection->getMessages();
            // tahame siia html'i, siis
            ?>
                <div></div>
            <?php
            // Kui pole ühtegi sõnumit, siis kuvame infot selle kohta
            if (count($messages) === 0) { ?>
                <div class="messages no-entries-message">
                    <p>Hetkel sõnumid puuduvad.</p>
                </div>
            <?php } else {
                // Siia ilmub saadetud sõnumite vastused
                // kasutame tsükleid, et kuvada välja kõik sõnumid
                foreach ($messages as $message) {
                    ?>
                    <div class="messages <?php echo $message->userId ? '' : 'my-messages'; ?>">
                        <span class="delete" data-id="<?php echo $message->id; ?>">x</span>
                        <p><?php echo $message->content; ?></p>
                    </div>
                    <?php
                }
            }

        ?>
    </section>
    <form
        id="form"
        style="
            width: 420px;
            display: flex;
            flex-direction:row;
            justify-content: space-between;
        "
    >
        <textarea
            placeholder="Kirjuta midagi ReplyBot'ile"
            id="messageInput"
            type="text"
            name="message"
            rows="2"
            maxlength="255"
            style="
                min-height:40px;
                max-height:150px;
                width:300px;
                min-width:300px;
                max-width:300px;
                padding:5px;
            "
        ></textarea>
        <button id="sendButton" type="submit">Saada</button>
    </form>
</body>
</html>