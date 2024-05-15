<?php
function drawShoppingCart($db, $products){
?>
<!doctype html>
<html lang="en">

    <section class="grid-container">
        <h1>Carrinho de Compras</h1>
        <?php if (count($products) > 0) : ?>
            <ul>
            <?php foreach ($products as $product) : ?>
        <li>
            <img src="<?php echo $product['carousel_img']; ?>" alt="<?php echo $product['title']; ?>"> 
            <p class="product-title"><?php echo $product['title']; ?></p>
            <p class="product-description"><?php echo $product['description']; ?></p> 
            <form action="../../actions/remove_from_cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <button type="submit" name="remove_from_cart">Remover do Carrinho</button>
            </form>
        </li>
    <?php endforeach; ?>

            </ul>
            <form action="../checkout/checkout.php" method="post">
                <button type="submit">Fazer Checkout</button>
            </form>
        <?php else : ?>
            <p>O seu carrinho está vazio.</p>
        <?php endif; ?>
    </section>

    
</body>

</html>
<?php
}
?>