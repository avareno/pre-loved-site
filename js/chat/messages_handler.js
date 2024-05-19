document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.conversation-link');
    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const accountId = this.getAttribute('data-account-id');
            const conversationId = this.getAttribute('data-conversation-id');
            setCurrentID(accountId, conversationId);
        });
    });

    const messageForm = document.getElementById('message-form');
    messageForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const messageInput = document.getElementById('message-input');
        const message = messageInput.value;
        const recipientId = document.getElementById('account-id').textContent;
        const conversationId = document.getElementById('submit-date').textContent;

        sendMessage(conversationId, message, recipientId);
        messageInput.value = '';
    });
});

function fetchMessages(conversationId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../actions/fetch_messages.php?conversation_id=" + encodeURIComponent(conversationId), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("messages").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function sendMessage(conversationId, message, recipientId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../actions/send_messages.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                // If a new conversation was created, update the conversation ID
                if (response.conversation_id) {
                    setCurrentID(recipientId, response.conversation_id);
                }
                fetchMessages(response.conversation_id || conversationId);
            } else {
                alert('Error: ' + response.message);
            }
        }
    };
    xhr.send("conversation_id=" + encodeURIComponent(conversationId) + "&message=" + encodeURIComponent(message) + "&recipient_id=" + encodeURIComponent(recipientId));
}

function setCurrentID(accountId, conversationId) {
    document.getElementById("account-id").textContent = '';
    document.getElementById("submit-date").textContent = '';
    fetchMessages(conversationId);
}

setInterval(function() {
    const conversationId = document.getElementById("submit-date").textContent;
    if (conversationId) {
        fetchMessages(conversationId);
    }
}, 500);
