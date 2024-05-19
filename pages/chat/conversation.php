<?php
session_start();

require_once '../../database/read_tables.php';
require_once '../../utils/getters.php';

checkSessionAndRedirect("../login/login.php");

$receiver_id = $_GET['receiver_id'];


$db = getDatabaseConnection();

$id = $_SESSION['id'];

$stmt = "SELECT * FROM CONVERSATIONs WHERE ACCOUNT_ID_1= :id or ACCOUNT_ID_2 = :id";
$conversations = fetchDataAll($db, $stmt, [':id' => $id]);



// Create a JavaScript variable to store the value of $row['id']
echo "<script>const userId = " . json_encode($receiver_id) . ";</script>";


?>





<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/container.css">
    <link rel="stylesheet" href="../../../css/settings.css">
    <script src="../../js/chat/messages_handler.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .row {
            display: flex;
            height: 100vh;
        }

        .vertical-navbar {
            flex: 0 0 250px;
            background-color: #f3f3f3;
            padding: 20px;
            overflow-y: auto;
        }

        .vertical-navbar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .vertical-navbar li {
            margin-bottom: 10px;
        }

        .conversation-link {
            display: block;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s;
        }

        .conversation-link:hover {
            background-color: #e9e9e9;
        }

        #chat {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        #conversation-details {
            flex: 1;
            padding: 20px;
        }

        #messages {
            overflow-y: auto;
            padding-bottom: 20px;
        }

        #message-form {
            margin-top: 20px;
            display: flex;
        }

        #message-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
        }

        #message-form button {
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 0 5px 5px 0;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #message-form button:hover {
            background-color: #0056b3;
        }
    </style>
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