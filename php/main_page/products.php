<?php
require '../../database/readdbproducts.php';

// Handle search
if (isset($_POST['find'])) {
    $key = $_POST['key'];
    $query = $db->prepare('SELECT title, img_url FROM products where title Like :keyword order by title');
    $query->bindValue(':keyword', '%' . $key . '%', PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll();
}

// Handle filter
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $query = $db->prepare('SELECT title, img_url FROM products WHERE category = :category');
    $query->bindValue(':category', $category, PDO::PARAM_STR);
    $query->execute();
    $products = $query->fetchAll();
}

// Fetch latest items
$query = $db->prepare('SELECT * FROM products ORDER BY created_at DESC LIMIT 5');
$query->execute();
$latests = $query->fetchAll();
?>

<!doctype html>
<html lang="en">
<head>
    <title>LTW</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="navstyle.css">
    <link rel="stylesheet" href="carousel.css">
    <link rel="stylesheet" href="container.css">
    <link rel="stylesheet" href="filters.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><img src="https://upload.wikimedia.org/wikipedia/commons/1/1f/The_IMG_Media_broadcasting_company_logo.png"></li>
                <li><a class="active" href="#home">Home</a></li>
                <li><a href="filtered_page.php">News</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="right" >
                    <form method="post" action="products.php">
                        <input type="submit" value="find" name="find">
                        <input type="text" placeholder="Search..." name="key">
                    </form>
                </li>
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
                echo '<div class="grid-item">';
                echo '<h4 style="border: 1px solid red">' . $result['title'] . '</h4>';
                $image_url = $result['img_url'];
                echo '<img src="' . $image_url . '">';
                echo '</div>';
            }
        } elseif (!empty($products)) {
            foreach ($products as $product) {
                echo '<div class="grid-item">';
                echo '<h4>' . $product['title'] . '</h4>';
                $image_url = $product['img_url'];
                echo '<img src="' . $image_url . '">';
                echo '</div>';
            }
        } else {
            echo 'No result found';
        }
        ?>

        
    </section>
</body>
</html>
