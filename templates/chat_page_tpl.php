<?php function drawChatMessage($db, $conversations){
?>
    <!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/container.css">
    <link rel="stylesheet" href="../../../css/settings.css">
    <link rel="stylesheet" href="../../../css/chat.css">
    <script src="../../js/chat/messages_handler.js"></script>
</head>

<body>
    <section class="row" style="border:solid red 1px;">
        <nav class="vertical-navbar column">
            <ul style="border: solid blue 1px;">
                <?php
                foreach ($conversations as $conversation) {
                    $conversation_id = htmlspecialchars($conversation['ID']);
                    $other_account_id = htmlspecialchars($conversation['ACCOUNT_ID_1'] == $id ? $conversation['ACCOUNT_ID_2'] : $conversation['ACCOUNT_ID_1']);
                    ?>
                    <li>
                        <a href="#" class="conversation-link" data-account-id="<?php echo $other_account_id; ?>"
                            data-conversation-id="<?php echo $conversation_id; ?>">
                            Account ID: <?php echo $other_account_id; ?><br>
                            Submit Date: <?php echo htmlspecialchars($conversation['submit_date']); ?><br>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

        <section id="chat" class="column" style="border: solid blue 1px;">
            <section id="conversation-details">
                <p id="account-id" style="display:none;"></p>
                <p id="submit-date" style="display:none;"></p>
                <div id="messages"></div>
                <form id="message-form">
                    <input type="text" id="message-input" name="message" placeholder="Type a message" required>
                    <input type="hidden" id="recipient-id" name="recipient-id">
                    <button type="submit">Send</button>
                </form>
            </section>
        </section>


    </section>
</body>

</html>


<?php
}
?>