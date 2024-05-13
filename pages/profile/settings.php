<?php
session_start();

require_once '../../database/read_tables.php';
require_once '../../common/dashboard_header.php';
require_once '../../templates/settings_page.php';
require_once '../../actions/upload_image.php';
require_once '../../actions/update_field.php';


$db = getDatabaseConnection();

if (!isset($_SESSION['username'])) {
    header("Location: ../../main_page/index.php"); // Redirect to index.php
    exit(); // Stop further execution
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['profile-image'])) {

        uploadImage($db, $username, $imageFile);
    } elseif (isset($_POST["country"])) {
              // Handle country update
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

?>

<?php
    draw_header($username, $is_admin, $is_seller, "settings");
    draw_settings_page($username, $is_admin, $is_seller, $row);
?>
