<?php
function drawcheckoutPage($db, $products){
?>
<!DOCTYPE html>
<html lang="en">
<body>

    <section class="checkout-container">
        <?php drawDeliveryAddress() ?>
        <?php drawPaymentMethods() ?>
        <?php drawCheckoutDetails($db, $products) ?>
    </section>

</body>

<?php
}
?>

<?php
function drawPaymentMethods(){
?>
<!DOCTYPE html>
<html lang="en">

        <section class="payment-method">
            <h3>Selecione o Método de Pagamento</h3>
            <select id="payment-method" onchange="handlePaymentMethodChange()">
                <option value="paypal">PayPal</option>
                <option value="card">Cartão de Crédito</option>
                <option value="mbway">MBWay</option>
            </select>
        </section>

        <section class="checkout-payment paypal-details" style="display: none;">
            <h3>Detalhes do PayPal</h3>
            <label for="paypal-email">Email:</label>
            <input type="email" id="paypal-email" name="paypal-email" placeholder="Email do PayPal">
            <label for="paypal-password">Password:</label>
            <input type="password" id="paypal-password" name="paypal-password" placeholder="Password do PayPal">
        </section>

        <section class="checkout-payment card-details" style="display: none;">
            <h3>Detalhes do Cartão de Crédito</h3>
            <label for="card-number">Número do Cartão:</label>
            <input type="text" id="card-number" name="card-number" placeholder="Número do Cartão">
            <label for="card-expiry">Expiry Date:</label>
            <input type="text" id="card-expiry" name="card-expiry" placeholder="Expiry Date">
            <label for="card-cvv">CVV:</label>
            <input type="text" id="card-cvv" name="card-cvv" placeholder="CVV">
        </section>

        <section class="checkout-payment mbway-details" style="display: none;">
            <h3>Detalhes do MBWay</h3>
            <label for="mbway-phone">Número de Telemóvel:</label>
            <input type="text" id="mbway-phone" name="mbway-phone" placeholder="Número de Telemóvel">
        </section>
    
<?php    
}
?>

<?php
function drawDeliveryAddress(){
?>
<!DOCTYPE html>
<html lang="en">
        <h2>Checkout</h2>

        <section class="checkout-address">
            <h3>Endereço de Entrega</h3>
            <label for="address">Endereço:</label>
            <input type="text" id="address" name="address" placeholder="Endereço de Entrega">

            <label for="city">Cidade:</label>
            <input type="text" id="city" name="city" placeholder="Cidade">

            <label for="zip">Código Postal:</label>
            <input type="text" id="zip" name="zip" placeholder="Código Postal">
        </section>
    

<?php    
}
?>


<?php
function drawCheckoutDetails($db, $products){
?>
<!DOCTYPE html>
<html lang="en">
    
    <?php foreach ($products as $product) : ?>
        <section class="checkout-item">
            <section class="checkout-item-details">
                <img src="<?php echo $product['carousel_img']; ?>" alt="<?php echo $product['title']; ?>">
                <section class="item-info">
                    <h3><?php echo $product['title']; ?></h3>
                    <p><?php echo $product['description']; ?></p>
                    <p>Preço: <?php echo $product['price']; ?></p>
                </section>
            </section>
        </section>
    <?php endforeach; ?>


    <section class="checkout-total">
        <h3>Total: $100</h3> 
    </section>

    <section class="checkout-actions">
        <button class="checkout-btn">Concluir Compra</button>
    </section>
<?php    
}
?>