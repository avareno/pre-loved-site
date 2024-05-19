<?php

require_once '../../database/read_tables.php';
require_once '../../common/dashboard_footer.php';
require_once '../../templates/public_profile_page.php';
require_once '../../utils/getters.php';


$db = getDatabaseConnection();


if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    
    exit("User ID parameter is missing.");
}


$row = getUserByUserId($db, $user_id);



$averageRatingQuery = fetchData($db, 'SELECT AVG(rating) AS average_rating FROM reviews WHERE receiver_id = :receiver_id', [':receiver_id' => $row['id']]);
$averageRating = $averageRatingQuery ? $averageRatingQuery['average_rating'] : null;

$is_admin = $row['permissions'] === 'admin';
$is_seller = $row['permissions'] === 'seller';
$username = $row['username'];

$products = getProductsBySellerId($db, $row['id']);

drawUserProfile($username, $row, $products, $db, $averageRating);


?>