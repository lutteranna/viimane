window.onload = () => { // ootame ära, kuni HTML on end browser'is ära laadinud ja alles siis käivitame muud JS funktsioonid
    console.log('laadisin ära');

    const form = document.getElementById('form');
    form.addEventListener('submit', sendRequest);

    const form = document.getElementByClassName('delete');
    deleteButtons.forEach();addEventListener('submit', sendRequest);
    /**
     * Tekitame funktsiooni, mis saadab serverisse meie saadetud sõnumi
     * @param {SubmitEvent} event
     */
    function sendRequest(event) {
        document.getElementById('sendButton').disabled = true; // Keelame saata, kuni pole vastust saanud
        const message = document.getElementById('messageInput').value;

        addMyMessage(message); // lisame ka enda kirjutatud sõnumi vaatevälja
        document.getElementById('messageInput').value = ''; // teeme oma sisendi tühjaks

        event.preventDefault(); // kui see .preventDefault() välja kutsuda, siis ei käivitata browseri vaikimisi päringut
        const postParams = `message=${message}`;
        const Http = new XMLHttpRequest();
        const url='/replybot/logic/receive.php';

        Http.open('POST', url);
        Http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        Http.send(postParams);

        // Kuulame päringu erinevaid evente
        Http.onreadystatechange = (e) => {
            // Püüame kinni done(4) event'i kui status on 200 (OK)
            if (Http.readyState === 4 && Http.status === 200) {
                document.getElementById('sendButton').disabled = false; // Lubame nuppu uuesti vajutada
                const reply = (JSON.parse(Http.responseText)).reply;
                const container = document.getElementById('pastMessages');
                const messageContainer = document.createElement('div');
                messageContainer.style=`
                    flex-shrink: 0;
                    align-self: flex-start;
                    min-width: 100px;
                    max-width: 300px;
                    min-height: 20px;
                    line-height: 20px;
                    margin: 10px;
                    padding: 5px;
                    border-radius: 10px;
                    background-color: dodgerblue;
                    color: white;
                `;
                messageContainer.innerHTML = `<p>${reply}</p>`
                container.appendChild(messageContainer);
                scrollBottom(container);
            }
        }
    }

    /**
     *
     * @param {string} message
     */
    function addMyMessage(message) {
        const container = document.getElementById('pastMessages');
        const messageContainer = document.createElement('div');
        messageContainer.style=`
            flex-shrink: 0;
            align-self: flex-end;
            min-width: 100px;
            max-width: 300px;
            min-height: 20px;
            line-height: 20px;
            margin: 10px;
            padding: 5px;
            border-radius: 10px;
            background-color: lightblue;
            color: white;
        `;
        messageContainer.innerHTML = `<p>${message}</p>`
        container.appendChild(messageContainer);
        scrollBottom(container);
    }
};

/**
 *
 * @param {HtmlElement} container
 */
function scrollBottom(container) {
    container.scrollTop = container.scrollHeight;
}
