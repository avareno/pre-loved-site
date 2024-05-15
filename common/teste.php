<body>
    <header>
        <nav id="navbar">
            <ul class="sidebar">
                <li onclick=hideSideBar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px"
                            viewBox="0 -960 960 960" width="24px" fill="black">
                            <path
                                d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                        </svg></a></li>
                <li><a class="active" href="#home">Home</a></li>
                <li><a href="filtered_page.php">News</a></li>
                <li><a href="#contact">Contact</a></li>
                <li>
                <li>
                    <a href="../cart/cart.php">Cart</a>
                </li>
                <?php
                session_start(); // Start the session to check user login status

                // Check if user is already logged in
                if (isset($_SESSION['username'])) {
                    echo '<li><a href="../profile/profile.php">Profile</a></li>';
                } else {
                    echo '<li><a href="../login/register.php">Login/Register</a></li>';
                }
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
                        <input placeholder="Search" type="search" class="input">
                    </section>
                </form>
                </li>
                <li><h4 style="text-decoration: underline bold"> Categories</h4></li>
                <li class="hideOnMobile"><a href="../products_page/products.php?category=Clothing">Clothing</a></li>
                <li class="hideOnMobile"><a href="../products_page/products.php?category=Electronics">Electronics</a>
                </li>
                <li class="hideOnMobile"><a href="../products_page/products.php?category=Sports">Sports</a></li>
                <li class="hideOnMobile"><a href="../products_page/products.php?category=Home%20&%20Garden">House and
                        Garden</a></li>
                <li class="hideOnMobile"><a href="../products_page/products.php?category=Offers">Offers</a></li>
                <li class="hideOnMobile"><a href="../products_page/products.php?category=More">More</a></li>
            </ul>
            <ul>
                <li><img
                        src="https://upload.wikimedia.org/wikipedia/commons/1/1f/The_IMG_Media_broadcasting_company_logo.png">
                </li>
                <li class="hideOnMobile"><a class="active" href="#home">Home</a></li>
                <li class="hideOnMobile"><a href="filtered_page.php">News</a></li>
                <li class="hideOnMobile"><a href="#contact">Contact</a></li>
                <li class="right">
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
                            <input placeholder="Search" type="search" class="input">
                        </section>
                    </form>
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
                <li class="right menu" onclick=showSideBar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                            height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                        </svg></a></li>
            </ul>
        </nav>

    </header>

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
            foreach ($products as $product) {
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
            echo '<section class="grid-item">';
            $image_url = $latest['carousel_url'];
            echo '<a href="../products_page/product_profile.php?id=' . $id . '"><img src="' . $image_url . '"></a>'; // Changed image to a link
            echo '<h4><a href="../products_page/product_profile.php?id=' . $id . '">' . $latest['title'] . '</a></h4>'; // Update the link
            echo '</section>';
        }

        ?>
    </section>



</body>

</html>