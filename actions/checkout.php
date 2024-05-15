<?php
session_start();

require_once '../database/read_tables.php';
require_once 'delete_field.php'; 
require_once '../utils/getters.php';
require_once 'clear_user_cart.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $paypalSubmitted = !empty($_POST['paypal-email']) && !empty($_POST['paypal-password']);
    $cardSubmitted = !empty($_POST['card-number']) && !empty($_POST['card-expiry']) && !empty($_POST['card-cvv']);
    $mbwaySubmitted = !empty($_POST['mbway-phone']);

    if ($paypalSubmitted || $cardSubmitted || $mbwaySubmitted) {
        $db = getDatabaseConnection();
        $username = $_SESSION['username'];
        $products = getCartbyUser($db, $username);
        clearUserCart($db, $username, $products);
        header("Location: ../pages/cart/cart.php");
        exit;
    } else {
        echo "No payment method submitted!";
        exit;
    }
} else {
    echo "AHHHHH";
    
}

