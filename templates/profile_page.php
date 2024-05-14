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