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
    if (messageForm) {
        messageForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value;
            const recipientId = document.getElementById('recipient-id').value;
            const conversationId = document.getElementById('submit-date').textContent;

            sendMessage(conversationId, message, recipientId);
            messageInput.value = '';
        });
    }
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
                if (response.conversation_id) {
                    setCurrentID(recipientId, response.conversation_id);
                } else {
                    fetchMessages(conversationId);
                }
                updateConversationList(response.conversation_id || conversationId, recipientId);
            } else {
                alert('Error: ' + response.message);
            }
        }
    };
    xhr.send("conversation_id=" + encodeURIComponent(conversationId) + "&message=" + encodeURIComponent(message) + "&recipient_id=" + encodeURIComponent(recipientId));
}

function setCurrentID(accountId, conversationId) {
    const accountIdElem = document.getElementById("account-id");
    const submitDateElem = document.getElementById("submit-date");
    const recipientIdElem = document.getElementById("recipient-id");

    if (accountIdElem) {
        accountIdElem.textContent = accountId;
    }
    
    if (submitDateElem) {
        submitDateElem.textContent = conversationId;
    }
    
    if (recipientIdElem) {
        recipientIdElem.value = accountId;
    }

    fetchMessages(conversationId);
}

function updateConversationList(conversationId, accountId) {
    const conversationList = document.getElementById('conversation-list');
    if (conversationList) {
        let conversationLink = document.querySelector(`.conversation-link[data-conversation-id="${conversationId}"]`);
        if (!conversationLink) {
            const newConversationItem = document.createElement('li');
            newConversationItem.innerHTML = `
                <a href="#" class="conversation-link"
                   data-account-id="${accountId}"
                   data-conversation-id="${conversationId}">
                    Account ID: ${accountId}<br>
                    Submit Date: ${new Date().toISOString()}<br>
                </a>
            `;
            newConversationItem.querySelector('.conversation-link').addEventListener('click', function(event) {
                event.preventDefault();
                setCurrentID(accountId, conversationId);
            });
            conversationList.appendChild(newConversationItem);
        }
    }
}

setInterval(function() {
    const conversationIdElem = document.getElementById("submit-date");
    if (conversationIdElem) {
        const conversationId = conversationIdElem.textContent;
        if (conversationId) {
            fetchMessages(conversationId);
        }
    }
}, 500);
