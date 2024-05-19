<?php
session_start();
require_once '../database/read_tables.php';

function getOrCreateConversation($db, $account_id_1, $account_id_2,$default_id ) {
    try {
        // Check if a conversation already exists between the two users
        $stmt = $db->prepare("SELECT ID FROM CONVERSATIONS WHERE (ACCOUNT_ID_1 = :account_id_1 AND ACCOUNT_ID_2 = :account_id_2) OR (ACCOUNT_ID_1 = :account_id_2 AND ACCOUNT_ID_2 = :account_id_1)");
        $stmt->execute([
            ':account_id_1' => $account_id_1,
            ':account_id_2' => $account_id_2
        ]);
        $conversation = $stmt->fetch(PDO::FETCH_ASSOC);

        // If a conversation exists, return its ID
        if ($conversation) {
            return $conversation['ID'];
        }

        // Check if a conversation already exists between the two users
        $stmt = $db->prepare("SELECT ID FROM CONVERSATIONS WHERE (ACCOUNT_ID_1 = :account_id_1 AND ACCOUNT_ID_2 = :default_id) OR (ACCOUNT_ID_1 = :default_id AND ACCOUNT_ID_2 = :account_id_1)");
        $stmt->execute([
            ':account_id_1' => $account_id_1,
            ':default_id' => $default_id
        ]);
        $conversation = $stmt->fetch(PDO::FETCH_ASSOC);

        // If a conversation exists, return its ID
        if ($conversation) {
            return $conversation['ID'];
        }

        // If no conversation exists, create a new one
        $stmt = $db->prepare("INSERT INTO CONVERSATIONS (ACCOUNT_ID_1, ACCOUNT_ID_2, submit_date) VALUES (:account_id_1, :default_id, :submit_date)");
        $stmt->execute([
            ':account_id_1' => $account_id_1,
            ':default_id' => $default_id,
            ':submit_date' => date('Y-m-d H:i:s')
        ]);

        // Return the new conversation ID
        return $db->lastInsertId();
    } catch (PDOException $e) {
        error_log("Error in getOrCreateConversation: " . $e->getMessage());
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['recipient_id']) && isset($_POST['message'])) {
        $recipient_id = $_POST['recipient_id'];
        $message = $_POST['message'];
        $account_id = $_SESSION['id'];
        $default_id = $_POST['default_id'];
        $submit_date = date('Y-m-d H:i:s');

        try {
            $db = getDatabaseConnection();

            if (!$db) {
                error_log("Failed to connect to database.");
                echo json_encode(['status' => 'error', 'message' => 'Failed to connect to database']);
                exit;
            }

            // Get or create the conversation ID
            $conversation_id = getOrCreateConversation($db, $account_id, $recipient_id,$default_id );

            if ($conversation_id) {
                // Insert the message into the MESSAGES table
                $stmt = $db->prepare("INSERT INTO MESSAGES (CONVERSATION_ID, ACCOUNT_ID, MSG, SUBMIT_DATE) VALUES (:conversation_id, :account_id, :message, :submit_date)");
                $params = [
                    ':conversation_id' => $conversation_id,
                    ':account_id' => $account_id,
                    ':message' => $message,
                    ':submit_date' => $submit_date
                ];
                if ($stmt->execute($params)) {
                    echo json_encode(['status' => 'success', 'conversation_id' => $conversation_id]);
                } else {
                    error_log("Failed to insert message.");
                    echo json_encode(['status' => 'error', 'message' => 'Failed to insert message']);
                }
            } else {
                error_log("Failed to create or find conversation.");
                echo json_encode(['status' => 'error', 'message' => 'Failed to create or find conversation']);
            }
        } catch (PDOException $e) {
            error_log("Error in send_message.php: " . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        error_log("Invalid request parameters.");
        echo json_encode(['status' => 'error', 'message' => 'Invalid request parameters']);
    }
} else {
    error_log("Invalid request method.");
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
