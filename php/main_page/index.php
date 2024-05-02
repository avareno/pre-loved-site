<?php

require '../../database/read_tables.php';


//fetch latest items
$query = $db->prepare('SELECT p.id, p.title, i.carousel_img AS carousel_url
FROM products p
JOIN images i ON p.id = i.product_id
ORDER BY p.created_at DESC
LIMIT 5;
');
$query->execute();
$latests = $query->fetchAll();
$rows = $query->rowCount();
?>

<!doctype html>
<html lang="en">

<head>
    <title>LTW</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="navstyle.css">
    <link rel="stylesheet" href="carousel.css">
    <link rel="stylesheet" href="container.css">
    <link rel="stylesheet" href="filters.css">
    <!-- <script type="text/javascript" src="carousel.js"></script> -->
</head>

<body>
    <header style = "border:solid 1px blue;">
        <nav>
            <ul>
                
                <li><img src="https://upload.wikimedia.org/wikipedia/commons/1/1f/The_IMG_Media_broadcasting_company_logo.png"></li>
                <li><a class="active" href="#home">Home</a></li>
                <li><a href="filtered_page.php">News</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="right">
                    <form method="post" action="products.php"> 
                        <input type="submit" value="find" name="find" >
                        <input type="text" placeholder="Search..." name="key">
                    </form>
                </li>
                <?php
                    session_start(); // Start the session to check user login status

                    // Check if user is already logged in
                    if(isset($_SESSION['username'])) {
                        echo '<li class="right"><a href="profile.php">Profile</a></li>';
                    } else {
                        echo '<li class="right"><a href="register.php">Login/Register</a></li>';
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
        <section class="slide-wrapper">
            <section class="slider">
                <?php
                    foreach ($images as $image) {
                        $id = $image['product_id'];
                        $carousel_url = $image['carousel_img'];
                        echo "<img id=\"slide-$id\" src=\"$carousel_url\"/>";
                    }
                ?>
            </section>
            <section class="slider-nav">
                <?php
                foreach($products as $product) {
                    $id = $product["id"];
                    echo "<a href=\"#slide-$id\"></a>";
                }
                ?>
            </section>
        </section>
    <section class="grid-container">
        <h3> Latest additions</h3>
        <?php
        foreach ($latests as $latest) {
            $id = $latest['id'];
            $title = urlencode($latest['title']); // URL encode the title
            echo '<div class="grid-item">';
            echo '<h4><a href="product_profile.php?id=' . $id . '">' . $latest['title'] . '</a></h4>';
            $image_url = $latest['carousel_url'];
            echo '<a href="product_profile.php?id=' . $id . '"><img src="' . $image_url . '"></a>'; // Changed image to a link
            echo '</div>';
        }
        ?>
    </section>



</body>

</html>

