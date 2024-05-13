<?php


?>

<?php
session_start();

require '../../database/read_tables.php';
$db = getDatabaseConnection();

$username = $_SESSION['username'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile-image'])) {
    // Check if a file is uploaded
    if ($_FILES['profile-image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/';
        $uploadFile = $uploadDir . basename($_FILES['profile-image']['name']);

        // Move the uploaded file to the designated directory
        if (move_uploaded_file($_FILES['profile-image']['tmp_name'], $uploadFile)) {
            // File uploaded successfully, update the image path in the database
            $imagePath = $uploadFile;
            $query = "UPDATE users SET image = :image WHERE username = :username";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':image', $imagePath);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
        } else {
            echo "Failed to upload file.";
        }
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../css/settings.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/container.css">

</head>

<body>
    <header>
        <h1>Welcome to Your Dashboard, <?php echo $username; ?>!</h1>
        <nav>
            <ul>
                <li><a href="../main_page/index.php">Home</a></li>
                <?php if ($is_admin || $is_seller): ?>
                    <li><a href="../sell_items/sell_page.php">Sell</a></li>
                <?php endif; ?>
                <li><a href="#">Settings</a></li>
                <li><a href="../logout/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <section class="settings-container">

            <section class="column">


                <section class="row">
                    <h3>Profile settings</h3>
                </section>

                <section class="row">
                    <section class="column">
                    <h4>Foto:</h4>

                        <section class="change_foto_container">
                            <img id="profile-image" src="<?php echo $row['image']; ?>" alt="Profile Image">

                        </section>
                        <section class="change_foto_container">
                            <form method="post" enctype="multipart/form-data" style="display: inline;">
                                <input type="file" name="profile-image" id="profile-image-input" accept="image/*"
                                    style="display: none;" onchange="this.form.submit()">
                                <button class="submit-button" type="button"
                                    onclick="document.getElementById('profile-image-input').click();">Change
                                    Image</button>

                            </form>
                        </section>
                    </section>

                    <section class="column">
                        <h4>Small Description:</h4>
                        <textarea name="small_description" id="small_description" rows="10"
                            cols="50"><?php echo $row['small_description']; ?></textarea>
                    </section>
                    <section class="column">
                        <h4>Country:</h4>
                        <input type="text" name="country" id="country" value="<?php echo $row['country']; ?>">
                    </section>
                    <section class="column">
                        <h4>City:</h4>
                        <input type="text" name="city" id="city" value="<?php echo $row['city']; ?>">
                    </section>

                </section>


            </section>
        </section>
    </section>
</body>

</html>