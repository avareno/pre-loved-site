<?php
session_start();

require_once '../../database/read_tables.php';
require_once '../../common/dashboard_header.php';
require_once '../../templates/profile_page.php';
require_once '../../utils/getters.php';

$db = getDatabaseConnection();

if (!isset($_SESSION['username'])) {
    header("Location: ../main_page/index.php"); // Redirect to index.php
    exit(); // Stop further execution
}

$username = $_SESSION['username'];

// Fetch user information including the profile image URL and role from the database
$query = "SELECT * FROM users WHERE username = :username";
$stmt = $db->prepare($query);
$stmt->bindParam(":username", $username);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the user has admin or seller role
$is_admin = $row['permissions'] === 'admin';
$is_seller = $row['permissions'] === 'seller';

// Fetch products associated with the logged-in user
$product_query = "SELECT * FROM products WHERE seller_id = :seller_id";
$product_stmt = $db->prepare($product_query);
$product_stmt->bindParam(":seller_id", $row['id']);
$product_stmt->execute();
$products = $product_stmt->fetchAll(PDO::FETCH_ASSOC);


draw_header($username,$is_admin, $is_seller,"profile");
draw_profile_main($row, $username, $products);
?>

