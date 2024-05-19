<?php
require '../../database/read_tables.php';
require '../../common/index_header.php';
require '../../templates/user_search_page.php';

$db = getDatabaseConnection();

if (isGetParamSet('key')) {
    $key = '%' .htmlspecialchars($_GET['key']. '%');
    $query = "SELECT * FROM users WHERE username LIKE :key";
    $users = fetchDataAll($db, $query, [':key' => $key]);
}


drawHeader();
drawGridSection($users);

?>