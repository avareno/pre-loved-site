<?php

require_once '../../database/read_tables.php';
require_once '../../common/dashboard_footer.php';
require_once '../../templates/public_profile_page.php';
require_once '../../utils/getters.php';


$db = getDatabaseConnection();

// Get the user ID from URL parameters
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    // Redirect or show an error message if the user ID parameter is not provided
    exit("User ID parameter is missing.");
}

$row = getUserByUserId($db, $user_id);

// Check if the user has admin or seller role
$is_admin = $row['permissions'] === 'admin';
$is_seller = $row['permissions'] === 'seller';
$username = $row['username'];

$products = getProductsBySellerId($db, $row['id']);

drawUserProfile($username, $row, $products, $db);

?>