<?php
session_start();

require_once '../../database/read_tables.php';
require_once '../../common/dashboard_header.php';
require_once '../../templates/profile_page.php';
require_once '../../utils/getters.php';

$db = getDatabaseConnection();
checkSessionAndRedirect("../main_page/index.php");

$username = $_SESSION['username'];

$row = getUserByUsername($db, $username);

// Check if the user has admin or seller role
$is_admin = $row['permissions'] === 'admin';
$is_seller = $row['permissions'] === 'seller';

$products = getProductsBySellerId($db, $row['id']);

draw_header($username,$is_admin, $is_seller,"profile");
draw_profile_main($row, $username, $products);
//draw footer
?>

