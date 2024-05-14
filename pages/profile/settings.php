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

// Fetch user information including the profile image URL and role from the database
$row = getUserByUsername($db, $username);

// Check if the user has admin or seller role
$is_admin = $row['permissions'] === 'admin';
$is_seller = $row['permissions'] === 'seller';

// Fetch products associated with the logged-in user
$products = getProductsBySellerId($db, $row['id']);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['profile-image'])) {
        uploadImage($db, $username, $imageFile);
    } elseif (isPostParamSet("country")) {
        updateField($db, $username, 'country', $_POST["country"]);
    } elseif (isPostParamSet("city")) {
        // Handle city update
        updateField($db, $username, 'city', $_POST["city"]);
    } elseif (isPostParamSet("small_description")) {
        // Handle small description update
        updateField($db, $username, 'small_description', $_POST["small_description"]);
    } elseif (isPostParamSet("email")) {
        // Handle email update
        updateField($db, $username, 'email', $_POST["email"]);
    } elseif (isPostParamSet("phone_number")) {
        // Handle phone number update
        updateField($db, $username, 'phone_number', $_POST["phone_number"]);
    } elseif (isPostParamSet("become_seller")) {
        // Handle seller update
        updateField($db, $username, 'permissions', 'seller');
    } elseif (isPostParamSet("become_user")) {
        // Handle seller update
        if (!$products) {
            updateField($db, $username, 'permissions', 'user');
        } else {
            //pop-up mesage saying the user has items in it's page
            echo '<script>alert("The user has products in their page.");</script>';
        }
    }

}

draw_header($username, $is_admin, $is_seller, "settings");
draw_settings_page($username, $is_admin, $is_seller, $row);
draw_footer()
    ?>