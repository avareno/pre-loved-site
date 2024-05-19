<?php

function drawGridSection($users)
{

    echo '        <link rel="stylesheet" href="../../../css/profile_image.css"> 
    ';

    echo '<section class="grid-container">';

    if (!empty($users)) {
        foreach ($users as $user) {
            $id = $user['id'];
            echo '<section class="profile-image-container">';
            echo '<a href="../profile/public_profile.php?id=' . $id . '"><h4 style="border: 1px solid red">' . $user['username'] . '</h4></a>';
            $image_url = $user['image'];
            echo '<a href="../profile/public_profile.php?id=' . $id . '"><img src="' . $image_url . '"></a>';
            echo '</section>';
        }
    } else {
        echo 'No result found';
    }

    echo '</section>';
}

?>