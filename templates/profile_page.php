<?php
function draw_profile_main($row, $username, $products, $db){
?>
    <main>
        <section>
            <section class="profile-image-container">
                <img id="profile-image" src="<?php echo $row['image']; ?>" alt="Profile Image">
            </section>
            <section>
                <p>Username: <?php echo $username; ?></p>
                <p>Email: <?php echo $row['email']; ?></p>
                <?php if (!empty(trim($row['small_description'])) || !empty(trim($row['country'])) || !empty(trim($row['city'])) || !empty(trim($row['phone_number']))): ?>
                    <h3>Additional Information:</h3>
                    <?php if (!empty(trim($row['small_description']))): ?>
                        <p>Small Description: <?php echo $row['small_description']; ?></p>
                    <?php endif; ?>
                    <?php if (!empty(trim($row['country']))): ?>
                        <p>Country: <?php echo $row['country']; ?></p>
                    <?php endif; ?>
                    <?php if (!empty(trim($row['city']))): ?>
                        <p>City: <?php echo $row['city']; ?></p>
                    <?php endif; ?>
                    <?php if (!empty(trim($row['phone_number']))): ?>
                        <p>Phone Number: <?php echo $row['phone_number']; ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </section>
        </section>
        <section>
            <h2>Products on Sale</h2>
            <section class="products-container">
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
    </main>

<?php
}
?>