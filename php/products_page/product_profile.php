<?php
require '../../database/read_tables.php';
$db = getDatabaseConnection();
$product_id = $_GET['id']; // Assuming you get the product ID from the URL

// Fetch product details
$query = $db->prepare('SELECT * FROM products WHERE id = :product_id');
$query->bindValue(':product_id', $product_id, PDO::PARAM_INT);
$query->execute();
$product = $query->fetch(PDO::FETCH_ASSOC);

// Fetch product image URL
$imageQuery = $db->prepare('SELECT carousel_img FROM images WHERE product_id = :product_id LIMIT 1');
$imageQuery->bindValue(':product_id', $product_id, PDO::PARAM_INT);
$imageQuery->execute();
$productImage = $imageQuery->fetch(PDO::FETCH_ASSOC);

// If the product is not found or image URL is not available, handle the error
if (!$product || !$productImage) {
    echo "<p>Error: Product not found or image not available.</p>";
    // You can redirect the user to an error page or display a message
    exit; // Stop further execution
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>LTW</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/navstyle.css">
    <link rel="stylesheet" href="../../css/container.css">
    <link rel="stylesheet" href="../../css/product_profile.css">
    <link rel="stylesheet" href="../../css/filters.css">
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
                    <form method="post" action="products.php"> 
                        <input type="submit" value="find" name="find">
                        <input type="text" placeholder="Search..." name="key">
                    </form>
                </li>
                <li class="right">
                <a href="../cart/cart.php">Cart</a>
                </li>
                <?php
                    session_start(); // Start the session to check user login status

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
            <li><a href="products.php?category=Clothing">Clothing</a></li>
            <li><a href="products.php?category=Electronics">Electronics</a></li>
            <li><a href="products.php?category=Sports">Sports</a></li>
            <li><a href="products.php?category=Home%20&%20Garden">House and Garden</a></li>
            <li><a href="products.php?category=Offers">Offers</a></li>
            <li><a href="products.php?category=More">More</a></li>
        </ul>       
    </nav>

    <section class="grid-container">
        <section class="product-images">
            <!-- Display product image -->
            <img src="<?php echo $productImage['carousel_img']; ?>" alt="Product Image">
        </section>
        <h1><?php echo $product['title']; ?></h1>
        <p>Description: <?php echo $product['description']; ?></p>
        <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
        <p>Condition: <?php echo $product['condition']; ?></p>
        <p>Category: <?php echo $product['category']; ?></p>
        <p>Seller: <?php echo $product['seller_id']; ?></p>

        <!-- Verifica se a quantidade do produto é maior que zero -->
        <?php if ($product['quantity'] > 0): ?>
            <!-- Se a quantidade for maior que zero, exibe o botão de adicionar ao carrinho -->
            <form action="../cart/add_to_cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="submit" value="Add to Cart">
            </form>
        <?php else: ?>
            <!-- Se a quantidade for zero, desativa o botão de adicionar ao carrinho e exibe a mensagem -->
            <button disabled>Add to Cart</button>
            <p>Produto Indisponivel</p>
        <?php endif; ?>
    </section>

</body>

</html>

