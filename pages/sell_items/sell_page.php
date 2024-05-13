<?php
session_start();

require '../../database/read_tables.php';
$db = getDatabaseConnection();

$username = $_SESSION['username'];

// Fetch user information including the profile image URL and role from the database
$query = "SELECT id FROM users WHERE username = :username";
$stmt = $db->prepare($query);
$stmt->bindParam(":username", $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user exists
if ($user) {
    $seller_id = $user['id']; // Get the user ID
} else {
    // Handle error if user does not exist
    echo "Error: User not found.";
    exit;
}

// Default image URL
$default_image_url = 'https://www.apple.com/newsroom/images/product/iphone/standard/iphonex_front_back_new_glass_full.jpg.og.jpg';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $condition = $_POST['condition'];
    $category = $_POST['category'];
    
    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Specify the directory where uploaded images will be saved
        $uploadDir = '../../assets/';
        // Generate a unique filename to avoid conflicts
        $filename = uniqid() . '_' . $_FILES['image']['name'];
        // Define the full path to the uploaded file
        $uploadPath = $uploadDir . $filename;
        
        // Move the uploaded file to the designated directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            // Image uploaded successfully, now you can save the image path to the database
            
            // Insert product into database
            $query = "INSERT INTO products (title, description, price, condition, category, seller_id) VALUES (:title, :description, :price, :condition, :category, :seller_id)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":condition", $condition);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":seller_id", $seller_id);
            
            // Execute the query
            if ($stmt->execute()) {
                // Get the ID of the newly inserted product
                $product_id = $db->lastInsertId();
                
                // Insert the uploaded image path into the images table
                $image_url = '../../assets/' . $filename;
                $query = "INSERT INTO images (title, img_url, carousel_img, product_id) VALUES (:title, :img_url, :carousel_img, :product_id)";
                $stmt = $db->prepare($query);
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":img_url", $image_url);
                $stmt->bindParam(":carousel_img", $image_url);
                $stmt->bindParam(":product_id", $product_id);
                
                // Execute the query
                if ($stmt->execute()) {
                    echo "Product added successfully.";
                } else {
                    echo "Error adding product.";
                }
            } else {
                echo "Error adding product.";
            }
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "No image uploaded or upload error occurred.";
    }
}
?>




<!doctype html>
<html lang="en">

<head>
    <title>LTW</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../../css/navstyle.css">
    <link rel="stylesheet" href="../../../css/carousel.css">
    <link rel="stylesheet" href="../../../css/container.css">
    <link rel="stylesheet" href="../../../css/filters.css">
    <link rel="stylesheet" href="../../../css/shopping_cart.css">
    <link rel="stylesheet" href="../../../css/form.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><img src="https://upload.wikimedia.org/wikipedia/commons/1/1f/The_IMG_Media_broadcasting_company_logo.png"></li>
                <li><a  href="../main_page/index.php">Home</a></li>
                <li><a href="filtered_page.php">News</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="right" >
                    <form method="post" action="../products_page/products.php"> 
                        <input type="submit" value="find" name="find">
                        <input type="text" placeholder="Search..." name="key">
                    </form>
                </li>
                <li class="right">
                <a href="../cart/cart.php">Cart</a>
                </li>
                <?php
                    // Check if user is already logged in
                    if(isset($_SESSION['username'])) {
                        echo '<li class="right"><a href="../profile/profile.php">Profile</a></li>';
                    } else {
                        echo '<li class="right"><a href="../login/register.php">Login/Register</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>

    <nav id="filters-bar">
        <ul>
            <li><a href="../products_page/products.php?category=Clothing">Clothing</a></li>
            <li><a href="../products_page/products.php?category=Electronics">Electronics</a></li>
            <li><a href="../products_page/products.php?category=Sports">Sports</a></li>
            <li><a href="../products_page/products.php?category=Home%20&%20Garden">House and Garden</a></li>
            <li><a href="../products_page/products.php?category=Offers">Offers</a></li>
            <li><a href="../products_page/products.php?category=More">More</a></li>
        </ul>       
    </nav>
    <main>
        <section>
            <h2>Submit an item for selling</h2>
            <form method="post" action="sell_page.php" enctype="multipart/form-data">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required><br>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" required></textarea><br>
                <label for="price">Price:</label><br>
                <input type="number" id="price" name="price" step="10" required><br>
                <label for="condition">Condition:</label><br>
                <input type="text" id="condition" name="condition"><br>
                <label for="category">Category:</label><br>
                <input type="text" id="category" name="category" required><br><br>
                <label for="image">Image:</label><br>
                <input type="file" id="image" name="image" accept="image/*" required><br><br>
                <input type="submit" value="Submit">
            </form>
        </section>
    </main>
</body>

</html>
