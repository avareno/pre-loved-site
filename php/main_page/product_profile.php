



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
        <section class="product-images">
            <img src="image1.jpg" alt="1 Image">
            <img src="image2.jpg" alt="2 Image">
            <img src="image3.jpg" alt="3 Image">
        </section>
        <img src ="main-image.jpg" alt ="Main Image">
        <h1>Product Name</h1>
        <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <p>Price: $100.00</p>
        <p>Condition: Used</p>
        <p>Category: Electronics</p>
        <p>Seller: John Doe</p>


        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_id" value="1">
            <input type="submit" value="Add to Cart">
        </form>
    </section>

</body>

</html>