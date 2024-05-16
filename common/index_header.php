<?php
require_once '../../utils/getters.php';
function drawHeader()
{
    drawHtmlStart();
    drawHeaderNavigation();
    drawFilters();

}

function drawHtmlStart()
{
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
        <link rel="stylesheet" href="../../../css/shopping_cart.css">
        <script src="../../js/sidebar.js"></script>
        <script src="../../js/payment_methods.js"></script>
    </head>

    <?php
}


function drawHeaderNavigation()
{
    ?>
    <header>
        <?php drawNavbar(); ?>
    </header>
    <?php
}

function drawNavbar()
{
    ?>
    <nav id="navbar">
        <ul class="sidebar">
            <?php drawSidebarItems(); ?>
        </ul>
        <ul>
            <?php drawLogoAndMenuItems(); ?>
        </ul>
    </nav>
    <?php
}

function drawSidebarItems()
{
    ?>
    <li><a href="../main_page/index.php">Home</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="../cart/cart.php">Cart</a></li>
    <?php
    session_start();


    if (isset($_SESSION['username'])) {
        echo '<li><a href="../profile/profile.php">Profile</a></li>';
    } else {
        echo '<li><a href="../login/register.php">Login/Register</a></li>';
    } ?>
    <li>
        <select id="cars" class="styled-select">
            <option value="volvo">Volvo</option>
            <option value="saab">Saab</option>
            <option value="opel">Opel</option>
            <option value="audi">Audi</option>
        </select>
    </li>
    <?php drawSearch(); ?>
    <li onclick="hideSideBar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                width="24px" fill="black">
                <path
                    d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
            </svg></a></li>

    <?php 
}

function drawSearch()
{
    ?>
    <form method="post" action="../products_page/products.php">
        <input type="submit" value="find" name="find">
        <section class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path
                        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                    </path>
                </g>
            </svg>
            <input placeholder="Search" type="text" class="input" name="key">
        </section>
    </form>

    <?php
}

function drawLogoAndMenuItems()
{
    ?>
    <li><img src="https://upload.wikimedia.org/wikipedia/commons/1/1f/The_IMG_Media_broadcasting_company_logo.png"></li>
    <li class="hideOnMobile"><a class="active" href="../main_page/index.php">Home</a></li>
    <li class="hideOnMobile"><a href="#news">News</a></li>
    <li class="hideOnMobile"><a href="#contact">Contact</a></li>
    <li class="right hideOnMobile">
        <?php drawSearch() ?>

    </li>
    <li class="right hideOnMobile">
        <select id="search_type" class="styled-select">
            <option value="products">Products</option>
            <option value="users">Users</option>
        </select>
    </li>
    <li class="right hideOnMobile">
        <a href="../cart/cart.php">Cart</a>
    </li>
    <?php
    session_start(); // Start the session to check user login status

    // Check if user is already logged in
    if (isset($_SESSION['username'])) {
        echo '<li class="right hideOnMobile"><a href="../profile/profile.php">Profile</a></li>';
    } else {
        echo '<li class="right hideOnMobile"><a href="../login/register.php">Login/Register</a></li>';
    }
    ?>
    <li class="right menu" onclick="showSideBar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px"
                viewBox="0 -960 960 960" width="24px" fill="black">
                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
            </svg></a></li>
    <?php
}


function drawFilters()
{ ?>
    <nav id="filters-bar">
        <ul>
            <li class="hideOnMobile"><a href="../products_page/products.php?category=Clothing">Clothing</a></li>
            <li class="hideOnMobile"><a href="../products_page/products.php?category=Electronics">Electronics</a></li>
            <li class="hideOnMobile"><a href="../products_page/products.php?category=Sports">Sports</a></li>
            <li class="hideOnMobile"><a href="../products_page/products.php?category=Home%20&%20Garden">House and
                    Garden</a></li>
            <li class="hideOnMobile"><a href="../products_page/products.php?category=Offers">Offers</a></li>
            <li class="hideOnMobile"><a href="../products_page/products.php?category=More">More</a></li>
        </ul>
    </nav>
    <?php
}

?>