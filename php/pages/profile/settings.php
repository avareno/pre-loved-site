<?php


?>

<?php
session_start();

require '../../../database/read_tables.php';
$db = getDatabaseConnection();

if (!isset($_SESSION['username'])) {
    header("Location: ../../main_page/index.php"); // Redirect to index.php
    exit(); // Stop further execution
}

$username = $_SESSION['username'];



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['profile-image'])) {
        // Check if a file is uploaded
        if ($_FILES['profile-image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../../../assets/';
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
    } else if (isset($_POST["country"])) {
        $country = $_POST['country'];

        $query = "UPDATE users SET country = :country WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    } else if (isset($_POST["city"])) {
        $city = $_POST['city'];

        $query = "UPDATE users SET city = :city WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    } else if (isset($_POST["small_description"])) {
        $small_description = $_POST['small_description'];

        $query = "UPDATE users SET small_description = :small_description WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':small_description', $small_description);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    } else if (isset($_POST["email"])) {
        $email = $_POST['email'];

        $query = "UPDATE users SET email = :email WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    } else if (isset($_POST["phone_number"])) {
        $phone_number = $_POST['phone_number'];

        $query = "UPDATE users SET phone_number = :phone_number WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
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
    <link rel="stylesheet" href="../../../css/settings.css">
    <link rel="stylesheet" href="../../../css/dashboard.css">
    <link rel="stylesheet" href="../../../css/container.css">
    <script src="../../../js/change_link.js" defer></script>

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
                <li><a href="profile.php">Profile</a></li>
                <li><a href="../../actions/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <section class="settings-container">

            <section class="vertical-navbar">
                <ul>
                    <li><a href="#" onclick="showSection('profile-settings')">Profile Settings</a></li>
                    <li><a href="#" onclick="showSection('account-settings')">Account Settings</a></li>
                    <li><a href="#" onclick="showSection('payment-methods')">Payment Methods</a></li>
                </ul>
            </section>

            <section class="content-section">
                <section id="profile-settings" class="section active">
                    <!-- Profile Settings Section -->
                    <h2>Profile Settings</h2>

                    <section class="row">
                        <section class="column">
                            <h4>Foto:</h4>

                            <section>
                                <img id="profile-image" src="<?php echo $row['image']; ?>" alt="Profile Image">

                            </section>
                            <section>
                                <form method="post" enctype="multipart/form-data">
                                    <input type="file" name="profile-image" id="profile-image-input" accept="image/*"
                                        style="display: none;" onchange="this.form.submit()">
                                    <button class="submit-button" type="button"
                                        onclick="document.getElementById('profile-image-input').click();">Change Image
                                    </button>

                                </form>
                            </section>
                        </section>

                        <section class="column">
                            <h4>Small Description:</h4>
                            <form method="post">
                                <textarea name="small_description" id="small_description" rows="10" cols="30"
                                    maxlength="255"><?php echo $row['small_description']; ?>
                                </textarea>
                                <button class="submit-button" type="submit">
                                    Change Description
                                </button>
                            </form>
                        </section>
                        <section class="column">
                            <h4>Country:</h4>
                            <section>


                                <form method="post">
                                    <input type="text" name="country" id="country"
                                        value="<?php echo $row['Country']; ?>">
                                    <button class="submit-button" type="submit">Change Country
                                    </button>
                                </form>

                            </section>
                        </section>
                        <section class="column">
                            <h4>City:</h4>
                            <form method="post">
                                <input type="text" name="city" id="city" value="<?php echo $row['city']; ?>">
                                <button class="submit-button" type="submit">Change City</button>
                            </form>
                        </section>

                    </section>



                </section>

                <section id="account-settings" class="section">

                    <h2>Account Settings</h2>

                    <section class="row">

                        <section class="column">
                            <h4>Email:</h4>
                            <section>
                                <form method="post">
                                    <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>">
                                    <button class="submit-button" type="submit">Change Email
                                    </button>
                                </form>

                            </section>
                        </section>
                        <section class="column">
                            <h4>Phone Number:</h4>
                            <form method="post">
                                <input type="text" name="phone_number" id="phone_number"
                                    value="<?php echo $row['phone_number']; ?>">
                                <button class="submit-button" type="submit">Change Phone Number</button>
                            </form>
                        </section>

                    </section>

                </section>

                <section id="payment-methods" class="section">

                    <h2>Payment Methods</h2>

                </section>
            </section>



        </section>
    </section>
    <!-- <script src="../../../js/add_image.js"> </script> -->

</body>

</html>