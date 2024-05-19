<?php
session_start();

require_once '../../database/read_tables.php';
require_once '../../utils/getters.php';
require_once '../../templates/chat_page_tpl.php';

checkSessionAndRedirect("../login/login.php");

$receiver_id = $_GET['receiver_id'];


$db = getDatabaseConnection();

$id = $_SESSION['id'];

$stmt = "SELECT * FROM CONVERSATIONs WHERE ACCOUNT_ID_1= :id or ACCOUNT_ID_2 = :id";
$conversations = fetchDataAll($db, $stmt, [':id' => $id]);



echo "<script>const userId = " . json_encode($receiver_id) . ";</script>";

drawChatMessage($db, $conversations);

?>
