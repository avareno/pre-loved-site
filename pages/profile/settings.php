<?php
session_start();

require_once '../../database/read_tables.php';
require_once '../../common/dashboard_header.php';
require_once '../../common/dashboard_footer.php';
require_once '../../templates/settings_page.php';
require_once '../../actions/upload_image.php';
require_once '../../actions/update_field.php';
require_once '../../utils/getters.php';



$db = getDatabaseConnection();

checkSessionAndRedirect("../../main_page/index.php");

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['profile-image'])) {

        uploadImage($db, $username, $imageFile);
    } elseif (isset($_POST["country"])) {
        updateField($db, $username, 'country', $_POST["country"]);
    } elseif (isset($_POST["city"])) {
        // Handle city update
        updateField($db, $username, 'city', $_POST["city"]);
    } elseif (isset($_POST["small_description"])) {
        // Handle small description update
        updateField($db, $username, 'small_description', $_POST["small_description"]);
    } elseif (isset($_POST["email"])) {
        // Handle email update
        updateField($db, $username, 'email', $_POST["email"]);
    } elseif (isset($_POST["phone_number"])) {
        // Handle phone number update
        updateField($db, $username, 'phone_number', $_POST["phone_number"]);
    }
}

// Fetch user information including the profile image URL and role from the database
$row = getUserByUsername($db, $username);


// Check if the user has admin or seller role
$is_admin = $row['permissions'] === 'admin';
$is_seller = $row['permissions'] === 'seller';

// Fetch products associated with the logged-in user
$products = getProductsBySellerId($db, $row['id']);

draw_header($username, $is_admin, $is_seller, "settings");
draw_settings_page($username, $is_admin, $is_seller, $row);
draw_footer()
?>