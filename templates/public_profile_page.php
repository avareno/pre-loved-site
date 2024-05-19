<?php

function drawHeader($username)
{
    ?>
    <header>
        <h1>User Profile</h1>
        <p>Welcome to the profile of <?php echo htmlspecialchars($username); ?>!</p>
        <nav>
        <ul>
            <li><a href="../main_page/index.php">Home</a></li>
        </ul>
    </nav>
    </header>
    <?php
}

function drawProfileSection($row, $averageRating)
{
    session_start();
    
    $is_admin = ((isset($_SESSION['permissions']) && $_SESSION['permissions'] === 'admin') && ($row['permissions'] != 'admin'));
    ?>

    <section class="profile">
        <section class="profile-image-container">
            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Profile Picture">
        </section>
        <section class="profile-details">
            <h2><?php echo htmlspecialchars($row['username']); ?></h2>
            <section class="profile-info">
                <label>Email:</label>
                <p><?php echo htmlspecialchars($row['email']); ?></p>
            </section>
            <?php if (!empty(trim($row['small_description']))): ?>
                <section class="profile-info">
                    <label>About:</label>
                    <p><?php echo htmlspecialchars($row['small_description']); ?></p>
                </section>
            <?php endif; ?>

            <?php if ($is_admin): ?>
                <form action="../../actions/promote_to_admin.php" method="post" class="admin-actions">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <button type="submit" class="admin-button">Promote to Admin</button>
                </form>
                <form action="../../actions/ban.php" method="post" class="admin-actions">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <button type="submit" class="admin-button">Ban User</button>
                </form>
            <?php endif;  ?>
            <button class="chat-button" onclick="startChat('<?php echo htmlspecialchars($row['id']); ?>')">Start Chat</button>
            
            </button>
        </section>
    </section>
    <section class="profile-info">
        <label>Average Rating:</label>
        <p><?php echo $averageRating !== null ? htmlspecialchars(number_format($averageRating, 2)) . ' &star;' : 'No ratings yet'; ?>
        </p>
    </section>
    <?php
}

function drawTopReviewsSection($reviews, $db)
{
    ?>
    <section class="top-reviews">
        <h2>Last 5 Reviews</h2>
        <?php if (empty($reviews)) { ?>
            <p>No reviews yet.</p>
        <?php } else { ?>
            <ul>
                <?php foreach ($reviews as $review): ?>
                    <li>
                        <p><strong>User:</strong>
                            <?php echo htmlspecialchars((getUserByUserId($db, $review['SENDER_ID']))['username']); ?></p>
                        <p><strong>Review:</strong> <?php echo htmlspecialchars($review['REVIEW']); ?></p>
                        <p><strong>Rating:</strong> <?php echo $review['RATING']; ?> &star;</p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php } ?>
    </section>
    <?php
}

function drawProductsSection($products, $db)
{
    ?>
    <section>
        <h2>Products on Sale</h2>
        <section class="products-container">
            <?php if (empty($products)) { ?>
                <section class="column">
                    <h3>No products yet</h3>
                </section>
            <?php } ?>
            <?php foreach ($products as $product):
                $product_id = $product['id'];
                $productImage = fetchData($db, 'SELECT carousel_img FROM images WHERE product_id = :product_id LIMIT 1', [':product_id' => $product_id]);
                ?>
                <section class="product-card">
                    <img src="<?php echo htmlspecialchars($productImage['carousel_img']); ?>" alt="Product Image">
                    <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                    <p><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
                    <p><strong>Condition:</strong> <?php echo htmlspecialchars($product['condition']); ?></p>
                    <p><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
                </section>
            <?php endforeach; ?>
        </section>
    </section>
    <?php
}

function drawReviewSection($id)
{
    ?>
    <section class="user-review">
        <h2>Write a Review</h2>
        <form action="../../actions/submit_review.php" method="post">
            <section class="form-group">
                <label for="review">Your Review:</label>
                <textarea id="review" name="review" rows="4" class="input"></textarea>
            </section>
            <section class="form-group" style="width:80px;">
                <label for="rating">Rating:</label>
                <select id="rating" name="rating" class="styled-select">
                    <option value="1">1 &star;</option>
                    <option value="2">2 &star;</option>
                    <option value="3">3 &star;</option>
                    <option value="4">4 &star;</option>
                    <option value="5">5 &star;</option>
                </select>
            </section>

            <input type="hidden" name="receiver_id" value="<?php echo htmlspecialchars($id); ?>">
            <section class="form-group">
                <button type="submit" class="button">Submit Review</button>
            </section>
        </form>
    </section>
    <?php
}

function drawUserProfile($username, $row, $products, $db, $averageRating)
{
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link rel="stylesheet" href="../../../css/dashboard.css">
        <link rel="stylesheet" href="../../../css/container.css">
        <link rel="stylesheet" href="../../../css/profile_image.css">
        <script src="../../js/chat/button handler.js"></script>


    </head>

    <body>
        <?php drawHeader($username); ?>
        <main>
            <?php
            drawProfileSection($row, $averageRating);
            drawReviewSection($row['id']);
            drawTopReviewsSection(fetchDataAll($db, "SELECT * FROM reviews WHERE receiver_id = :receiver_id ORDER BY id DESC LIMIT 5", [':receiver_id' => $row['id']]), $db);
            drawProductsSection($products, $db);
            ?>
        </main>
        <?php draw_footer(); ?>
    </body>

    </html>
    <?php
}
?>