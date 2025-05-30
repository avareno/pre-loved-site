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


$row = getUserByUsername($db, $username);


$is_admin = $row['permissions'] === 'admin';
$is_seller = $row['permissions'] === 'seller';


$products = getProductsBySellerId($db, $row['id']);



draw_header($username, $is_admin, $is_seller, "settings");
draw_settings_page($username, $is_admin, $is_seller, $row);
draw_footer();
?>