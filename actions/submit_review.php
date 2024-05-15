<?php
session_start();

require_once '../database/read_tables.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are set
    if (isset($_POST['review']) && isset($_POST['rating']) && isset($_POST['receiver_id'])) {
        // Extract the review, rating, and receiver username from the POST data
        $review = $_POST['review'];
        $rating = $_POST['rating'];
        $receiver_id = $_POST['receiver_id'];

        // Check if the user is logged in
        if (isset($_SESSION['username'])) {
            // Sender username is the currently logged-in user
            $sender_id = $_SESSION['id'];

            // Add the review to the database
            addReviewToDatabase($sender_id, $receiver_id, $review, $rating);

            // Redirect back to the user profile page
            header("Location: ../pages/profile/public_profile.php?id=" . urlencode($receiver_id));
            exit;
        } else {
            // If the user is not logged in, redirect to the login page
            header("Location: ../pages/profile/public_profile.php?id=" . urlencode($receiver_id));
            exit;
        }
    } else {
        // If any required field is missing, redirect back to the form page
        header("Location: ../pages/profile/public_profile.php?id=" . urlencode($receiver_id));
        exit;
    }
} else {
    // If the request method is not POST, redirect back to the form page
    header("Location: ../pages/profile/public_profile.php?id=" . urlencode($receiver_id));
    exit;
}

// Function to add the review to the database
function addReviewToDatabase($sender_id, $receiver_id, $review, $rating)
{
    // Create a PDO connection to your database
    $db = getDatabaseConnection();

    // Prepare the SQL statement to insert the review into the database
    $query = "INSERT INTO reviews (sender_id, receiver_id, review, rating) VALUES (:sender_id, :receiver_id, :review, :rating)";
    $statement = $db->prepare($query);

    // Bind the parameters
    $statement->bindParam(':sender_id', $sender_id);
    $statement->bindParam(':receiver_id', $receiver_id);
    $statement->bindParam(':review', $review);
    $statement->bindParam(':rating', $rating);

    // Execute the statement
    $statement->execute();
}
?>
