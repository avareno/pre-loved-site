<?php

function drawGridSection($results, $products) {
    echo '<section class="grid-container">';

    if (!empty($results)) {
        foreach ($results as $result) {
            $id = $result['id'];
            echo '<section class="grid-item">';
            echo '<a href="product_profile.php?id=' . $id . '"><h4 style="border: 1px solid red">' . $result['title'] . '</h4></a>';
            $image_url = $result['carousel_img'];
            echo '<a href="product_profile.php?id=' . $id . '"><img src="' . $image_url . '"></a>';
            echo '</section>';
        }
    } elseif (!empty($products)) {
        foreach ($products as $product) {
            $id = $product['id'];
            echo '<section class="grid-item">';
            echo '<a href="product_profile.php?id=' . $id . '"><h4>' . $product['title'] . '</h4></a>';
            $image_url = $product['carousel_img'];
            echo '<a href="product_profile.php?id=' . $id . '"><img src="' . $image_url . '"></a>';
            echo '</section>';
        }
    } else {
        echo 'No result found';
    }

    echo '</section>';
}

?>
