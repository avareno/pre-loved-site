<?php



function drawHeader($username)
{
    ?>
    <header>
        <h1>User Profile</h1>
        <p>Welcome to the profile of <?php echo htmlspecialchars($username); ?>!</p>
    </header>
    <?php
}

function drawProfileSection($row)
{
    session_start();
    // Check if the logged-in user is an admin
    $is_admin = ((isset($_SESSION['permissions']) && $_SESSION['permissions'] === 'admin') && ($row['permissions'] != 'admin'));
    ?>

    <section class="profile">
        <div class="profile-image-container">
            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Profile Picture">
        </div>
        <div class="profile-details">
            <h2><?php echo htmlspecialchars($row['username']); ?></h2>
            <div class="profile-info">
                <label>Email:</label>
                <p><?php echo htmlspecialchars($row['email']); ?></p>
            </div>
            <?php if (!empty(trim($row['small_description']))): ?>
                <div class="profile-info">
                    <label>Small Description:</label>
                    <p><?php echo htmlspecialchars($row['small_description']); ?></p>
                </div>
            <?php endif; ?>

            <!-- Display the promote to admin button if the logged-in user is admin -->
            <?php if ($is_admin): ?>
                <form action="../../actions/promote_to_admin.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <input type="submit" value="Promote to Admin">
                </form>
                <form action="../../actions/ban.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <input type="submit" value="Ban User">
                </form>
            <?php endif; ?>
        </div>
    </section>
    <?php
}

function drawTopReviewsSection($reviews,$db)
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
                        <p><strong>User:</strong> <?php echo htmlspecialchars((getUserByUserId($db, $review['SENDER_ID']))['username']); ?></p>
                        <p><strong>Review:</strong> <?php echo htmlspecialchars($review['REVIEW']); ?></p>
                        <p><strong>Rating:</strong> <?php echo $review['RATING']; ?> Stars</p>
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
                <section class="column" style="width:100%;">
                    <h3>No products yet</h3>
                </section>
            <?php } ?>
            <?php foreach ($products as $product):
                $product_id = $product['id'];
                $productImage = fetchData($db, 'SELECT carousel_img FROM images WHERE product_id = :product_id LIMIT 1', [':product_id' => $product_id]);
                ?>
                <section class="product-card">
                    <img src="<?php echo $productImage['carousel_img']; ?>" alt="Product Image">
                    <h3><?php echo $product['title']; ?></h3>
                    <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
                    <p><strong>Price:</strong> $<?php echo $product['price']; ?></p>
                    <p><strong>Condition:</strong> <?php echo $product['condition']; ?></p>
                    <p><strong>Category:</strong> <?php echo $product['category']; ?></p>
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
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </section>
            
            <input type="hidden" name="receiver_id" value="<?php echo htmlspecialchars($id); ?>">
            <section class="form-group">
                <input type="submit" value="Submit Review" class="button">
            </section>
        </form>
    </section>
    <?php
}




function drawUserProfile($username, $row, $products, $db)
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
        <style>
            /* Add your additional CSS styles here */
        </style>
    </head>

    <body>
        <?php drawHeader($username); ?>
        <main>
            <?php drawProfileSection($row);
            drawReviewSection($row['id']);
            drawTopReviewsSection(fetchDataAll($db, "SELECT * FROM reviews WHERE receiver_id = :receiver_id ORDER BY id DESC LIMIT 5", [':receiver_id' => $row['id']]),$db);
            drawProductsSection($products, $db); ?>
        </main>
        <?php draw_footer(); ?>
    </body>

    </html>
    <?php
}
?>