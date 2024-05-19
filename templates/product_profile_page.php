<?php
function drawProductProfile($product, $productImage, $product_id)
{
    ?>
    <link rel="stylesheet" href="../../../css/product_profile.css">


    <section class="grid-container">
        <section class="product-images">
            <!-- Display product image -->
            <img src="<?php echo $productImage['carousel_img']; ?>" alt="Product Image">
        </section>
        <section id="content">
            <p id="price">$ <?php echo number_format($product['price'], 2); ?></p>
            <section class="details">
                    <p class="left">Description</p>
                    <p class="right"><?php echo $product['description']; ?></p>
                    <p class="left">Condition</p>
                    <p class="right"><?php echo $product['condition']; ?></p>
                    <p class="left">Category</p>
                    <p class="right"><?php echo $product['category']; ?></p>
                    <p class="left">Seller</p>
                    <p class="right"><?php echo $product['seller_id']; ?></p>
                </section>
            </section>
            <h1><?php echo $product['title']; ?></h1>
            <!-- Verifica se a quantidade do produto é maior que zero -->
            <?php if ($product['quantity'] > 0): ?>
                <!-- Se a quantidade for maior que zero, exibe o botão de adicionar ao carrinho -->
                <form action="../../actions/add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="submit" value="Add to Cart">
                </form>
            <?php else: ?>
                <!-- Se a quantidade for zero, desativa o botão de adicionar ao carrinho e exibe a mensagem -->
                <section id="out-of-stock-container">
                    <button disabled id="out-of-stock-button">Add to Cart</button>
                    <p id="out-of-stock-message">Produto Indisponivel</p>
                </section>
            <?php endif; ?>
        </section>
    </section>

    <?php
}
?>