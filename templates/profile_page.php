<?php
function draw_profile_main($row, $username, $products, $sold_products, $db)
{
    ?>
    <main>
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
                <?php if (!empty(trim($row['country'])) || !empty(trim($row['city'])) || !empty(trim($row['phone_number']))): ?>
                    <section class="profile-info">
                        <h3>Additional Information:</h3>
                        <?php if (!empty(trim($row['country']))): ?>
                            <p>Country: <?php echo htmlspecialchars($row['country']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty(trim($row['city']))): ?>
                            <p>City: <?php echo htmlspecialchars($row['city']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty(trim($row['phone_number']))): ?>
                            <p>Phone Number: <?php echo htmlspecialchars($row['phone_number']); ?></p>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>
            </section>
        </section>

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
                        <img src="<?php echo htmlspecialchars($productImage['carousel_img']); ?>" alt="Product Image">
                        <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                        <p><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
                        <p><strong>Condition:</strong> <?php echo htmlspecialchars($product['condition']); ?></p>
                        <p><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
                        <form method="post" action="../../actions/remove_product.php">
                            <input type="hidden" name="remove">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <button type="submit" id="remove-button">Remove</button>
                        </form>
                    </section>
                <?php endforeach; ?>
            </section>
        </section>


        <section>
            <h2>Sold Products</h2>
            <section class="products-container">
                <?php if (empty($sold_products)) { ?>
                    <section class="column" style="width:100%;">
                        <h3>No products yet</h3>
                    </section>
                <?php } else {
                    foreach ($sold_products as $product) {
                        $product_id = $product['product_id'];
                        $product_details = fetchData($db, 'SELECT * FROM products WHERE id = :product_id', [':product_id' => $product_id]);
                        $product_image = fetchData($db, 'SELECT carousel_img FROM images WHERE product_id = :product_id LIMIT 1', [':product_id' => $product_id]);
                        ?>
                        <section class="product-card">
                            <img src="<?php echo htmlspecialchars($product_image['carousel_img']); ?>" alt="Product Image">
                            <h3><?php echo htmlspecialchars($product_details['title']); ?></h3>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($product_details['description']); ?></p>
                            <p><strong>Price:</strong> $<?php echo htmlspecialchars($product_details['price']); ?></p>
                            <p><strong>Condition:</strong> <?php echo htmlspecialchars($product_details['condition']); ?></p>
                            <p><strong>Category:</strong> <?php echo htmlspecialchars($product_details['category']); ?></p>
                            <a href="../../pages/shipping_label/shipping_label.php?sold_product_id=<?php echo htmlspecialchars($product['id']); ?>" target="_blank">
                                <button>Shipping Label</button>
                            </a>
                        </section>
                    <?php }
                } ?>
            </section>
        </section>

    </main>

    <?php
}
?>