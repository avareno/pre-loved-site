<?php
require '../../../database/read_tables.php';

$db = getDatabaseConnection();


// Handle search
if (isset($_POST['find'])) {
    $key = $_POST['key'];
    $query = $db->prepare('SELECT id, title, carousel_img FROM images where title Like :keyword order by title');
    $query->bindValue(':keyword', '%' . $key . '%', PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll();
}

// Handle filter
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    // Assuming $db is your PDO database connection
    $query = $db->prepare('SELECT p.id, p.title, i.carousel_img 
                           FROM products p 
                           JOIN images i ON p.id = i.product_id
                           WHERE p.category = :category');
    $query->bindValue(':category', $category, PDO::PARAM_STR);
    $query->execute();
    $products = $query->fetchAll();
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>LTW</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../../css/navstyle.css">
    <link rel="stylesheet" href="../../../css/carousel.css">
    <link rel="stylesheet" href="../../../css/container.css">
    <link rel="stylesheet" href="../../../css/filters.css">
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
                    session_start(); 
                    
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
        <?php
        if (!empty($results)) {
            foreach ($results as $result) {
                $id = $result['id'];
                echo '<section class="grid-item">';
                echo '<a href="product_profile.php?id=' . $id . '"><h4 style="border: 1px solid red">' . $result['title'] . '</h4></a>';
                $image_url = $result['carousel_img'];
                echo '<a href="product_profile.php?id=' . $id . '"><img src="' . $image_url . '"></a>';;
                echo '</section>';
            }
        } elseif (!empty($products)) {
            foreach ($products as $product) {
                $id = $product['id'];
                echo '<section class="grid-item">';
                echo '<a href="product_profile.php?id=' . $id . '"><h4>' . $product['title'] . '</h4></a>';
                $image_url = $product['carousel_img'];
                echo '<a href="product_profile.php?id=' . $id . '"><img src="' . $image_url . '"></a>';;
                echo '</section>';
            }
        } else {
            echo 'No result found';
        }
        ?>

        
    </section>
</body>
</html>
