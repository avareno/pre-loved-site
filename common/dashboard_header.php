<?php

function draw_header($username, $is_admin, $is_seller, $currentPage) {
    draw_html_structure();
    draw_header_content($username);
    draw_navigation_menu($is_admin, $is_seller, $currentPage);
}

function draw_html_structure() {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="../../../css/dashboard.css"> 
        <link rel="stylesheet" href="../../../css/container.css"> 
    </head>
    <body>
    <?php
}

function draw_header_content($username) {
    ?>
    <header>
        <h1>Welcome to Your Dashboard, <?php echo $username; ?>!</h1>
    </header>
    <?php
}

function draw_navigation_menu($is_admin, $is_seller, $currentPage) {
    ?>
    <nav>
        <ul>
            <li><a href="../main_page/index.php">Home</a></li>
            <li><a href="../sell_items/sell_page.php">Sell</a></li>
            <li><a href="<?php echo ($currentPage == 'profile') ? 'settings.php' : 'profile.php'; ?>"><?php echo ($currentPage == 'profile') ? 'Settings' : 'Profile'; ?></a></li>
            <li><a href="../../actions/logout.php">Logout</a></li>
        </ul>
    </nav>
    <?php
}

?>