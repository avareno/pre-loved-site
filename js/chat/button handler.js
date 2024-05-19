function startChat(receiverId) {
    // Redirect to the new PHP page with the receiver_id as a query parameter
    window.location.href = '../../pages/chat/conversation.php?receiver_id=' + encodeURIComponent(receiverId);
}
