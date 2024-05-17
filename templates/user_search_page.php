<?php

function drawGridSection( $users) {
    echo '<section class="grid-container">';

    if (!empty($users)) {
        foreach ($users as $user) {
            $id = $user['id'];
            echo '<section class="grid-item">';
            echo '<a href="product_profile.php?id=' . $id . '"><h4 style="border: 1px solid red">' . $user['username'] . '</h4></a>';
            $image_url = $user['image'];
            echo '<a href="product_profile.php?id=' . $id . '"><img src="' . $image_url . '"></a>';
            echo '</section>';
        }
    } else {
        echo 'No result found';
    }

    echo '</section>';
}

?>
