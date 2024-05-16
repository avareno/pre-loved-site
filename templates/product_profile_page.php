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
        <h1><?php echo $product['title']; ?></h1>
        <p>Description: <?php echo $product['description']; ?></p>
        <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
        <p>Condition: <?php echo $product['condition']; ?></p>
        <p>Category: <?php echo $product['category']; ?></p>
        <p>Seller: <a
                href="../profile/public_profile.php?id=<?php echo $product['seller_id']; ?>"><?php echo $product['seller_id']; ?></a>
        </p>


        <!-- Verifica se a quantidade do produto é maior que zero -->
        <?php if ($product['quantity'] > 0): ?>
            <!-- Se a quantidade for maior que zero, exibe o botão de adicionar ao carrinho -->
            <form action="../../actions/add_to_cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="submit" value="Add to Cart">
            </form>
        <?php else: ?>
            <!-- Se a quantidade for zero, desativa o botão de adicionar ao carrinho e exibe a mensagem -->
            <button disabled>Add to Cart</button>
            <p>Produto Indisponivel</p>
        <?php endif; ?>
    </section>

    <?php
}
?>