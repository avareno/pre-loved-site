<?php 
session_start();

require_once '../../database/read_tables.php';
require_once '../../utils/getters.php';
require_once '../../common/index_header.php';
require_once '../../common/sell_form.php';
require_once '../../utils/getters.php';
require_once '../../actions/upload_product.php';

$db = getDatabaseConnection();
checkSessionAndRedirect("../main_page/index.php");

$username = $_SESSION['username'];

$row = getUserByUsername($db, $username);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $condition = $_POST['condition'];
    $category = $_POST['category'];

    uploadProduct($db, $username, $_FILES['image'], $title, $description, $price, $condition, $category, $row['id']);
    
}
?>

<?php
drawHeader();
draw_sell_form();
?>
