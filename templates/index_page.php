<?php

function drawSlideWrapper($images,$products) {
    ?>
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
    <?php
}

function drawGridContainer($latests) {
    ?>
    <section class="grid-container">
        <h3> Latest additions</h3>
        <?php
        foreach ($latests as $latest) {
            $id = $latest['id'];
            $title = urlencode($latest['title']); // URL encode the title
            echo '<section class="grid-item">';
            echo '<h4><a href="../products_page/product_profile.php?id=' . $id . '">' . $latest['title'] . '</a></h4>'; // Update the link
            $image_url = $latest['carousel_url'];
            echo '<a href="../products_page/product_profile.php?id=' . $id . '"><img src="' . $image_url . '"></a>'; // Changed image to a link
            echo '</section>';
        }
        ?>
    </section>
    </body>
    </html>
    <?php
}

function drawIndexMain($images,$products, $latests) {
    drawSlideWrapper($images,$products);
    drawGridContainer($latests);
}

?>
