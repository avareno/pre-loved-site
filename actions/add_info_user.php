<?php

require_once '../database/read_tables.php';
require_once '../actions/update_field.php';
require_once '../utils/getters.php';

session_start();

checkSessionAndRedirect("../../main_page/index.php");


$db = getDatabaseConnection();
$username = $_SESSION['username'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['profile-image'])) {
        uploadImage($db, $username, $imageFile);
        header("Location: ../pages/profile/settings.php");
        exit;
    } elseif (isPostParamSet("country")) {
        updateFieldUsers($db, $username, 'country', $_POST["country"]);
        header("Location: ../pages/profile/settings.php");
        exit;
    } elseif (isPostParamSet("city")) {
        // Handle city update
        updateFieldUsers($db, $username, 'city', $_POST["city"]);
        header("Location: ../pages/profile/settings.php");
        exit;
    } elseif (isPostParamSet("small_description")) {
        // Handle small description update
        updateFieldUsers($db, $username, 'small_description', $_POST["small_description"]);
        header("Location: ../pages/profile/settings.php");
        exit;
    } elseif (isPostParamSet("email")) {
        // Handle email update
        updateFieldUsers($db, $username, 'email', $_POST["email"]);
        header("Location: ../pages/profile/settings.php");
        exit;
    } elseif (isPostParamSet("phone_number")) {
        // Handle phone number update
        updateFieldUsers($db, $username, 'phone_number', $_POST["phone_number"]);
        header("Location: ../pages/profile/settings.php");
        exit;
    }

}

?>