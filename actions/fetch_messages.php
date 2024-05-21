<?php
session_start();
require_once '../database/read_tables.php';
require_once '../utils/getters.php';

if (isset($_GET['conversation_id'])) {
    $conversation_id = $_GET['conversation_id'];

    $db = getDatabaseConnection();
    $stmt = "SELECT MESSAGES.*, USERS.username FROM MESSAGES
             JOIN USERS ON MESSAGES.ACCOUNT_ID = USERS.ID
             WHERE CONVERSATION_ID = :conversation_id
             ORDER BY SUBMIT_DATE ASC";
    $messages = fetchDataAll($db, $stmt, [':conversation_id' => $conversation_id]);

    foreach ($messages as $message) {
        echo '<section><strong>' . htmlspecialchars($message['username']) . ':</strong> ' .
             htmlspecialchars($message['MSG']) . ' <em>(' .
             htmlspecialchars($message['SUBMIT_DATE']) . ')</em></section>';
    }
}
?>
