<?php
require_once '../../utils/getters.php';
function drawHeader() {
    drawHtmlStart();
    drawHeaderContent();
    drawNavigationMenu();
    drawFilters();
}

function drawHtmlStart() {
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
        <link rel="stylesheet" href="../../../css/form.css">
    </head>
    <body>
    <header>
        <nav id="navbar">
            <ul>
    <?php
}

function drawHeaderContent() {
    ?>
    <li><img src="https://upload.wikimedia.org/wikipedia/commons/1/1f/The_IMG_Media_broadcasting_company_logo.png"></li>
    <li><a class="active" href="../main_page/index.php">Home</a></li>
    <li><a href="filtered_page.php">News</a></li>
    <li><a href="#contact">Contact</a></li>
    <li class="right">
         <form method="post" action="../products_page/products.php">
            <form method="post" action="../products_page/products.php">
                <section class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                            </path>
                        </g>
                    </svg>
                    <input placeholder="Search" type="search" class="input" name="key">
                </section>
                <input type="submit" value="find" name="find">
            </form>

    </li>
    <li class="right">
        <a href="../cart/cart.php">Cart</a>
    </li>
    <?php
}

function drawNavigationMenu() {
    session_start(); // Start the session to check user login status
    if(isUserLoggedIn()) {
        echo '<li class="right"><a href="../profile/profile.php">Profile</a></li>';
    } else {
        echo '<li class="right"><a href="../login/register.php">Login/Register</a></li>';
    }
    ?>
    </ul>
    </nav>
    </header>
    <?php
}

function drawFilters(){?>
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
<?php
}

?>
