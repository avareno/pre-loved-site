<?php
session_start();

require '../../../database/read_tables.php';
$db = getDatabaseConnection();

if (!isset($_SESSION['username'])) {
    header("Location: ../main_page/index.php"); // Redirect to index.php
    exit(); // Stop further execution
}

$username = $_SESSION['username'];


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
    <link rel="stylesheet" href="../../../css/dashboard.css"> <!-- Replace with your CSS file -->
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
                <li><a href="settings.php">Settings</a></li>
                <li><a href="../../actions/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <section class="profile-image-container">
                <img id="profile-image" src="<?php echo $row['image']; ?>" alt="Profile Image">
            </section>


            <section>
                <p>Username: <?php echo $username; ?></p>
                <p>Email: <?php echo $row['email']; ?></p>
            </section>
        </section>
        <section>
            <h2>Products on Sale</h2>
            <div class="products-container">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo $product['image']; ?>" alt="Product Image">
                        <h3><?php echo $product['title']; ?></h3>
                        <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
                        <p><strong>Price:</strong> $<?php echo $product['price']; ?></p>
                        <p><strong>Condition:</strong> <?php echo $product['condition']; ?></p>
                        <p><strong>Category:</strong> <?php echo $product['category']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    
    <footer>
        <p>© <?php echo date("Y"); ?> Your Company Name. All rights reserved.</p>
    </footer>

</body>

</html>